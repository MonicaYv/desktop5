<html>
<head>
</head>
  <body class="fullscreencontent">

    <div class="file-manager  w-full h-screen">

      <div class="file-container w-full bg-no-repeat bg-center bg-cover">
        <nav class="logo-container h-20 px-10 py-3">
          <a href="{{ route('dashboard') }}"><img class="w-12 h-12" src="{{ asset($constants['IMAGEFILEPATH'].'logo.png')}}" alt="logo" /></a>
        </nav>
        <div class="content-container w-full flex">
          <div class="sidebar w-1/4 md:1/4 lg:w-1/6 h-full bg-no-repeat bg-cover bg-center flex flex-col">
            <div class="px-10 py-7 mt-10">
              <h1 class="text-base">Favourites</h1>
            </div>
            <nav class="mt-2">
              <ul class="grid gap-2">
                <li>
                  <a id="link-desktop"
                    class="flex items-center gap-3 rounded-r-md py-2 text-sm hover:text-orange-500 data-[active=true]:text-orange-500 hover:bg-black data-[active=true]:bg-black data-[active=true]:font-semibold"
                    href="{{ url('/filemanager',['path'=>urlencode('/Desktop')]);}}"
                  >
                    <span class="text-base font-normal px-10">Desktop</span>
                  </a>
                </li>
                <li>
                  <a id="link-recent"
                    class="flex items-center gap-3 rounded-r-md py-2 text-sm hover:text-orange-500 data-[active=true]:text-orange-500 hover:bg-black data-[active=true]:bg-black data-[active=true]:font-semibold"
                    href="{{ url('/filemanager',['path'=>urlencode('/Gallery')]);}}"
                  >
                    <span
                      class="text-base font-normal px-10"
                    >
                      Gallery
                    </span>
                  </a>
                </li>
                <li>
                  <a id="link-downloads"
                    class="flex items-center gap-3 rounded-r-md py-2 text-sm hover:text-orange-500 data-[active=true]:text-orange-500 transition-colors hover:bg-black data-[active=true]:bg-black data-[active=true]:font-semibold"
                    href="{{ url('/filemanager',['path'=>urlencode('/Download')]);}}"
                  >
                    <span
                      class="text-base font-normal px-10"
                    >
                      Downloads
                    </span>
                  </a>
                </li>
                <!--<li>-->
                <!--  <a  id="link-filemanager"-->
                <!--    class="flex items-center gap-3 rounded-r-md py-2 text-sm hover:text-orange-500 data-[active=true]:text-orange-500transition-colors hover:bg-black data-[active=true]:bg-black data-[active=true]:font-semibold"-->
                <!--    href="filemanager.html"-->
                <!--  >-->
                <!--    <span-->
                <!--      class="text-base font-normal px-10"-->
                <!--    >-->
                <!--      App-->
                <!--    </span>-->
                <!--  </a>-->
                <!--</li>-->
                <li>
                  <a id="link-documents"
                    class="flex items-center gap-3 rounded-r-md py-2 text-sm hover:text-orange-500 data-[active=true]:text-orange-500 transition-colors hover:bg-black data-[active=true]:bg-black data-[active=true]:font-semibold"
                    href="{{ url('/filemanager',['path'=>urlencode('/Document')]);}}"
                  >
                    <span
                      class="text-base font-normal px-10"
                    >
                      Documents
                    </span>
                  </a>
                </li>
                <li>
                  <a id="link-applications"
                    class="flex items-center gap-3 rounded-r-md  py-2 text-sm hover:text-orange-500 data-[active=true]:text-orange-500 transition-colors hover:bg-black data-[active=true]:bg-black data-[active=true]:font-semibold"
                    href="applications.html"
                  >
                    <span
                      class="text-base font-normal px-10"
                    >
                      Applications
                    </span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="content-showing w-3/4 md:3/4 lg:w-5/6 h-full">
            <div class="yellowbar w-full h-16 bg-no-repeat bg-cover">
              <div class="flex items-center p-4 gap-5 relative">
                <div
                  class="flex flex-2 items-center gap-4 h-8 bg-white p-1 rounded-sm"
                >
                  <a href="#"><i class="ri-arrow-left-line"></i></a>
                  <!--<i class="ri-arrow-right-line"></i>-->
                </div>
                <div
                  class="flex items-center justify-between flex-1 h-8 bg-white p-1 rounded-sm"
                >
                  <div class="flex items-center gap-4">
                    <a href="#"><i class="ri-arrow-up-line"></i></a>
                    <h5>{{ $path }}</h5>
                  </div>
                  <div class="flex items-center gap-4">
                    <i class="ri-star-line"></i>
                    <i class="ri-refresh-line"></i>
                  </div>
                </div>
                <input
                  class="p-1 outline-none rounded-sm"
                  type="search"
                  placeholder="Search"
                />
                <i id="searchicon" class="ri-search-line absolute"></i>
              </div>
            </div>
            
            <!--optionbar -->
            <div class="transparent pl-5 border-b border-color-gray4 w-full h-16 bg-no-repeat bg-cover border-t border-gray-300">
              <div class="flex items-center p-4 gap-8 relative">
                <div class="relative">
                    
                  <button class="flex items-center gap-2 newfiledropdown">
                    <i class="ri-add-circle-fill text-xl"></i></i>
                    <span class="text-lg">New</span><i class="ri-arrow-down-s-line text-xs -ml-1 -mt-2"></i> 
                  </button>
                  <div class="absolute mt-2 hidden bg-white shadow-lg rounded-md newfiledropdownoption">
                    <ul class="py-1">
                      <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer">
                        <i class="ri-file-text-line"></i>
                        <span class="ml-2">TXT</span>
                      </li>
                      <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer">
                        <i class="ri-file-word-line"></i>
                        <span class="ml-2">Word</span>
                      </li>
                    </ul>
                  </div>
                </div>
                <button class="flex items-center gap-2">
                  <i class="ri-upload-line text-xl"></i>
                  <span class="text-lg">Upload</span>
                </button>
                <i class="ri-scissors-line text-xl cursor-pointer"></i>
                <i class="ri-file-copy-line text-xl cursor-pointer"></i>
                <i class="ri-clipboard-line text-xl cursor-pointer"></i>
                <i class="ri-edit-line text-xl cursor-pointer"></i>
                <i class="ri-share-line text-xl cursor-pointer"></i>
                <i class="ri-delete-bin-line text-xl cursor-pointer"></i>
              </div>
            </div>
            
            <!--optiobarend -->
            
            <div class="content w-full loaddetails" id="filemanagerapplist">
              
            </div>
          </div>
        </div>
      </div>
     </div>
    </body>
    </html>

