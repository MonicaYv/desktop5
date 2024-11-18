<?php

namespace App\Http\Controllers;

use App\Models\UserWallpaper;
use App\Models\Wallpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function index()
    {
        $desktopWallpapers = Wallpaper::where('type', 0)
            ->where('status', 1)
            ->where('created_by', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $loginWallpapers = Wallpaper::where('type', 1)
            ->where('status', 1)
            ->where('created_by', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $userWallpaper = UserWallpaper::where('user_id', Auth::id())->first();

        if ($userWallpaper) {
            $desktopWallpaper = Wallpaper::find($userWallpaper->dashboard_display);
            $loginWallpaper = Wallpaper::find($userWallpaper->login_display);

            // Set the image filename directly to the userWallpaper properties
            $user = $userWallpaper->dashboard_display = $desktopWallpaper ? $desktopWallpaper->image : 'Wallpaper.png';
            $login = $userWallpaper->login_display = $loginWallpaper ? $loginWallpaper->image : 'Wallpaper.png';
            // dd($user);
        }




        // Pass the constant for image path to the view
        return view('dashboard', compact('desktopWallpapers', 'loginWallpapers', 'user', 'login'));
    }


    public function storeWallpaper(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = $request->type == 0
                ? public_path('images/wallpapers/dashboard')
                : public_path('images/wallpapers/login');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $image->move($destinationPath, $imageName);
            $wallpaper = Wallpaper::create([
                'image' => $imageName,
                'type' => $request->type,
                'status' => 1,
                'created_by' => Auth::id(),
                'default' => 0
            ]);
            $imagePath = $request->type == 0
                ? asset('public/images/wallpapers/dashboard/' . $imageName)
                : asset('public/images/wallpapers/login/' . $imageName);
            // dd($imagePath);
            return response()->json([
                'success' => true,
                'message' => 'Wallpaper uploaded successfully!',
                'image' => $imagePath,
                'wallpaper_id' => $wallpaper->id,
                'type' => $request->type
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload wallpaper.'
            ]);
        }
    }
    public function deleteWallpaper($id)
    {
        $wallpaper = Wallpaper::find($id);
    
        if (!$wallpaper) {
            return response()->json([
                'success' => false,
                'message' => 'Wallpaper not found.'
            ]);
        }
    
        // Set the wallpaper as inactive
        $wallpaper->status = 0;
        $wallpaper->save();
    
        // Check if any users have this wallpaper as their dashboard or login wallpaper
        $userWallpapers = UserWallpaper::where('dashboard_display', $wallpaper->id)
                            ->orWhere('login_display', $wallpaper->id)
                            ->get();
    
        $defaultWallpaper = 'Wallpaper.png'; // Default wallpaper filename
    
        foreach ($userWallpapers as $userWallpaper) {
            if ($userWallpaper->dashboard_display == $wallpaper->id) {
                $userWallpaper->dashboard_display = $defaultWallpaper;
            }
            if ($userWallpaper->login_display == $wallpaper->id) {
                $userWallpaper->login_display = $defaultWallpaper;
            }
            $userWallpaper->save();
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Wallpaper deleted successfully!'
        ]);
    }
    
    public function updateUserWallpaper(Request $request)
    {
        $userId = Auth::id();
        $type = $request->input('type');
        $wallpaperId = $request->input('wallpaper_id');
    
        // Default wallpaper filename (adjust this to the correct default wallpaper filename)
        $defaultWallpaper = 'Wallpaper.png';
    
        // Find the wallpaper by its ID (ensure it exists)
        $wallpaper = Wallpaper::find($wallpaperId);
    
        // If no wallpaper is found, set it to the default wallpaper
        if (!$wallpaper) {
            $wallpaperId = $defaultWallpaper;
            $imagePath = $type == 0
                ? asset('public/images/wallpapers/dashboard/' . $defaultWallpaper)
                : asset('public/images/wallpapers/login/' . $defaultWallpaper);
        } else {
            $imagePath = $type == 0
                ? asset('public/images/wallpapers/dashboard/' . $wallpaper->image)
                : asset('public/images/wallpapers/login/' . $wallpaper->image);
        }
    
        // Update or create the user wallpaper record
        $userWallpaper = UserWallpaper::updateOrCreate(
            ['user_id' => $userId],
            [
                'dashboard_display' => $type == 0 ? $wallpaperId : UserWallpaper::where('user_id', $userId)->value('dashboard_display'),
                'login_display' => $type == 1 ? $wallpaperId : UserWallpaper::where('user_id', $userId)->value('login_display'),
            ]
        );
    
        // Return success response with the new or default wallpaper URL
        return response()->json([
            'success' => true,
            'message' => 'Wallpaper updated successfully.',
            'image' => $imagePath // Return the new wallpaper URL to update on frontend
        ]);
    }
    
    public function showLoginPage()
    {
        $userWallpaper = UserWallpaper::where('user_id', Auth::id())->first();
        $loginWallpaper = $userWallpaper ? asset('images/wallpapers/login/' . $userWallpaper->login_display) : asset('images/wallpapers/login/Wallpaper.png');

        return view('auth.login', compact('loginWallpaper'));
    }
    public function getWallpaper($id)
{
    $wallpaper = Wallpaper::find($id);

    if (!$wallpaper) {
        return response()->json(['success' => false, 'message' => 'Wallpaper not found.']);
    }

    $imagePath = asset('images/wallpapers/' . ($wallpaper->type == 0 ? 'dashboard' : 'login') . '/' . $wallpaper->image);

    return response()->json([
        'success' => true,
        'image' => $imagePath,
    ]);
}

}
