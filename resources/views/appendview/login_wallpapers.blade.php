@foreach($loginWallpapers as $wallpaper)
<div class="relative wallpaper-div border border-gray overflow-hidden login-wallpaper">
    <img class="object-cover w-full h-full" src="{{ asset('images/wallpapers/login/' . $wallpaper->image) }}" data-id="{{ $wallpaper->id }}" />
    <div class="absolute top-2 right-2">
        <input class="c-checkbox" type="checkbox">
    </div>
    <div class="absolute bottom-1 right-2">
        @if($wallpaper->default == 0)
        <form action="{{ route('wallpaper.delete', $wallpaper->id) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">
                <i class="text-c-yellow ri-delete-bin-6-line"></i>
            </button>
        </form>
        @endif
    </div>
</div>
@endforeach
