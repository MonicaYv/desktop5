@section('title', 'Wallpaper')
@include('layouts.alert')
<div class="h-full w-full overflow-y-scroll scroll cm">
    <div class="flex-grow h-100 main">
        <div class="flex w-full h-full flex-col content">
            <div class="px-9 lg:px-5 py-4">
                <div class="flex items-center gap-4">
                    <img class="w-16" src="{{ asset($constants['IMAGEFILEPATH'] . 'profile.png') }}" alt="user image" />
                    <span class="text-lg font-normal text-c-black">Administrator</span>
                </div>
            </div>

            <div class="taskbar bg-no-repeat bg-cover bg-center flex items-center justify-between px-5 py-4">
                <div class="flex items-center gap-4 w-full">
                    <span class="text-c-black font-medium">Wallpaper</span>
                </div>
            </div>

            <div class="w-full h-full px-5">
                <div class="py-5 flex items-center gap-4 border-b border-gray tabs">
                    <label for="desktop-wallpaper" class="cursor-pointer radio-border">
                        <input type="radio" name="type" id="desktop-wallpaper" value="0" checked />
                        <span class="text-c-black font-normal">Desktop wallpaper</span>
                        <div></div>
                    </label>
                    <label for="login-wallpaper" class="cursor-pointer radio-border">
                        <input type="radio" name="type" id="login-wallpaper" value="1" />
                        <span class="text-c-black font-normal">Login wallpaper</span>
                        <div></div>
                    </label>
                </div>
                <!-- dektop wallpaper display -->
                <div class="wallpapers w-full py-4" id="desktop-wallpapers" style="display: block;">
                    <span class="text-c-black font-medium">Choose your favourite desktop wallpaper</span>
                    <div class="wallpapers w-full pt-4" id="desktop-wallpaper-list">
                        <div id="add-desktop" class="border border-c-yellow bg-c-lighten-gray flex flex-col gap-3 items-center justify-center">
                            <div class="w-10 h-10 bg-c-yellow rounded-full flex items-center justify-center">
                                <i class="ri-add-large-fill ri-lg"></i>
                            </div>
                            <span class="text-c-black font-medium text-sm sm:text-base">Add new wallpaper</span>
                        </div>

                        @foreach($desktopWallpapers as $wallpaper)
                        @include('appendview.desktop_wallpapers', ['wallpaper' => $wallpaper, 'type' => 0])
                        @endforeach
                    </div>
                    <div class="pt-6 flex items-center justify-end">
                        <button
                            class="bg-c-black hover-bg-c-black text-white rounded-full w-32 py-1.5 text-lg save">
                            Save
                        </button>
                    </div>
                </div>
                <!-- login wallpaper display -->
                <div class="py-4 login" id="login-wallpapers" style="display: none;">
                    <div class="left-background"></div>
                    <div class="right-background"></div>
                    <span class="text-c-black font-medium">Choose your favourite login wallpaper</span>
                    <div class="wallpapers w-full pt-4" id="login-wallpaper-list">
                        <div id="add-login" class="border border-c-yellow bg-c-lighten-gray flex flex-col gap-3 items-center justify-center">
                            <div class="w-10 h-10 bg-c-yellow rounded-full flex items-center justify-center">
                                <i class="ri-add-large-fill"></i>
                            </div>
                            <span class="text-c-black font-medium">Add new wallpaper</span>
                        </div>

                        @foreach($loginWallpapers as $wallpaper)
                        @include('appendview.desktop_wallpapers', ['wallpaper' => $wallpaper, 'type' => 1])
                        @endforeach
                    </div>
                    <div class="pt-6 flex items-center justify-end">
                        <button
                            class="bg-c-black hover-bg-c-black text-white rounded-full w-32 py-1.5 text-lg save">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Upload New Wallpaper -->
<div id="uploadModal" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h2 class="text-lg font-bold mb-4">Upload New Wallpaper</h2>
        <form id="uploadForm" onsubmit="uploadWallpaper(); return false;" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <input type="file" name="image" id="image" required>
            </div>
            <input type="hidden" name="type" id="wallpaperType" value="0">
            <div class="flex justify-end gap-4">
                <button type="button" id="closeModal" class="bg-gray-500 text-white py-2 px-4 rounded">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Upload</button>
            </div>
        </form>
    </div>
</div>
<script>
    // Define the routes and pass them to JavaScript
    const authId = "{{ Auth::id() }}"; // Pass the Auth ID to JavaScript
    const loginWallpaperUrl = "{{ asset($constants['IMAGEFILEPATH'] . 'wallpapers/login/' . ($userWallpaper->login_display ?? 'Wallpaper.png')) }}"; // Pass the login wallpaper URL to JavaScript
    const csrfToken = "{{ csrf_token() }}"; 
    const updateWallpaperUrl = "{{ route('user_wallpaper.update') }}"; // For updating wallpaper
    const uploadWallpaperUrl = "{{ route('wallpaper.store') }}"; // For uploading wallpaper
    const deleteWallpaperUrl = "{{ route('wallpaper.delete', ':id') }}"; // For deleting wallpaper (with placeholder for ID)
    const currentDesktopWallpaper = "{{ asset($constants['IMAGEFILEPATH'] . 'wallpapers/dashboard/' . ($userWallpaper->dashboard_display ?? 'Wallpaper.png')) }}"; // Current desktop wallpaper
    const currentLoginWallpaper = "{{ asset($constants['IMAGEFILEPATH'] . 'wallpapers/login/' . ($userWallpaper->login_display ?? 'Wallpaper.png')) }}"; // Current login wallpaper
    var defaultDesktopWallpaper = "{{ asset($constants['IMAGEFILEPATH'] . 'wallpapers/dashboard/Wallpaper.png') }}";
    // Set cookies dynamically based on the server-side variables
    document.addEventListener('DOMContentLoaded', function() {
        // Set the cookies
        setCookie('auth_id', authId, 7); // Store for 7 days
        setCookie('login_wallpaper', loginWallpaperUrl, 7); // Store for 7 days

        console.log('Stored Auth ID..............:', authId);
        console.log('Stored Login Wallpaper.................:', loginWallpaperUrl);
    });

    function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
</script>

<script src="{{ asset($constants['JSFILEPATH'].'wallpaper.js') }}"></script>

