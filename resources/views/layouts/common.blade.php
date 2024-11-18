<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset($constants['CSSFILEPATH'] . 'semantic.min.css') }}" />
    <link href="https://unpkg.com/tailwindcss@^2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset($constants['IMAGEFILEPATH'] . 'logo.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset($constants['CSSFILEPATH'] . 'custom.css') }}" />
    <link rel="stylesheet" href="{{ asset($constants['CSSFILEPATH'] . 'root.css') }}" />
    <link rel="stylesheet" href="{{ asset($constants['CSSFILEPATH'] . 'common.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset($constants['CSSFILEPATH'] . 'tour.min.css') }}" /> --}}

    <!-- <link rel="stylesheet" href="{{ asset($constants['CSSFILEPATH'] . 'cs.css') }}" /> -->
    <script>
        var base_url = "{{ url('/') }}";
    </script>

    @yield('styles')

</head>

<body class="w-full h-screen">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('notice.notification')
    <!-- Taskbar -->
    <div class="navbar navbarhead h-16 flex items-center w-full absolute">
        <div class="flex justify-center ml-10 w-full relative h-full" id="toolbar">
            <div class="bg absolute w-full  bottom-0">
                <img id="shelf" class="w-full" src="{{ asset($constants['IMAGEFILEPATH'] . 'shelf.png') }}"
                    alt="">
            </div>
            <header id="iframeheaders" class="mt-1">
                <div class="flex space-x-4" id="sortable-apps">
                </div>
            </header>
        </div>
        <div class="flex items-center gap-8 w-48 justify-end pr-5 relative">
            <i id="search-icon" class="ri-search-line icon-color"></i>
            <i id="pinned" class="ri-pushpin-line icon-color"></i>
            <i id="notification-icon" class="ri-notification-3-line"></i>
            <button class="icon-trigger-dropdown cursor-default">
                <i class="ri-question-line icon-color"></i>
            </button>
            <div class="taskbar-dropdown-menu">
                <a href="https://desktop2.sizaf.com/docs">
                    <button id="doc-button" type="button" value="Documentation" tabindex="0" class="taskbar-dropdown-item flex items-center gap-2">
                        <i class="ri-book-marked-line"></i>
                    </button>
                </a>
                <button id='guide-button' type="button" value="OnScreen" tabindex="0" onclick="startGuide()"
                    class="taskbar-dropdown-item flex items-center gap-2">
                    <i class="ri-guide-line"></i>
                </button>
            </div>
            <div id="doc-tooltip" class="hidden absolute py-1 px-2 text-start text-xs top-9 right-12 z-10 bg-white border rounded-md border-c-yellow font-normal">
                Documentation
            </div>
            <div id="guide-tooltip" class="hidden absolute py-1 px-2 text-start text-xs right-12 z-10 bg-white border rounded-md border-c-yellow font-normal" style="top: 4.3rem;">
                Guide
            </div>
        </div>
    </div>
    <!-- Taskbar End -->


    <!-- <header id="iframeheaders" class="transparent p-2 text-white flex justify-center items-center fixed top-0 left-0 right-0 mainiframeiconheader mainscreen"> -->

    <div class="notification-container">
        <div id="NotiContainer" class="Notification h-64 absolute right-5 top-16 hidden overflow-hidden">
            <div class="h-16 border-b-2 border-c-gray py-4 px-4 flex items-center justify-between">
                <h1 class="text-sm sm:text-lg text-c-black font-normal">Notification Center</h1>
                @if (Auth::user()->notifications()->whereNull('read_at')->count() > 0)
                <h1 class="text-sm sm:text-lg text-c-yellow font-medium cursor-pointer" id="MarkAllRead">Mark all as
                    read</h1>
                @endif
            </div>
            <div class="scrollbar-div overflow-y-auto" style="height: calc(100% - 64px);">
                <ul id="ULNoti">
                    @if (Auth::user()->notifications()->whereNull('read_at')->count() > 0)
                    @foreach (Auth::user()->notifications()->whereNull('read_at')->pluck('data', 'id') as $id => $data)
                    @php
                    $notification = is_string($data) ? json_decode($data, true) : $data;
                    @endphp
                    <li class="border-b-2 border-c-gray px-4 py-2.5 notification-item" data-id="{{ $id }}" data-title="{{ $notification['title'] }}" data-content="{{ $notification['content'] }}" data-time="{{ $notification['time'] }}">
                        <div class="flex items-start justify-between gap-20">
                            <p class="text-sm text-c-black font-normal ">
                                {{ $notification['title'] ?? 'No Title' }}
                            </p>
                            <i class="ri-close-circle-fill ri-1x cursor-pointer ReadThisNoti"
                                data-id="{{ $id }}"></i>
                        </div>
                        <span
                            class="text-c-time font-normal text-sm">{{ \Carbon\Carbon::parse($notification['time'] ?? now())->diffForHumans(['short' => true]) }}</span>
                    </li>
                    @endforeach
                    @else
                    <li class="text-center mt-16">
                        No new notifications
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <!--///// iframe -->
    <div id="alliframelist">

    </div>

    <!--///// Context Menu -->
    <div id="context-menu" class="context-menu context-menulist hidden bg-c-white">

    </div>
    <div id="app-contextmenu" class="context-menu context-menulist hidden bg-c-white">
    </div>
    <!--//// Context Menu End-->

    <!-- Upload popup -->
    <div id="popupuploadfiles"
        class="fixed inset-0 flex z-20 items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="popup-content bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Local Upload</h2>
                <button id="close-popup" class="text-2xl">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">File Upload</h2>
                <div id="dropzone" class="border-2 border-dashed border-gray-300 p-6 rounded-lg text-center">
                    Drag and drop files here or click to upload
                </div>
                <input type="file" id="file-input" class="hidden" multiple>
                <div id="file-list-container" class="mt-4 space-y-2 hidden">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 text-left">Name</th>
                                <th class="py-2 px-4 text-left">Size</th>
                                <th class="py-2 px-4 text-left">Progress</th>
                            </tr>
                        </thead>
                        <tbody id="file-list"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="draggableelement setting-box popupiframe inset-0 bg-black-900 bg-opacity-50 flex items-center justify-center rounded-lg hidden account">
        <div class="draggable bg-opacity-70 shadow-lg w-full h-full relative">
            <div class="flex justify-end items-center p-1 pr-2 border-b bg-c-gray-gradient">
                <div class="flex space-x-1">
                    <!-- <a href="#" class="minimizeiframe-btn"><img src="{{ asset($constants['IMAGEFILEPATH'].'minimize'.$constants['ICONEXTENSION'])}}" /></a>
                    <a href="#" class="maximizeiframe-btn"><img src="{{ asset($constants['IMAGEFILEPATH'].'maximize'.$constants['ICONEXTENSION'])}}" /></a> -->
                    <a href="#" class="closeiframe-btn"><img src="{{ asset($constants['IMAGEFILEPATH'].'close'.$constants['ICONEXTENSION'])}}"/></a>
                </div>
            </div>
            @include('wallpaper')
            <!-- <div class="h-full w-full overflow-y-scroll scroll cm">
                <div class="px-9 lg:px-5 py-4">
                    <div class="flex items-center gap-4">
                    <img class="w-12" src="images/profile.png" alt="profile img" />
                    <span class="text-lg font-normal text-c-black"
                        >Administrator</span
                    >
                    </div>
                </div>
                <div class="taskbar bg-no-repeat bg-cover bg-center flex items-center justify-between px-5 md:px-5 lg:px-7 py-4">
                    <div class="flex items-center gap-4 w-full md:w-1/2">
                        <div class="flex gap-1 sm:gap-2 items-center">
                            <span class="text-c-black font-medium">Wallpaper</span>
                        </div>
                    </div>
                </div>
                 <div class="w-full h-full px-5 md:px-5 lg:px-7">
                    <div class="py-5 flex items-center gap-4 sm:gap-6 border-b border-gray tabs">
                        <label for="themes" class="cursor-pointer radio-border">
                            <input type="radio" name="type" id="themes" value="themes" />
                            <span class="text-c-black font-normal text-xs md:text-base"
                            >Themes</span
                            >
                            <div></div>
                        </label>
                        <label for="desktop-wallpaper" class="cursor-pointer radio-border">
                            <input
                            type="radio"
                            name="type"
                            id="desktop-wallpaper"
                            value="desktop-wallpaper"
                            checked
                            />
                            <span class="text-c-black font-normal text-xs md:text-base"
                            >Desktop wallpaper</span
                            >
                            <div></div>
                        </label>
                        <label for="login-wallpaper" class="cursor-pointer radio-border">
                            <input
                            type="radio"
                            name="type"
                            id="login-wallpaper"
                            value="login-wallpaper"
                            />
                            <span class="text-c-black font-normal text-xs md:text-base"
                            >Login wallpaper</span
                            >
                            <div></div>
                        </label>
                    </div>
                    <div class="py-4 h-full">
                        <span class="text-c-black font-medium"
                            >Choose your favourite wallpaper</span
                        >
                        <div class="wallpapers w-full pt-4">
                            <div
                            id="add-div"
                            class="border border-c-yellow bg-c-lighten-gray flex flex-col gap-3 items-center justify-center"
                            >
                            <div
                                class="w-10 h-10 bg-c-yellow rounded-full flex items-center justify-center"
                            >
                                <i class="ri-add-large-fill ri-lg"></i>
                            </div>
                            <span class="text-c-black font-medium text-sm sm:text-base"
                                >Add new wallpaper</span
                            >
                            </div>
                            <div class="wallpaper-div border border-gray overflow-hidden">
                            <img
                                class="w-full h-full"
                                src=""
                                alt="wallpaper"
                            />
                            </div>
                            <div class="wallpaper-div border border-gray overflow-hidden">
                            <img
                                class="object-cover w-full h-full"
                                src=""
                                alt="wallpaper"
                            />
                            </div>
                            <div class="wallpaper-div border border-gray overflow-hidden">
                            <img
                                class="object-cover w-full h-full"
                                src=""
                                alt="wallpaper"
                            />
                            </div>
                            <div class="wallpaper-div border border-gray overflow-hidden">
                            <img
                                class="object-cover w-full h-full"
                                src=""
                                alt="wallpaper"
                            />
                            </div>
                            <div class="wallpaper-div border border-gray overflow-hidden">
                            <img
                                class="object-cover w-full h-full"
                                src=""
                                alt="wallpaper"
                            />
                            </div>
                            <div class="wallpaper-div border border-gray overflow-hidden">
                            <img
                                class="object-cover w-full h-full"
                                src=""
                                alt="wallpaper"
                            />
                            </div>
                            <div class="wallpaper-div border border-gray overflow-hidden">
                            <img
                                class="object-cover w-full h-full"
                                src=""
                                alt="wallpaper"
                            />
                            </div>
                            <div class="wallpaper-div border border-gray overflow-hidden">
                            <img
                                class="object-cover w-full h-full"
                                src=""
                                alt="wallpaper"
                            />
                            </div>
                            <div class="wallpaper-div border border-gray overflow-hidden">
                            <img
                                class="object-cover w-full h-full"
                                src=""
                                alt="wallpaper"
                            />
                            </div>
                        </div>
                        <div class="pt-6 flex items-center justify-end pb-14">
                            <button
                            class="bg-c-black hover-bg-c-black text-white rounded-full w-32 py-1.5 text-lg save"
                            >
                            Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>     -->
        </div>
    </div>



    @yield('content')

    <!--end here -->

    <script>
        const desktopapp = @json(route('desktopapp'));
        const contextmenu = @json(route('contextmenu'));
        const createFolderRoute = @json(route('createfolder'));
        const createFileRoute = @json(route('createfile'));
        const showFileDetail = @json(route('showpathdetail'));
        const renameroute = @json(route('renamefile'));
        const deleteRoute = @json(route('deletefile'));
        const restoreRoute = @json(route('restorefile'));
        const restoreAdminRoute = @json(route('restoreAdmin'));
        const copyRoute = @json(route('copyfile'));
        const pasteRoute = @json(route('pastefile'));
        const closeIframeRoute = @json(route('closeiframe'));
        const openIframeRoute = @json(route('openiframe'));
        const uploadRoute = @json(route('upload'));
        const leftArrowClick = @json(route('leftarrowclick'));
        const rightArrowClick = @json(route('rightarrowclick'));
        const shareRoute = @json(route('getUrl'));
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>

    <script src="{{ asset($constants['JSFILEPATH'].'animation.js') }}"></script>

    <script src="{{ asset($constants['JSFILEPATH'] . 'common.js') }}"></script>
    <script src="{{ asset($constants['JSFILEPATH'] . 'taskbar.js') }}"></script>
    {{-- <script src="{{ asset($constants['JSFILEPATH'] . 'tourguidejs/tour.js') }}"></script>
    <script src="{{ asset($constants['JSFILEPATH'] . 'tourguidejs/desktop-tour.js') }}"></script> --}}


    <!------------------------------------------------share start ---------------------------------------->
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>

    <div id="shareFilesFolderModal"></div>

    <script>
        $(document).ready(function() {
            //For Share Model
            $(document).on('change', '#Users, #Groups, #Roles', function() {
                const targetId = $(this).attr('id');
                if ($(this).is(':checked')) {
                    $('#Div' + targetId).show();
                } else {
                    $('#Div' + targetId).hide();
                }
            });
            $(document).on('change', '#Everyone', function() {
                if ($(this).is(':checked')) {
                    $('#Users, #Groups, #Roles').prop('checked', false);
                    $('#DivUsers, #DivGroups, #DivRoles').hide();
                }
            });
            $(document).on('change', '#EditUsers, #EditGroups, #EditRoles', function() {
                const targetId = $(this).attr('id');
                if ($(this).is(':checked')) {
                    $('#Div' + targetId).show();
                } else {
                    $('#Div' + targetId).hide();
                }
            });
            $(document).on('change', '#EditEveryone', function() {
                if ($(this).is(':checked')) {
                    $('#EditUsers, #EditGroups, #EditRoles').prop('checked', false);
                    $('#DivUsers, #DivEditGroups, #DivEditRoles').hide();
                }
            });
            $(document).on('click', '#RandomPassword', function() {
                console.log('here');
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                let password = '';
                for (let i = 0; i < 6; i++) {
                    const randomIndex = Math.floor(Math.random() * characters.length);
                    password += characters.charAt(randomIndex);
                }
                $('#Password').val(password);
            });

            $(document).on('click', '#ClosePopup', function() {
                $('#sharePopup').addClass('hidden');
            });

            //for copy share link
            $(document).on("click", ".ClicktoCopy", function(e) {
                e.preventDefault();
                var copyText = $('input[name="url"]');
                copyText.select();
                document.execCommand('copy');
            });
        });
    </script>
    <!------------------------------------------------share end ---------------------------------------->



    @yield('scripts')

    <script>
        $('#doc-button').hover(
            function() {
                $('#doc-tooltip').stop(true, true).fadeIn();
            },
            function() {
                $('#doc-tooltip').stop(true, true).fadeOut();
            }
        );

        $('#guide-button').hover(
            function() {
                $('#guide-tooltip').stop(true, true).fadeIn();
            },
            function() {
                $('#guide-tooltip').stop(true, true).fadeOut();
            }
        );
    </script>
    <script>
    $('.closeiframe-btn').on('click', function(event) {
        event.preventDefault();
        $('.account').addClass('hidden');
    });
</script>
</body>

</html>