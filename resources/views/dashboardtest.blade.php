<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
      <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      href="https://unpkg.com/tailwindcss@^2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="root.css">
    <link rel="stylesheet" href="style/cs.css">
</head>
<body class="w-full h-screen dashboard cs">
    <div class="w-full h-full">

      <!-- Right click Menu -->
      <div id="context-menu" class="context-menu hidden">
        <ul>
          <li class="flex items-center justify-between px-2">
            <a href="#">Refresh</a>
            <p class="menu-sidename">F5</p>
          </li>
          <li class="border-b-2 px-2"><a href="#">Upload file</a></li>
          <li class="px-2"><a href="#">New folder</a></li>
          <li class="flex items-center justify-between px-2">
            <a href="#">New file</a>
            <i class="ri-arrow-right-s-line"></i>
            <ul
              class="submenu newfile-submenu absolute shadow-md rounded-md hidden"
            >
              <li class="flex items-center px-5">
                <img src="/images/txt-file.png" alt="text-file" />
                <a href="#">txt file</a>
              </li>
              <li class="flex items-center px-5">
                <img src="/images/md-file.png" alt="md-file" />
                <a href="#">md file</a>
              </li>
              <li class="flex items-center px-5 border-b-2">
                <img src="/images/html-file.png" alt="html file" />
                <a href="#">html file</a>
              </li>
              <li class="flex items-center px-5">
                <img class="w-5 h-5" src="/images/docx.png" alt="word-file" />
                <a href="#">Word docx file</a>
              </li>
              <li class="flex items-center px-5">
                <img class="w-5 h-5" src="/images/xlsx.png" alt="excel-file" />
                <a href="#">Excel xlsx file</a>
              </li>
              <li class="flex items-center px-5 border-b-2">
                <img
                  class="w-5 h-5"
                  src="/images/pptx.png"
                  alt="powerpoint-file"
                />
                <a href="#">PowerPoint pptx</a>
              </li>
              <li class="flex items-center px-5 border-b-2">
                <img
                  class="w-5 h-5"
                  src="/images/MinderImg.png"
                  alt="minder-img"
                />
                <a href="#">Minder diagram</a>
              </li>
              <li class="flex items-center px-5">
                <img
                  class="w-5 h-5"
                  src="/images/lightapp.png"
                  alt="lightapp"
                />
                <a href="#">Light app</a>
              </li>
              <li class="flex items-center px-5">
                <img src="/images/chrome-img.png" alt="Chrome" />
                <a href="#">New URL</a>
              </li>
              <li class="flex items-center px-5">
                <img src="/images/sharedfolder-img.png" alt="file-shortcut" />
                <a href="#">File shortcut</a>
              </li>
            </ul>
          </li>
          <li class="flex items-center justify-between px-2">
            <a href="#">Sort by</a>
            <i class="ri-arrow-right-s-line"></i>
            <ul
              class="submenu sortby-submenu absolute shadow-md rounded-md hidden"
            >
              <li class="flex items-center pl-4 gap-2">
                <i class="ri-check-line"></i>
                <a href="#">Name</a>
              </li>
              <li class="flex items-center pl-10"><a href="#">Type</a></li>
              <li class="flex items-center pl-10"><a href="#">Size</a></li>
              <li class="flex items-center pl-10 border-b-2"><a href="#">Modification</a></li>
              <li class="flex items-center pl-4 gap-2">
                 <i class="ri-check-line"></i>
                <a href="#">Increasing</a>
              </li>
              <li class="flex items-center pl-10"><a href="#">Decrement</a></li>
            </ul>
          </li>
          <li class="flex items-center justify-between px-2">
            <a href="#">Icon size</a>
            <i class="ri-arrow-right-s-line"></i>
            <ul
              class="submenu iconsize-submenu absolute shadow-md rounded-md hidden"
            >
              <li class="flex items-center px-5">
                <i class="ri-function-add-line ri-xs"></i>
                <a href="#">Tiny</a>
              </li>
              <li class="flex items-center px-5">
                <i class="ri-function-add-line ri-sm"></i>
                <a href="#">Small icon</a>
              </li>
              <li class="flex items-center px-5">
                <i class="ri-function-add-line ri-1x"></i>
                <a href="#">Medium icon</a>
              </li>
              <li class="flex items-center px-5">
                <i class="ri-function-add-line ri-lg"></i>
                <a href="#">Big icon</a>
              </li>
              <li class="flex items-center px-5">
                <i class="ri-function-add-line ri-xl"></i>
                <a href="#">Oversized icon</a>
              </li>
            </ul>
          </li>
          <li class="px-2"><a href="#">Attribute</a></li>
          <li class="flex items-center justify-between px-2">
            <a href="#">More</a>
            <i class="ri-arrow-right-s-line"></i>
            <ul
              class="submenu more-submenu absolute shadow-md rounded-md hidden"
            >
              <li class="flex items-center border-b-2 px-5">
                <i class="ri-equalizer-line"></i>
                <a href="#">Show options</a>
              </li>
              <li class="flex items-center px-5">
                <i class="ri-arrow-go-back-line"></i>
                <a href="#">Revoke</a>
              </li>
              <li class="flex items-center px-5">
                <i class="ri-arrow-go-forward-line"></i>
                <a href="#">Anti-revocation</a>
              </li>
            </ul>
          </li>
          <li class="px-2"><a href="#">Light app</a></li>
          <li class="flex items-center justify-between px-2">
            <a href="#">Wallpaper</a>
            <p class="menu-sidename">Alt+I</p>
          </li>
          <li class="px-2"><a href="#">Personal</a></li>
        </ul>
      </div>

        <!-- Apps context-menu -->
      <div id="app-contextmenu" class="context-menu hidden">
        <ul>
          <li class="flex items-center justify-between px-2">
            <a href="#">Open</a>
            <p class="menu-sidename">Enter</p>
          </li>
          <li class="border-b-2 flex items-center justify-between px-2">
            <a href="#">Open with</a>
            <i class="ri-arrow-right-s-line"></i>
            <ul
              class="submenu open-submenu absolute shadow-md rounded-md hidden"
            >
              <li class="pl-5 flex items-center">
                <i class="ri-settings-3-line"></i>
                <a href="#">Open with default</a>
              </li>
              <li class="pl-5 flex items-center">
                <img src="/images/online-editior.png" alt="online-editior" />
                <a href="#">Only office online editior</a>
              </li>
              <li class="pl-5 flex items-center">
                <img src="/images/google-docs.png" alt="google-docs" />
                <a href="#">Google docs</a>
              </li>
              <li class="pl-5 flex items-center">
                <img src="/images/chrome-img.png" alt="chrome" />
                <a href="#">Open with browser</a>
              </li>
            </ul>
          </li>
          <li class="flex items-center justify-between px-2">
            <a href="#">Download</a>
            <p class="menu-sidename">Shift+Enter</p>
          </li>
          <li class="flex items-center justify-between px-2">
            <a href="#">Link sharing</a>
          </li>
          <li class="flex items-center justify-between px-2">
            <a href="#">Copy</a>
            <p class="menu-sidename">Ctrl+C</p>
          </li>
          <li class="flex items-center justify-between px-2">
            <a href="#">Cut</a>
            <p class="menu-sidename">Ctrl+X</p>
          </li>
          <li class="flex items-center justify-between px-2">
            <a href="#">Rename</a>
            <p class="menu-sidename">F2</p>
          </li>
          <li class="flex items-center justify-between px-2">
            <a href="#">Delete</a>
            <p class="menu-sidename">Del</p>
          </li>
          <li class="flex items-center justify-between px-2">
            <a href="#">File tag</a>
            <i class="ri-arrow-right-s-line"></i>
            <ul
              class="submenu filetag-submenu absolute shadow-md rounded-md hidden"
            >
              <li class="pl-5 flex items-center">
                <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                <a href="#">Study</a>
              </li>
              <li class="pl-5 flex items-center">
                <div class="w-3 h-3 bg-purple-400 rounded-full"></div>
                <a href="#">Test data</a>
              </li>
              <li class="pl-5 flex items-center">
                <div class="w-3 h-3 bg-blue-700 rounded-full"></div>
                <a href="#">Contract</a>
              </li>
              <li class="pl-5 flex items-center">
                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                <a href="#">2020</a>
              </li>
              <li class="pl-5 flex items-center border-b-2">
                <div class="w-3 h-3 bg-purple-300 rounded-full"></div>
                <a href="#">Test</a>
              </li>
              <li class="pl-5 flex items-center border-b-2">
                <i class="ri-add-circle-line"></i>
                <a href="#">Add</a>
              </li>
              <li class="pl-5 flex items-center">
                <i class="ri-edit-box-line"></i>
                <a href="#">Tag edit</a>
              </li>
            </ul>
          </li>
          <li class="flex items-center justify-between px-2">
            <a href="#">Attribute</a>
            <p class="menu-sidename">Alt+I</p>
          </li>
          <li class="flex items-center justify-between px-2">
            <a href="#">More</a>
            <i class="ri-arrow-right-s-line"></i>
            <ul
              class="submenu appmore-submenu absolute shadow-md rounded-md hidden"
            >
              <li class="pl-5 flex items-center">
                <i class="ri-star-line"></i>
                <a href="#">Star</a>
              </li>
              <li class="pl-5 flex items-center">
                <i class="ri-lock-2-line"></i>
                <a href="#">Edit lock</a>
              </li>
              <li class="pl-5 flex items-center">
                <i class="ri-pushpin-2-line"></i>
                <a href="#">Move top</a>
              </li>
              <li class="pl-5 flex items-center">
                <i class="ri-file-copy-2-line"></i>
                <a href="#">Create a copy</a>
              </li>
              <li class="pl-5 flex items-center">
                <i class="ri-code-s-slash-line"></i>
                <a href="#">Embedded file</a>
              </li>
              <li class="pl-5 flex items-center">
                <i class="ri-file-shred-line"></i>
                <a href="#">Create shortcut</a>
              </li>
              <li class="pl-5 flex items-center">
                <i class="ri-file-zip-line"></i>
                <a href="#">Compress</a>
                <i class="ri-arrow-right-s-line ml-10"></i>
                <ul
                  class="submenu compress-submenu absolute shadow-md rounded-md hidden"
                >
                  <li class="pl-5 flex items-center">
                    <i class="ri-file-zip-line"></i>
                    <a href="#">ZIP file</a>
                  </li>
                  <li class="pl-5 flex items-center">
                    <i class="ri-file-zip-line"></i>
                    <a href="#">TAR file</a>
                  </li>
                  <li class="pl-5 flex items-center">
                    <i class="ri-file-zip-line"></i>
                    <a href="#">GZIP file</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>

      <!-- Navbar -->
        <div class="navbar h-12 pr-8 flex items-center justify-end gap-8 ">
            <i id="search-icon" class="ri-search-line icon-color"></i>
            <i id="notification-icon" class="ri-notification-3-line icon-color"></i>
            <i class="ri-wifi-line icon-color"></i>
            <i class="ri-volume-up-fill icon-color"></i>
            <i class="ri-battery-low-line icon-color"></i>
        </div>

      <!-- Desktop apps   -->
        <div class="desktopapps-div w-full overflow-x-auto">
            <div class="desktop-apps p-2 pt-3 w-min h-full flex flex-col gap-1 flex-wrap">
               
            </div>
        </div>

        <!-- Clock -->
       <div class="clock flex flex-col items-center gap-2" id="clock"></div>

        <!-- Notification -->
        <div id="notification" class="Notification h-56 rounded-lg absolute right-5 sm:right-20 top-16 hidden">
          <div class="border-b-2 border-c-gray p-5 text-center">
            <h1 class="text-normal font-normal">Notification Center</h1>
          </div>
          <div class="flex items-center justify-center p-4 text-c-light-black">
            <p>Empty</p>
          </div>
        </div>

        <!-- Search Input -->
        <div id="search" class="Search hidden fixed top-60 sm:top-72 md:top-80 lg:top-64">
          <div class="row">
              <i class="ri-search-line search-icon absolute"></i>
               <input type="search" id="searchInput" placeholder="Search">
            <i class="ri-close-line cross-icon absolute"></i>
          </div>
            <div id="suggestions" class="searchdata hidden px-3 py-3 max-h-96">
              <div class="test-file p-3">
                <ul>
                  <li class="flex items-center gap-4">
                    <img class="w-8 h-8" src="/images/Docs.png" alt="" />
                    <p>Test File</p>
                  </li>
                  <li class="flex items-center gap-4">
                    <img class="w-8 h-8" src="/images/Docs.png" alt="" />
                    <p>Test File</p>
                  </li>
                  <li class="flex items-center gap-4">
                    <img class="w-8 h-8" src="/images/Docs.png" alt="" />
                    <p>Test File</p>
                  </li>
                  <li class="flex items-center gap-4">
                    <img class="w-8 h-8" src="/images/Docs.png" alt="" />
                    <p>Test File</p>
                  </li>
                </ul>
              </div>
              <div class="image-file border-t border-c-dark-gray mt-1 p-3">
                <h1 class="text-xl font-medium mb-2">Images</h1>
                <ul>
                  <li class="flex items-center gap-4">
                    <img class="w-8 h-8" src="/images/imageviewer.png" alt="" />
                    <p>Image File</p>
                  </li>
                  <li class="flex items-center gap-4">
                    <img class="w-8 h-8" src="/images/imageviewer.png" alt="" />
                    <p>Image File</p>
                  </li>
                  <li class="flex items-center gap-4">
                    <img class="w-8 h-8" src="/images/imageviewer.png" alt="" />
                    <p>Image File</p>
                  </li>
                  <li class="flex items-center gap-4">
                    <img class="w-8 h-8" src="/images/imageviewer.png" alt="" />
                    <p>Image File</p>
                  </li>
                </ul>
              </div>
            </div>
        </div>

         <!-- Right Sidebar -->
        <div class="dashboard-sidebar w-16 px-2 hidden sm:block">
          <img class="mb-2 mt-4" src="/images/Dairy.png" alt="Dairy" />
          <img class="mb-2" src="/images/Calendar.png" alt="Calendar" />
          <img class="mb-2" src="/images/Appstore.png" alt="Appstore" />
          <img class="mb-4" src="/images/EmptyBin.png" alt="EmptyBin" />
        </div>

         <!-- Administrator -->
        <div id="administrator" class="Administrator h-max absolute right-5 sm:right-28 bottom-20 hidden">
          <div class="flex items-center gap-5 pl-10 py-5">
            <div class="logo">
              <img class="w-16" src="/images/profile.png" alt="user image" />
            </div>
            <div class="user-info">
              <h1
                class="text-2xl font-normal underline underline-offset-8 decoration-1"
              >
                Administrator
              </h1>
              <h4 class="text-sm pt-1">Username</h4>
            </div>
          </div>
          <div class="bottom border-t border-c-dark-gray mt-5">
            <div class="features-list py-4 px-16">
              <ul>
                <li class="flex items-center gap-8 mb-3">
                  <i class="ri-folder-3-fill ri-1x Ad-iconcolor"></i>
                  <a class="text-sm" href="#">File manage</a>
                </li>
                <li class="flex items-center gap-8 mb-3">
                  <i class="ri-bar-chart-fill ri-1x Ad-iconcolor"></i>
                  <a class="text-sm" href="#">Backend</a>
                </li>
                <li class="flex items-center gap-8 mb-3">
                  <i class="ri-user-fill ri-1x Ad-iconcolor"></i>
                  <a class="text-sm" href="#">User manage</a>
                </li>
                <li class="flex items-center gap-8 mb-3">
                  <i class="ri-layout-grid-fill ri-1x Ad-iconcolor"></i>
                  <a class="text-sm" href="#">Plugin</a>
                </li>
                <li class="flex items-center gap-8 mb-3">
                  <i class="ri-global-line ri-1x Ad-iconcolor"></i>
                  <a class="text-sm" href="#">Language</a>
                </li>
                <li class="flex items-center gap-8 mb-3">
                  <i class="ri-fullscreen-fill ri-1x Ad-iconcolor"></i>
                  <a class="text-sm" href="#">Full screen</a>
                </li>
                <li class="flex items-center gap-8 mb-3">
                  <i class="ri-information-fill ri-1x Ad-iconcolor"></i>
                  <a class="text-sm" href="#">About</a>
                </li>
                <li class="flex items-center gap-8 mb-3">
                  <i class="ri-download-2-line ri-1x Ad-iconcolor"></i>
                  <a class="text-sm" href="#">Downloads</a>
                </li>
                <li class="flex items-center gap-8 mb-3">
                  <i class="ri-mail-line ri-1x Ad-iconcolor"></i>
                  <a class="text-sm" href="#">Free edition</a>
                </li>
              </ul>
            </div>
          </div>
        </div>

         <!-- Footer -->
        <div class="absolute bottom-4 right-4 px-5">
            <img
              id="footer-logo"
              class="w-10 h-10"
              src="/images/logo.png"
              alt="Logo"
            />
        </div>

    </div>

    <script>

      // Dynamically adding Desktop apps
      const container = document.querySelector(".desktop-apps");
      const Desktopapps = [
        {
          id: 1,
          name: "Operation log",
          image: "/images/operationotes.png",
          url: "",
        },
        {
          id: 2,
          name: "Light App",
          image: "/images/lightapp.png",
          url: "",
        },
        {
          id: 3,
          name: "My Albums",
          image: "/images/album.png",
          url: "",
        },
        {
          id: 4,
          name: "Excel",
          image: "/images/excel.png",
          url: "https://snappy.sizaf.com/example/editor?fileName=new.xlsx&userid=uid-1&lang=en&directUrl=false",
        },
        {
          id: 5,
          name: "PPT",
          image: "/images/ppt.png",
          url: "https://snappy.sizaf.com/example/editor?fileName=new.pptx&userid=uid-1&lang=en&directUrl=false",
        },
        {
          id: 6,
          name: "Help",
          image: "/images/about.png",
          url: "",
        },
        {
          id: 7,
          name: "iCloud",
          image: "/images/icloud.png",
          url: "https://www.icloud.com",
        },
        {
          id: 8,
          name: "Dots ERP",
          image: "/images/ERPNext.png",
          url: "http://erp.sizaf.com/app",
        },
        {
          id: 9,
          name: "Dots Chat",
          image: "/images/logo-dots-chat.png",
          url: "https://zulip.sizaf.com/",
        },
        {
          id: 10,
          name: "Word",
          image: "/images/docx.png",
          url: "https://snappy.sizaf.com/example/editor?fileName=new.docx&userid=uid-1&lang=en&directUrl=false",
        },
        {
          id: 11,
          name: "Open Social App",
          image: "/images/opensociallogo.png",
          url: "https://social.sizaf.com/html/user/login",
        },
        {
          id:12,
          name:"New Folder",
          image:"/images/desktop-folder.png",
          url:""
        }
        
        
      ];

      Desktopapps.forEach((app) => {
        const appDiv = document.createElement("div");
        appDiv.className = "app w-20 h-32 cursor-pointer relative";
        appDiv.innerHTML = `
                    <div class="app-tools absolute top-0 left-1 flex items-center justify-between gap-8 py-0.5 px-1 invisible">
                        <input type="checkbox" name="option">
                        <i class="ri-arrow-drop-down-fill ri-xl text-black"></i>
                    </div>  
                    <div class="text-center flex flex-col items-center px-1 pt-5">
                        <img class="w-16" src="${app.image}" alt="${app.name}">
                           <div class="input-wrapper w-16">
                              <input type="text" class="text-center text-white appinputtext" disabled value="${app.name}">
                          </div>
                    </div>
                            
      `;
        container.appendChild(appDiv);

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
      });

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

        clock.innerHTML = `<div class="time text-c-white text-3xl md:text-5xl font-normal">${timeString}</div><div class="date text-sm md:text-base flex font-normal">${dateString}</div>`;
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
    </script>
</body>
</html>