<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\PermissionHelper;
use Illuminate\Support\Facades\DB;

class AnaliticsController extends Controller
{
    public function index()
    {
        $filteredPermissions = PermissionHelper::getFilteredPermissions(auth()->id());
           
         $fileUploads = DB::table('activities')
        ->select(DB::raw('count(*) as upload_count, user_id'))
        ->where('action', 'File Upload')
        ->groupBy('user_id')
        ->get();
    
    $labels = [];
    $data = [];
    
    foreach ($fileUploads as $upload) {
        $labels[] = 'User ' . $upload->user_id;
        $data[] = $upload->upload_count;
    }
            return view('analitics',compact('filteredPermissions','labels', 'data'));

    }

}
