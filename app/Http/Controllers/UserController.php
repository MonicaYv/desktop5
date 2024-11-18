<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Company;
use App\Models\Group;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Models\SettingMenu;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private function getViewPath($baseView)
    {
        if (request()->is('client/users*')) {
            return 'client.' . $baseView;
        } elseif (request()->is('company/users*')) {
            return 'company.' . $baseView;
        } elseif (request()->is('client/company/users*')) {
            return 'client.company.' . $baseView;
        }
        return $baseView;
    }

    public function index()
    {
        $clients = Client::all();
        $client_id = auth()->user()->client_id;

        $companies = Company::where('client_id',$client_id)->get();

        $users = User::with('client', 'company', 'group', 'role')->get();
        $groups = Group::where('client_id', auth()->user()->client_id)
                        ->where('company_id', auth()->user()->company_id)->get();
        $roles = Role::where('client_id', auth()->user()->client_id)
                     ->where('company_id', auth()->user()->company_id)->get();
        $menus = SettingMenu::where('status', 1)->get();

        $view = $this->getViewPath('users.main');
        return view($view, compact('groups', 'roles','clients', 'users', 'menus','companies'));
    }

    public function userlist(Request $request)
    {
        $usertype = auth()->user()->usertype;
        $client_id = $request->has('client_id') ? base64_decode($request->input('client_id')) : auth()->user()->client_id;
        $company_id = $request->has('company_id') ? base64_decode($request->input('company_id')) : auth()->user()->company_id;
        $searchTerm = $request->input('searchTerm');

        $users = User::with(['client', 'company', 'group', 'role'])
            ->when(request()->is('users*'), function ($query) use ($client_id, $company_id,$usertype) {

                if (is_null($client_id) && is_null($company_id)) {
                    $query->whereNull('client_id')->whereNull('company_id');
                } elseif(is_null($company_id) && !is_null($client_id)) {
                    $query->where('client_id', $client_id)->whereNull('company_id');
                }else{
                    $query->where('client_id', $client_id)
                    ->where('company_id', $company_id);
                }
                if($usertype == 'group' || $usertype =='user'){
                    $query->where('group_id', auth()->user()->group_id);
                }
            })
            ->when(request()->is('client/users*'), function ($query) use ($client_id) {
                $query->whereNull('company_id')
                      ->whereNotNull('client_id'); // Ensures client_id is not null
                      
                if (!empty($client_id)) {
                    $query->where('client_id', $client_id);
                }
            })
            ->when( request()->is('client/company/users*'), function ($query) use ($client_id, $company_id) {
                $query->whereNotNull('company_id')->whereNotNull('client_id');
                    
                    if (!empty($client_id)) {
                        $query->where('client_id', $client_id);
                    }
        
                if (!empty($company_id)) {
                    $query->where('company_id', $company_id);
                }
            })
            ->when(request()->is('company/users*'), function ($query) use ($client_id, $company_id) {
                $query->whereNotNull('company_id')->whereNotNull('client_id');
                $query->where('client_id', $client_id);
                if (!empty($company_id)) {
                    $query->where('company_id', $company_id);
                }
            })
            ->when($searchTerm, function ($query) use ($searchTerm, $client_id,$company_id) {
                if (!empty($client_id)) {
                    $query->where('client_id', $client_id);
                }
                if (!empty($company_id)) {
                    $query->where('company_id', $company_id);
                }
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('role', function ($q) use ($searchTerm) {
                        $q->where('name', 'LIKE', "%{$searchTerm}%");
                    })
                    ->orWhereHas('group', function ($q) use ($searchTerm) {
                        $q->where('name', 'LIKE', "%{$searchTerm}%");
                    });
                    if (request()->is('client/roles*') || request()->is('client/company/roles*')) {
                        $q->orWhereHas('client', function ($q) use ($searchTerm) {
                            $q->where('name', 'LIKE', "%{$searchTerm}%");
                        });
                    }
    
                    if (request()->is('client/company/roles*')) {
                        $q->orWhereHas('company', function ($q) use ($searchTerm) {
                            $q->where('name', 'LIKE', "%{$searchTerm}%");
                        });
                    }
                });
            })
            ->where('id', '!=', auth()->user()->id)
            ->where('usertype','user')  // Exclude the logged-in user
            ->paginate(10);

        $view = $this->getViewPath('users.list');
        $html = view($view)->with('users', $users)->render();
        return response()->json(['html' => $html]);
    }


    public function toggleStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();

        return response()->json([
            'message' => 'User ' . ($request->status == 1 ? 'activated' : 'deactivated') . ' successfully.',
            'new_status' => $user->status
        ]);
    }

    public function addUser()
    {
        $client_id = auth()->user()->client_id;
        $company_id = auth()->user()->company_id;
        $clients = Client::all();
        $companies = Company::where('client_id',$client_id)->get();

        $groups = Group::when((request()->is('company/users*') || request()->is('client/company/users*')), function ($query) use ($client_id, $company_id) {
            $query->where('client_id', $client_id)
                  ->where('company_id', $company_id);
        })
        ->when(request()->is('client/users*'), function ($query) use ($client_id, $company_id) {
            $query->where('client_id', $client_id)
                    ->whereNull('company_id');
        })
        ->when(request()->is('users*'), function ($query) use ($client_id, $company_id) {

             if (is_null($client_id) && is_null($company_id)) {
                $query->whereNull('client_id')->whereNull('company_id');
            } else {
                $query->where('client_id', $client_id)
                ->where('company_id', $company_id);
            }
        })
        ->get();

    $roles = Role::when((request()->is('company/users*') || request()->is('client/company/users*') || request()->is('users*')), function ($query) use ($client_id, $company_id) {
            $query->where('client_id', $client_id)
                  ->where('company_id', $company_id);
        })
        ->when(request()->is('client/users*'), function ($query) use ($client_id, $company_id) {
            $query->where('client_id', $client_id)
                    ->whereNull('company_id');
        }) 
        ->when(request()->is('users*'), function ($query) use ($client_id, $company_id) {

            if (is_null($client_id) && is_null($company_id)) {
               $query->whereNull('client_id')->whereNull('company_id');
           } else {
                $query->where('client_id', $client_id)
                ->where('company_id', $company_id);
           }
       })
        ->get();

        $view = $this->getViewPath('users.add');
        $html = view($view)->with('roles', $roles)->with('groups', $groups)->with('clients', $clients)->with('companies', $companies)->render();
        return response()->json(['html' => $html]);
    }

    public function editUser(Request $request)
    {
        $clients = Client::all();

        $userid = base64_decode($request->userid);
        $userdetail = User::findOrFail($userid);
        if(request()->is('users*')){
            $client_id = auth()->user()->client_id;
            $company_id = auth()->user()->company_id;
            $companies = Company::where('client_id',$userdetail->client_id)->get();

        }else{
            if($userdetail){
                $client_id = $userdetail->client_id;
                $company_id = $userdetail->company_id;
                $companies = Company::where('client_id',$userdetail->client_id)->get();

            }
        }
        

        $groups = Group::when((request()->is('company/users*') || request()->is('client/company/users*')), function ($query) use ($client_id, $company_id) {
                $query->where('client_id', $client_id)
                      ->where('company_id', $company_id);
            })
            ->when(request()->is('client/users*'), function ($query) use ($client_id, $company_id) {
                $query->where('client_id', $client_id)
                        ->whereNull('company_id');
            })
            ->when(request()->is('users*'), function ($query) use ($client_id, $company_id) {

                 if (is_null($client_id) && is_null($company_id)) {
                    $query->whereNull('client_id')->whereNull('company_id');
                } else {
                    $query->where('client_id', $client_id)
                    ->where('company_id', $company_id);
                }
            })
            ->get();

        $roles = Role::when((request()->is('company/users*') || request()->is('client/company/users*') || request()->is('users*')), function ($query) use ($client_id, $company_id) {
                $query->where('client_id', $client_id)
                      ->where('company_id', $company_id);
            })
            ->when(request()->is('client/users*'), function ($query) use ($client_id, $company_id) {
                $query->where('client_id', $client_id)
                        ->whereNull('company_id');
            }) 
            ->when(request()->is('users*'), function ($query) use ($client_id, $company_id) {

                if (is_null($client_id) && is_null($company_id)) {
                   $query->whereNull('client_id')->whereNull('company_id');
               } else {
                    $query->where('client_id', $client_id)
                    ->where('company_id', $company_id);
               }
           })
            ->get();

        $view = $this->getViewPath('users.edit');
        $html = view($view)->with('roles', $roles)->with('groups', $groups)->with('clients', $clients)->with('userdetail', $userdetail)->with('companies',$companies)->render();
        return response()->json(['html' => $html]);
    }

    public function show($id)
    {
        $user = User::with('client', 'company', 'group', 'role')->findOrFail($id);
        $view = $this->getViewPath('users.show');
        return view($view, compact('user'));
    }

    public function store(Request $request)
    {
        $clientRequired = request()->is('client/users*') || request()->is('client/company/users*');
        $companyRequired = request()->is('company/users*') || request()->is('client/company/users*');
        $client_id = $request->has('client') ? base64_decode($request->client) : auth()->user()->client_id;
        $company_id = $request->has('company') ? base64_decode($request->company) : auth()->user()->company_id;
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|exists:groups,id',
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:100',
            'username' => ['required', 'string', 'max:100', 'unique:users,username', 'regex:/^[a-zA-Z][a-zA-Z0-9]*$/'],
            'email' => 'required|email|max:100|unique:users,email',
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/'],
            'sizeMax' => 'required|numeric',
            'client' => $clientRequired ? 'required' : 'nullable',
            'company' => $companyRequired ? 'required' : 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $input['client_id'] = $client_id;
        $input['company_id'] = $company_id;
        $input['created_by'] = auth()->user()->id;

        $user = User::create($input);
        return response()->json(['success' => 'User added successfully.', 'user' => $user]);
    }

    public function update(Request $request, User $user)
    {

        $clientRequired = request()->is('client/users*') || request()->is('client/company/users*');
        $companyRequired = request()->is('company/users*') || request()->is('client/company/users*');
        $client_id = $request->has('client') ? base64_decode($request->client) : $user->client_id;
        $company_id = $request->has('company') ? base64_decode($request->company) : $user->company_id;
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|exists:groups,id',
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:100',
            'username' => ['required', 'string', 'max:100', 'unique:users,username,' . $user->id, 'regex:/^[a-zA-Z][a-zA-Z0-9]*$/'],
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'password' => ['nullable', 'string', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/'],
            'sizeMax' => 'nullable|numeric',
            'client' => $clientRequired ? 'required' : 'nullable',
            'company' => $companyRequired ? 'required' : 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }



        $user->update([
            'group_id' => $request->group_id,
            'role_id' => $request->role_id,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'sizeMax' => $request->sizeMax,
            'client_id' => $client_id,
            'company_id' => $company_id
        ]);

        return response()->json(['success' => 'User updated successfully.', 'user' => $user]);
    }

    public function deleteUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully.']);
    }

    public function getCompaniesByClient(Request $request)
    {
        $client_id = $request->input('client_id');
        $companies = Company::where('client_id', $client_id)->get(['id', 'name']);
        return response()->json($companies);
    }

    public function fetchRolesAndGroupsByClient(Request $request)
    {
        $client_id = $request->has('client_id') ? base64_decode($request->input('client_id')) : auth()->user()->client_id;
        $company_id = $request->has('company_id') ? base64_decode($request->input('company_id')) : null;

        $roles = Role::where('client_id', $client_id)
                    ->when($company_id, function ($query) use ($company_id) {
                        $query->where('company_id', $company_id);
                    }, function ($query) {
                        $query->whereNull('company_id');
                    })
                    ->get(['id', 'name']);

        $groups = Group::where('client_id', $client_id)
                    ->when($company_id, function ($query) use ($company_id) {
                        $query->where('company_id', $company_id);
                    }, function ($query) {
                        $query->whereNull('company_id');
                    })
                    ->get(['id', 'name']);

        return response()->json([
            'roles' => $roles,
            'groups' => $groups
        ]);
    }


}
