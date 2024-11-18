<!DOCTYPE html>
@extends('layouts.common')
@section('title', 'Dashboard')
@section('styles')
<link rel="stylesheet" href="{{ asset($constants['CSSFILEPATH'].'dashbord.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset($constants['CSSFILEPATH'].'filemanager.css') }}"> -->

@endsection
@section('content')
<body class="w-full h-screen">

    <div class="w-full h-full dashboard cs pt-20">

      <!-- Desktop apps   -->
        <div class="desktopapps-div w-full overflow-x-auto">
            <div id="desktopapps" class="desktop-apps allapplist p-2 pt-3 w-min h-full flex flex-col gap-1 flex-wrap">
               
            </div>
        </div>

        <!-- Clock -->
       <div class="clock flex flex-col items-center gap-2" id="clock"></div>

        <!-- Notification -->
        <div id="notification" class="Notification h-80 absolute right-5 sm:right-20 top-16 hidden overflow-hidden">
          <div class="h-16 border-b-2 border-c-gray py-4 px-4 flex items-center justify-between">
            <h1 class="text-sm sm:text-lg text-c-black font-normal">Notification Center</h1>
            <h1 class="text-sm sm:text-lg text-c-yellow font-medium cursor-pointer">Mark all as read</h1>
          </div>
          <div class="scrollbar-div overflow-y-auto" style="height: calc(100% - 64px);">
            <!-- <ul>
              <li class="border-b-2 border-c-gray px-4 py-2.5">
                <div class="flex items-start justify-between gap-20">
                  <p class="text-sm text-c-black font-normal">Sara Martin mentioned you in a React for dark and light mode </p>
                  <i class="ri-close-circle-fill ri-1x cursor-pointer"></i>
                </div>
                <span class="text-c-time font-normal text-sm">5 min ago</span>
              </li>
               <li class="border-b-2 border-c-gray px-4 py-2.5">
                <div class="flex items-start justify-between gap-20">
                  <p class="text-sm text-c-black font-normal">Ralph Edwards completed Improve workflow mode</p>
                  <i class="ri-close-circle-fill ri-1x cursor-pointer"></i>
                </div>
                <span class="text-c-time font-normal text-sm">2 min ago</span>
              </li>
               <li class="border-b-2 border-c-gray px-4 py-2.5">
                <div class="flex items-start justify-between gap-20">
                  <p class="text-sm text-c-black font-normal">Arjun Mathur has sent you a request on facebook</p>
                  <i class="ri-close-circle-fill ri-1x cursor-pointer"></i>
                </div>
                <span class="text-c-time font-normal text-sm">Just now</span>
              </li>
               <li class="border-b-2 border-c-gray px-4 py-2.5">
                <div class="flex items-start justify-between gap-20">
                  <p class="text-sm text-c-black font-normal">Robert Fox completed Create new components</p>
                  <i class="ri-close-circle-fill ri-1x cursor-pointer"></i>
                </div>
                <span class="text-c-time font-normal text-sm">2 hours ago</span>
              </li>
            </ul> -->
          </div>
        </div>

        <!-- Search Input -->
        <div id="search" class="Search hidden fixed top-60 sm:top-72 md:top-80 lg:top-64">
          <div class="row">
              <i class="ri-search-line search-icon absolute"></i>
               <input type="search" id="searchInput" placeholder="Search">
            <i class="ri-close-line cross-icon absolute"></i>
          </div>
            <div id="searchsuggestions" class="searchdata hidden px-3 py-3 max-h-96">
            </div>
        </div>

         <!-- Right Sidebar -->
         <div class="dashboard-sidebar w-16 px-2 hidden sm:block">
            @foreach ($apps as $app)
                <a href="#" class="{{ $app->app_function=='add_app' ? 'openiframe' :''}}" data-title="{{ $app->name }}" data-url="{{ url('/') }}/lightapp" data-image="{{ asset($constants['APPFILEPATH'].$app->icon)}}"  ><img class="mb-2" src="{{  asset($constants['APPFILEPATH'].$app->icon ) }}" alt="{{ $app->name }}" /></a>
            @endforeach
        </div>

<!-- Administrator -->
     <div id="administrator" class="Administrator h-max absolute right-5 sm:right-28 bottom-20 hidden">
          <div class="flex items-center gap-5 pl-10 py-5">
            <div class="logo">
              <img class="w-16" src="{{ asset($constants['IMAGEFILEPATH'].'profile.png') }}" alt="user image" />
            </div>
            <div class="user-info">
              <h1 class="text-lg font-normal underline underline-offset-8 decoration-1">
                Administrator
              </h1>
              <h4 class="text-sm">Username</h4>
            </div>
          </div>
          <div class="bottom border-t-2 border-gray-500">
            <div class="features-list py-5 px-16">
              <ul>
                <li class="flex items-center gap-8 mb-4">
                 <i class="ri-folder-3-fill ri-1x Ad-iconcolor"></i>
                  <a href="{{ route('filemanager') }}">File manage</a>
                </li>
               <li class="flex items-center gap-8 mb-4">
                  <i class="ri-bar-chart-fill ri-1x Ad-iconcolor"></i>
                  <a href="{{ route('useradmin') }}">Backend</a>
                </li>
                <li class="flex items-center gap-8 mb-4">
                  <i class="ri-user-fill ri-1x Ad-iconcolor"></i>
                  <a href="{{ route('useradmin') }}">User manage</a>
                </li>
                <li class="flex items-center gap-5 mb-4">
                  <i class="ri-download-2-line ri-1x Ad-iconcolor"></i>
                  <a href="#">Downloads</a>
                </li>
                <li class="flex items-center gap-8 mb-4">
                  <i class="ri-logout-box-r-line ri-1x Ad-iconcolor"></i>
                  <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
<!-- Administrator end -->

         <!-- Footer -->
        <div class="absolute bottom-4 right-4 px-5">
            <img
              id="footer-logo"
              class="w-10 h-10"
              src="{{ asset($constants['IMAGEFILEPATH'].'logo.png') }}"
              alt="Logo"
            />
        </div>

     
     
    </div>
@endsection
@section('scripts')
@php 
$path = base64UrlEncode('Desktop');
@endphp 
<script>
      const desktopapp = @json(route('desktopapp'));
      const createFolderRoute = @json(route('createfolder'));
      const createFileRoute = @json(route('createfile'));
      const showFileDetail = @json(route('showpathdetail'));

      let path = @json($path);

</script>
<script>
   
    
      // Dynamically adding Desktop apps
    //   const container = document.querySelector(".desktop-apps");
    //   const Desktopapps = [
        
    //   ];

    //   Desktopapps.forEach((app) => {
    //     const appDiv = document.createElement("div");
    //     appDiv.setAttribute("data-app-id", app.id);
    //     appDiv.className = "app w-20 h-32 cursor-pointer relative";
    //     appDiv.innerHTML = `
    //                 <div class="app-tools absolute top-0 left-1 flex items-center justify-between gap-8 py-0.5 px-1 invisible">
    //                     <input type="checkbox" name="option">
    //                     <i class="ri-arrow-drop-down-fill ri-xl text-black"></i>
    //                 </div>  
    //                 <div class="text-center flex flex-col items-center px-1 pt-5" onclick="handleClick()">
    //                     <img class="w-16" src="${app.image}" alt="${app.name}">
    //                        <div class="input-wrapper w-16">
    //                           <input type="text" class="text-center text-white appinputtext" disabled value="${app.name}">
    //                       </div>
    //                 </div>
                            
    //   `;
        // container.appendChild(appDiv);

        appDiv.addEventListener("click", (event) => {
          event.stopPropagation();
          const checkbox = appDiv.querySelector('input[type="checkbox"]');
          if (checkbox) {
            checkbox.checked = !checkbox.checked;
          }
        });

       // Add a click event listener directly to the checkbox as well
        const checkbox = appDiv.querySelector('input[type="checkbox"]');
        if (checkbox) {
          checkbox.addEventListener("click", (event) => {
            // Prevent the click from also triggering the parent appDiv's event
            event.stopPropagation();
          });
        }
      

       //Right Click Functionality
      document.addEventListener("DOMContentLoaded", function () {
        const appContextMenu = document.getElementById("app-contextmenu");
        const dashboardContextMenu = document.getElementById("context-menu");
        const dashboard = document.querySelector(".dashboard");
        const appDivs = document.querySelectorAll(".app");
        const arrowIcons = document.querySelectorAll(".app-tools i");

        // Function to position and show a menu
        function positionAndShowMenu(menu, event) {
          menu.style.display = "block";
          menu.style.visibility = "hidden";

          // Calculate positions and available space
          const menuRect = menu.getBoundingClientRect();
          const viewportWidth = window.innerWidth;
          const viewportHeight = window.innerHeight;

          // Initial positioning: Prioritize placing the menu to the right
          let top = event.clientY;
          let left = event.clientX;

          // Check if there's enough space on the right, accounting for a small margin
          if (left + menuRect.width + 10 < viewportWidth) {
            // If so, place it on the right
          } else {
            // If not enough space on the right, place it on the left
            left -= menuRect.width;
          }
          

          // Adjust if overflowing at the top
          if (top + menuRect.height > viewportHeight) {
            // Try placing above first
            top = event.clientY - menuRect.height;
            if (top < 0) {
              // If still overflowing, adjust to fit below
              top = Math.max(0, viewportHeight - menuRect.height);
            }
          }

          // Ensure the menu is within the screen
          top = Math.max(0, top);
          left = Math.max(0, left);

          menu.style.top = `${top}px`;
          menu.style.left = `${left}px`;

          // Recursive positioning for submenus (using the updated logic)
          menu.style.visibility = "visible"; // Make the menu visible
          menu.classList.remove("hidden");
          menu.style.display = "block";
        }
      
        // Show submenu on hover
        document.querySelectorAll(".context-menu li").forEach((item) => {
          item.addEventListener("mouseenter", function () {
            const submenu = this.querySelector(".submenu");
            if (submenu) {
              submenu.classList.remove("hidden");
              submenu.style.display = "block";

           // Adjust submenu position
              const submenuRect = submenu.getBoundingClientRect();
              const screenWidth = window.innerWidth;
              const screenHeight = window.innerHeight;

              // Handle right overflow
              if (submenuRect.right > screenWidth) {
                submenu.style.left = `-${submenuRect.width}px`;
              }

              // Handle left overflow
              if (submenuRect.left < 50) {
                submenu.style.left = `${this.offsetWidth}px`;
              }

              // Handle bottom overflow
              if (submenuRect.bottom > screenHeight) {
                submenu.style.top = `-${submenuRect.height - this.offsetHeight}px`;
              }

              // Handle top overflow
              if (submenuRect.top < 0) {
                submenu.style.top = `${this.offsetHeight}px`;
              }
            }
          });

          item.addEventListener("mouseleave", function () {
            const submenu = this.querySelector(".submenu");
            if (submenu) {
              submenu.classList.add("hidden");
              submenu.style.display = "none";
            }
          });
        });

        // Right-click on App Div to show App Context Menu
        appDivs.forEach((appDiv) => {
          let timeoutId;

          appDiv.addEventListener("mouseenter", () => {
            timeoutId = setTimeout(() => {
              const appPropertiesDiv = appDiv.querySelector(".app-properties");
              appPropertiesDiv.classList.remove("invisible");
            }, 1500); // 1500 milliseconds = 1.5 seconds
          });

          appDiv.addEventListener("mouseleave", () => {
            clearTimeout(timeoutId);
            const appPropertiesDiv = appDiv.querySelector(".app-properties");
            appPropertiesDiv.classList.add("invisible");
          
          });

          appDiv.addEventListener("contextmenu", (event) => {
            event.preventDefault();
            dashboardContextMenu.classList.add("hidden"); // Ensure dashboard menu is hidden
            dashboardContextMenu.style.display = "none";
            positionAndShowMenu(appContextMenu, event);
          });
        });

        // Left-click on Arrow Icon to show App Context Menu
        arrowIcons.forEach((icon) => {
          icon.addEventListener("click", (event) => {
            event.stopPropagation();
            dashboardContextMenu.classList.add("hidden"); // Ensure dashboard menu is hidden
            dashboardContextMenu.style.display = "none";
            positionAndShowMenu(appContextMenu, event);
          });
        });

        // Right-click on Dashboard (not on App Div) to show Dashboard Context Menu
        dashboard.addEventListener("contextmenu", (event) => {
          const target = event.target;
          if (!target.classList.contains("app") && !target.closest(".app")) {
            event.preventDefault();
            appContextMenu.classList.add("hidden"); // Ensure app menu is hidden
            appContextMenu.style.display = "none";
            positionAndShowMenu(dashboardContextMenu, event);
          }
        });

        // Click anywhere to hide menus
        document.addEventListener("click", (event) => {
          if (
            !event.target.closest("#app-contextmenu") &&
            !event.target.closest("#context-menu")
          ) {
            appContextMenu.classList.add("hidden");
            dashboardContextMenu.classList.add("hidden");
            appContextMenu.style.display = "none";
            dashboardContextMenu.style.display = "none";
          }
        });

        // Prevent the context menu from closing when clicking inside the context menu
        [appContextMenu, dashboardContextMenu].forEach((menu) => {
          menu.addEventListener("click", (event) => {
            event.stopPropagation();
          });
        });

      });


       //Clock Functionality
      function updateClock() {
        const clock = document.getElementById("clock");
        const now = new Date();

        const hours = String(now.getHours()).padStart(2, "0");
        const minutes = String(now.getMinutes()).padStart(2, "0");

        const days = [
          "Sunday",
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
        ];
        const months = [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ];
        const day = days[now.getDay()];
        const month = months[now.getMonth()];
        const date = now.getDate();

        const timeString = `${hours}:${minutes}`;
        const dateString = `${day}, ${month} ${date}`;

        clock.innerHTML = `<div class="time text-c-white text-5xl font-normal">${timeString}</div><div class="date text-sm flex font-normal">${dateString}</div>`;
      }

      updateClock();
      setInterval(updateClock, 60000);

       //Notification container Functionality
      document
        .getElementById("notification-icon")
        .addEventListener("click", function () {
          const notificationDiv = document.getElementById("notification");
          notificationDiv.classList.toggle("hidden");
        });

      //Search Contiainer Functionality
      document
        .getElementById("search-icon")
        .addEventListener("click", function () {
          const searchDiv = document.getElementById("search");
          searchDiv.classList.toggle("hidden");
        });
      const searchInput = document.getElementById("searchInput");
      const suggestions = document.getElementById("suggestions");
      const Search = document.querySelector(".Search")

      searchInput.addEventListener("input", function () {
    if (searchInput.value.length > 0) {
      suggestions.classList.remove("hidden");
      Search.classList.add("open");
    } else {
      suggestions.classList.add("hidden");
      Search.classList.remove("open");
    }
  });
  
      document
        .querySelector(".cross-icon")
        .addEventListener("click", function () {
          searchInput.value = "";
          suggestions.classList.add("hidden");
          Search.classList.remove("open");
          document.getElementById("search").classList.add("hidden");
        });

       //Administrator Container Functionality
      document
        .getElementById("footer-logo")
        .addEventListener("click", function () {
          const administratorDiv = document.getElementById("administrator");
          administratorDiv.classList.toggle("hidden");
        });

      // draggble clock functionality
    dragElement(document.getElementById("clock"));

    function dragElement(element) {
      let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
      element.onmousedown = dragMouseDown;

      function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
      }

      function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;

        // set the element's new position:
        const newTop = element.offsetTop - pos2;
        const newLeft = element.offsetLeft - pos1;

        // prevent the element from being dragged out of the screen
        const minTop = 0;
        const maxTop = window.innerHeight - element.offsetHeight;
        const minLeft = 0;
        const maxLeft = window.innerWidth - element.offsetWidth;

        element.style.top = Math.min(Math.max(newTop, minTop), maxTop) + "px";
        element.style.left = Math.min(Math.max(newLeft, minLeft), maxLeft) + "px";
      }

      function closeDragElement() {
        // stop moving when mouse button is released:
        document.onmouseup = null;
        document.onmousemove = null;
      }
    }

    //functionality of hidden container when outside click

     document.addEventListener("DOMContentLoaded", function () {
  const containers = {
    notification: document.getElementById("notification"),
    search: document.getElementById("search"),
    administrator: document.getElementById("administrator")
  };

  function closeAllContainers() {
    for (let key in containers) {
      containers[key].classList.add("hidden");
    }
  }

  document.getElementById("notification-icon").addEventListener("click", function (event) {
    event.stopPropagation();
    closeAllContainers();
    containers.notification.classList.toggle("hidden");
  });

  document.getElementById("search-icon").addEventListener("click", function (event) {
    event.stopPropagation();
    closeAllContainers();
    containers.search.classList.toggle("hidden");
  });

  document.getElementById("footer-logo").addEventListener("click", function (event) {
    event.stopPropagation();
    closeAllContainers();
    containers.administrator.classList.toggle("hidden");
  });

  document.addEventListener("click", function (event) {
    if (!event.target.closest("#notification") && !event.target.closest("#search") && !event.target.closest("#administrator")) {
      closeAllContainers();
    }
  });
});

</script>
   
@endsection
