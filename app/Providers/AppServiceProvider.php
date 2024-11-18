<?php

namespace App\Providers;

use App\Models\UserWallpaper;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallpaper;
use App\Models\SettingMenu;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Share wallpapers data with all views
        View::composer('*', function ($view) {
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
            // Default wallpaper
            $defaultWallpaper = 'Wallpaper.png';
            $user = $defaultWallpaper;
            $login = $defaultWallpaper;
            if ($userWallpaper) {
                $desktopWallpaper = Wallpaper::find($userWallpaper->dashboard_display);
                $loginWallpaper = Wallpaper::find($userWallpaper->login_display);

                // Set the image filename directly to the userWallpaper properties
                $userWallpaper->dashboard_display = $desktopWallpaper ? $desktopWallpaper->image : 'Wallpaper.png';
                $userWallpaper->login_display = $loginWallpaper ? $loginWallpaper->image : 'Wallpaper.png';
            }

            // Pass variables to view, no need for extra variables like $user and $login
            $view->with(compact('desktopWallpapers', 'loginWallpapers', 'userWallpaper'));
        });

        View::composer('*', function ($view) {
            $menus = SettingMenu::where('status', 1)->get();
            $view->with('menus', $menus);
        });
       
    }
}
