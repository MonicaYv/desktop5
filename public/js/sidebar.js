
//manage sidebar
const currentPath = window.location.pathname.split("/").pop() || 'dashboard';
    const sidebarLinks = document.querySelectorAll('.sidebar a');
for (let i = 0; i < sidebarLinks.length; i++) {
    const link = sidebarLinks[i];
    const linkPath = link.getAttribute('href').split("/").pop() || 'dashboard';
    if (linkPath === currentPath) {
        // console.log(currentPath, linkPath);
        link.classList.add('active');
        const dropMenu = link.closest('.drop-menu');
        if (dropMenu) {
            dropMenu.classList.add('active');
        }
        break;
    }
}

function toggleDropMenu(target) {
    target.classList.toggle('active')
}

//sub dropdown toggle
function toggleSubDropMenu() {
    const subDrop = document.getElementById("subdrop-menu");
    const arrow = document.querySelector("#starred-link .subdrop-right-arrow");
    subDrop.classList.toggle("hidden");
    arrow.classList.toggle("rotate");
}


//clouddash js
const dropdownButtons = document.querySelectorAll(".dropdown-button");
     const dropdownMenus = document.querySelectorAll(".dropdown-menu");
     const dropdownTitles = document.querySelectorAll(".div-title");
     const dropdownItems = document.querySelectorAll(".dropdown-item");

// Iterate over each button to add event listeners
dropdownButtons.forEach((button, index) => {
    const menu = dropdownMenus[index];
    
    const title = dropdownTitles[index];
    button.addEventListener("click", function (event) {
        event.stopPropagation();

        // Close any other open dropdown menus
        dropdownMenus.forEach((otherMenu, otherIndex) => {
            if (otherIndex !== index) {
                otherMenu.classList.add("hidden");
            }
        });

        // Toggle the current menu
        menu.classList.toggle("hidden");
    });

    // Iterate over each dropdown item to update the title text
    menu.querySelectorAll(".dropdown-item").forEach((dropdownItem) => {
        dropdownItem.addEventListener("click", function (event) {
            event.stopPropagation();
            title.innerHTML = this.textContent;
            menu.classList.add("hidden");
        });
    });
});

// Close the dropdown if clicked outside
document.addEventListener("click", function () {
    dropdownMenus.forEach(menu => {
        if (!menu.classList.contains("hidden")) {
            menu.classList.add("hidden");
        }
    });
});

    // handling the add modal
      const Modal = document.getElementById('modal');

        function showModal(){
            Modal.classList.remove('hidden');
        }
        function hideModal(){
            Modal.classList.add('hidden');
        }