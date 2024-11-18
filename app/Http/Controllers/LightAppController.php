<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\LightApp;
use App\Models\LightAppCategory;
use App\Models\File as FileModel;
use App\Models\Folder;


class LightAppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = LightAppCategory::all();
        return view('lightapp',compact('categories'));
    }
    
    public function updateLightApp(Request $request)
    {
        $lightAppId = $request->input('light_app_id');

        // Update the add_app column for the specified light app
        LightApp::where('id', $lightAppId)->update(['add_app' => 1]);

        // Get the updated app list HTML
        $lightApps = LightApp::where('add_app', 1)->get();
        $html = view('appendview.lightappdashboard')->with('lightApps', $lightApps)->render();

        return response()->json(['html' => $html]);
    }
    public function alladdedapps(Request $request){
         // Get the updated app list HTML
        $parentPath = 'Desktop';// Adjust this path as needed
        $sortby= !empty($request->input('sort_by')) ? $request->input('sort_by') : 'id';
        $sortorder= !empty($request->input('sort_order')) ? $request->input('sort_order') : 'asc';
        $files = FileModel::where('parentpath', $parentPath)->where('status', 1)->where('created_by', auth()->id())->orderBy($sortby, $sortorder)->get();
        $lightApps = LightApp::where('add_app', 1)->get();
        $html = view('appendview.lightappdashboard')->with('lightApps', $lightApps)->with('files', $files)->render();
        return response()->json(['html' => $html]);

    }
    public function allLightApps(Request $request){
        $categoryId = $request->input('category_id');
        $lightApps = LightApp::where('group', $categoryId)->get();
        if(empty($categoryId)){
            $lightApps = LightApp::all();
        }
        $html = view('appendview.lightapp')->with('lightApps', $lightApps)->render();
        return response()->json(['html' => $html]);
    }
    
}
?>
