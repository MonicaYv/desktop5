

// start right click
const container = $(".allapplist");
const appDiv = $(".allapplist .app");
appDiv.on("click", (event) => {
  event.stopPropagation();
  const checkbox = appDiv.find('input[type="checkbox"]');
  if (checkbox.length) {
    checkbox.prop("checked", !checkbox.prop("checked"));
  }
});

const checkbox = appDiv.find('input[type="checkbox"]');
if (checkbox.length) {
  checkbox.on("click", (event) => {
    event.stopPropagation();
  });
}



// Right Click Functionality
$(document).ready(function () {
  const appContextMenu = $("#app-contextmenu");
  const dashboardContextMenu = $("#context-menu");
  const dashboard = $(".allapplist .dashboard");
  const appDivs = $(".allapplist .app");
  const arrowIcons = $(".allapplist .app-tools i");

  // Function to position and show a menu
  function positionAndShowMenu(menu, event) {
    closeAllContainers();
    menu.css("display", "block").css("visibility", "hidden");
    // Calculate positions and available space

    const menuRect = menu[0].getBoundingClientRect();
    const viewportWidth = $(window).width();
    const viewportHeight = $(window).height();

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

    menu.css({
      top: top + "px",
      left: left + "px",
      visibility: "visible"
    }).removeClass("hidden").css("display", "block");

  }
  // Show submenu on hover
  $(document).on('mouseenter', '.context-menu li', function () {
    const submenu = $(this).find(".submenu");

    if (submenu.length) {
      submenu.removeClass("hidden").css("display", "block");

      // Adjust submenu position
      const submenuRect = submenu[0].getBoundingClientRect();
      const screenWidth = $(window).width();
      const screenHeight = $(window).height();

      // Handle right overflow
      if (submenuRect.right > screenWidth) {
        submenu.css("left", `-${submenuRect.width}px`);
      }

      // Handle left overflow
      if (submenuRect.left < 50) {
        submenu.css("left", `${$(this).outerWidth()}px`);
      }

      // Handle bottom overflow
      if (submenuRect.bottom > screenHeight) {
        submenu.css("top", `-${submenuRect.height - $(this).outerHeight()}px`);
      }

      // Handle top overflow
      if (submenuRect.top < 0) {
        submenu.css("top", `${$(this).outerHeight()}px`);
      }
    }
  });

  $(document).on('mouseleave', '.context-menu li', function () {
    const submenu = $(this).find(".submenu");
    if (submenu.length) {
      submenu.addClass("hidden").css("display", "none");
    }
  });

  $(document).on('click', '.context-menu li', function () {
    $("#app-contextmenu").addClass("hidden").css("display", "none");
    $("#context-menu").addClass("hidden").css("display", "none");

  });

  function closeAllContainers(except = null) {
    appContextMenu.hide();
    dashboardContextMenu.hide();
  }

  $(document).on("click", function (event) {
    if (!$(event.target).closest("#NotiContainer").length &&
      !$(event.target).closest("#search").length &&
      !$(event.target).closest("#administrator").length) {
      closeAllContainers();
    }
  });

  $(document).on("contextmenu", function (event) {
    event.preventDefault();

    const target = $(event.target);



    if (target.closest(".allapplist .app").length) {
      let contexttypes = target.closest(".allapplist .app").attr('data-option');
      $('.fimanagertoolpanel').addClass('disabledicon');

      // select app
      let thisApp = target.closest('.allapplist .app');
      let selectapp = target.closest(".allapplist .app .openiframe");
      $('.allapplist .app .selectapp').removeClass("selectedfile");
      $('.allapplist .app').removeClass("desktopapp-clicked");
      $('.allapplist .app .app-tools').addClass("invisible");
      $('.allapplist .app .appcheckbox').prop('checked', false);
      selectapp.addClass('selectedfile');
      thisApp.addClass('desktopapp-clicked');
      let filetype = selectapp.data('filetype');
      if (filetype == 'folder' || filetype == 'file') {
        $('.fimanagertoolpanel').removeClass('disabledicon');
      }
      // end selection
      contextMenuList(contexttypes);
      positionAndShowMenu(appContextMenu, event);
    } else if (target.closest(".allapplist").length) {
      contextMenuList('rightclick');
      $('.allapplist .app').removeClass("desktopapp-clicked");
      $('.allapplist .app .selectapp').removeClass("selectedfile");
      $('.fimanagertoolpanel').addClass('disabledicon');
      positionAndShowMenu(dashboardContextMenu, event);
    } else {
      closeAllContainers();
    }
  });

  $(document).on('click', '.allapplist .app-tools i', function (event) {
    event.stopPropagation();
    $('.fimanagertoolpanel').addClass('disabledicon');
    // select app
    let thisApp = $(this).closest('.app');
    let selectapp = $(this).closest('.openiframe');
    $('.allapplist .app .selectapp').removeClass("selectedfile");
    $('.allapplist .app').removeClass("desktopapp-clicked");
    $('.allapplist .app .app-tools').addClass("invisible");
    $('.allapplist .app .appcheckbox').prop('checked', false);
    selectapp.addClass('selectedfile');
    thisApp.addClass('desktopapp-clicked');
    let filetype = selectapp.data('filetype');
    if (filetype == 'folder' || filetype == 'file') {
      $('.fimanagertoolpanel').removeClass('disabledicon');
    }
    let contexttypes = $(this).closest(".app").attr('data-option');
    contextMenuList(contexttypes);

    // Hide dashboard context menu
    $('#context-menu').addClass('hidden').css('display', 'none');
    // Show the app context menu and position it
    positionAndShowMenu(appContextMenu, event);
  });


  $(document).on("click", function () {
    closeAllContainers();
  });
});

//// end right click
/// desktop apps
desktoplightapp();
function desktoplightapp(sort_by = null, sort_order = null) {
  const data = {};
  if (sort_by) {
    data.sort_by = sort_by;
  }
  if (sort_order) {
    data.sort_order = sort_order;
  }
  $.ajax({
    url: desktopapp,
    method: 'GET',
    data: data,
    success: function (response) {
      // Update the app list container with the updated list
      $('.desktop-apps').html(response.html);
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });


}
function showapathdetail(path, sort_by = null, sort_order = null) {
  const data = {};
  data.path = path
  if (sort_by) {
    data.sort_by = sort_by;
  }
  if (sort_order) {
    data.sort_order = sort_order;
  }
  $.ajax({
    url: showFileDetail,
    method: 'GET',
    data: data,
    success: function (response) {
      // Update the app list container with the updated list
      $('.loaddetails').html(response.html);
      $('.sortingcheck').addClass('hidden');
      $('.sorting' + sort_by + '-' + sort_order).removeClass('hidden');
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });


}


/// Desktop app end
//contextMenuList
function contextMenuList(type) {
  $.ajax({
    url: contextmenu,
    method: 'GET',
    data: { type: type },
    success: function (response) {
      if (type == 'rightclick') {
        $('#context-menu').html(response.html);
      } else {
        $('#app-contextmenu').html(response.html);
      }

    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });

}

/// end context menu
/// file functions
$(document).on('click', '.context-menulist .refreshButton', function (e) {
  e.preventDefault();
  e.stopPropagation();
  location.reload();
});
$(document).on('click', '.context-menulist .createFolderFunction', function (e) {
  e.preventDefault();
  e.stopPropagation();
  createFolderFunction();
});
$(document).on('click', '.context-menulist .createFileFunction', function (e) {
  e.preventDefault();
  e.stopPropagation();
  let filetype = $(this).data('type');
  createFileFunction(filetype);
});

$(document).on('click', '.context-menulist .resizeFunction', function (e) {
  e.preventDefault();
  e.stopPropagation();
  let filetype = $(this).data('type');
  $('.allapplist .app').addClass(filetype);
});
$(document).on('click', '.context-menulist .sortFunction', function (e) {
  e.preventDefault();
  e.stopPropagation();
  let filetype = $(this).data('type');
  filetypearr = filetype.split('-');
  desktoplightapp(filetypearr[0], filetypearr[1]);
  showapathdetail(path, filetypearr[0], filetypearr[1]);
});

$(document).on('click', '.context-menulist .resizeFunction', function (e) {
  e.preventDefault();
  e.stopPropagation();
  let filetype = $(this).data('type');
  let sizeclasses = ['tiny', 'small', 'big', 'medium', 'oversize'];
  sizeclasses.forEach(element => {
    $('.allapplist .app').removeClass(element + '-wraper');
    $('.allapplist .app .imagewraper').removeClass(element);
  });
  $('.allapplist .app').addClass(filetype + '-wraper');
  $('.allapplist .app .imagewraper').addClass(filetype);
});

//listview function
$(document).on('click', '.context-menulist .listFunction', function (e) {     
  showapathdetail(path, 1);
});

//detailsview function
$(document).ready(function() {
  $(document).on('click', '.context-menulist .detailsFunction', function (e) {
      e.preventDefault(); 
      togglePanel('detail');
  });
});

//preview function
$(document).ready(function() {
  $(document).on('click', '.context-menulist .previewFunction', function (e) {
      e.preventDefault(); 
      togglePanel('preview');
  });
});


//click on file/folder checkbox

let previouslyCheckedId = null;
$(document).on('click', '.appcheckbox', function (e) { 
    e.stopPropagation();
    
    const checkboxId = $(this).attr('id');
    const encodedId = checkboxId.replace('checkboxfolder', '').replace('checkboxdocument', '').replace('checkboxsystemapp', '');

    // If a different checkbox is clicked, uncheck the previously checked one
    if (previouslyCheckedId && previouslyCheckedId !== encodedId) {
        // Clear the previously checked checkbox
        $('#checkboxfolder' + previouslyCheckedId).prop('checked', false);
        $('#checkboxdocument' + previouslyCheckedId).prop('checked', false);
        $('#checkboxsystemapp' + previouslyCheckedId).prop('checked', false);
        previouslyCheckedId = null;  // Reset previous checked ID
    }

    if ($(this).is(':checked')) {
        // Checkbox is checked, send encodedId
        previouslyCheckedId = encodedId;  // Store the checked id
        console.log('Checked ID:', encodedId);
        showFiledetails(path, encodedId);
    } else {
        // Checkbox is unchecked, send false or blank
        console.log('Unchecked, sending blank or false');
        showFiledetails(path, false);  
        previouslyCheckedId = null;  // Clear id when unchecked
    }
});


// app menus

// open app by rightclick
$(document).on('click', '.context-menulist .openFunction', function (e) {
  e.preventDefault();
  e.stopPropagation();
  if ($('.selectedfile').hasClass('openiframe')) {
    const appkey = $('.selectedfile').attr('data-appkey');
    const filekey = $('.selectedfile').attr('data-filekey');
    const filetype = $('.selectedfile').attr('data-filetype');
    const apptype = $('.selectedfile').attr('data-apptype');
    const originalIcon = $('.selectedfile').find('.icondisplay');
    const imgicon = $('#iframeheaders #iframeiconimage' + filetype + appkey);
    animateIcon(imgicon, originalIcon, function () {
      const iframedata = { appkey: appkey, filekey: filekey, filetype: filetype, apptype: apptype };
      openiframe(iframedata)
    });
  } else {
    let url = $('.selectedfile').attr('href');
    window.location.href = url;
  }
  $('.selectapp').removeClass('.selectedfile');
});

// open app by dblclick
$(document).on('dblclick', '.allapplist .selectapp', function (e) {
  e.preventDefault();

  if ($(this).hasClass('customfunction')) {
    const customfunction = this.getAttribute('data-customfunction');
    customfunctions();
  }
  else {
      if ($(this).hasClass('openiframe')) {
        const appkey = this.getAttribute('data-appkey');
        const filekey = this.getAttribute('data-filekey');
        const filetype = this.getAttribute('data-filetype');
        const apptype = this.getAttribute('data-apptype');
        const originalIcon = $(this).find('.icondisplay');
        const imgicon = $('#iframeheaders #iframeiconimage' + filetype + appkey);
        animateIcon(imgicon, originalIcon, function () {
          const iframedata = { appkey: appkey, filekey: filekey, filetype: filetype, apptype: apptype };
          openiframe(iframedata);

        });
      } else {
        let url = $(this).attr('href');
        window.location.href = url;
      }
    }
});

function customfunctions() {
  $('.popupiframe').removeClass('hidden').addClass('show');
}

// $(document).on('dblclick', '.dashboardefaultdapp .selectapp', function (e) {
//     e.preventDefault();
//     if($(this).hasClass('openiframe')){
//         const appkey = this.getAttribute('data-appkey');
//         const filekey = this.getAttribute('data-filekey');
//         const filetype = this.getAttribute('data-filetype');
//         const apptype = this.getAttribute('data-apptype');
//         const originalIcon = $(this).find('.icondisplay');
//         const imgicon =  $('#iframeheaders #iframeiconimage'+filetype+appkey);
//         animateIcon(imgicon, originalIcon, function() {
//             const iframedata = {appkey:appkey,filekey:filekey,filetype:filetype,apptype:apptype};
//             openiframe(iframedata);

//         });
//      }
// });



// cut file
// rename
$(document).on('click', '.context-menulist .renameFunction', function (e) {
  e.preventDefault();
  const filekey = $('.selectedfile').attr('data-filekey');
  const filetype = $('.selectedfile').attr('data-filetype');

  // Target the input elements based on filekey and filetype
  const inputWrapper = $('#inputWrapper' + filetype + filekey);
  const inputField = $('#inputField' + filetype + filekey);

  // Modify the input field for renaming
  inputField.removeClass('text-white').addClass('text-black');
  inputField.removeAttr('disabled').removeClass('appinputtext').show().focus();

  // Handle click outside the input to finalize renaming
  $(document).one('click', function (event) {
    if (!inputWrapper.is(event.target) && inputWrapper.has(event.target).length === 0) {
      // Disable the input field and add the necessary classes back
      inputField.attr('disabled', true).addClass('appinputtext');
      $('.openiframe').removeClass('selectedfile');

      // Call the rename function with the new name
      renameFunction(filekey, filetype, inputField.val());
    }
  });

  // Stop the propagation to avoid immediate closing
  inputWrapper.on('click', function (event) {
    event.stopPropagation();
  });
});


// $(document).one('click', function(event) {
//     const filekey = $('.selectedfile').attr('data-filekey');
//     const filetype = $('.selectedfile').attr('data-filetype');
//             /// rename
//     const inputWrapper = $('#inputWrapper'+filetype+filekey);
//     const inputField = $('#inputField'+filetype+filekey);
//     if (!inputWrapper.is(event.target) && inputWrapper.has(event.target).length === 0) {
//         inputField.attr('disabled'," ");
//         inputField.addClass('appinputtext');
//         $('.selectapp').removeClass('.selectedfile');
//         renameFunction(filekey,filetype,inputField.val());

//         // Update text display with input value
//     }
// });
//// cut copy paste

$(document).on('click', '.context-menulist .copyFunction', function (e) {
  e.preventDefault();
  const filekey = $('.selectedfile').attr('data-filekey');
  const filepath = $('.selectedfile').attr('data-path');
  const filetype = $('.selectedfile').attr('data-filetype');
  copyFunction(filepath, 'copy', filetype, filekey);
  $('.selectapp').removeClass('.selectedfile');
});


$(document).on('click', '.context-menulist .deleteFunction', function (e) {
  e.preventDefault();


  const filekey = $('.selectedfile').attr('data-filekey');
  const appkey = $('.selectedfile').attr('data-appkey');
  const filepath = $('.selectedfile').attr('data-path');
  const filetype = $('.selectedfile').attr('data-filetype');
  const fileid = this.getAttribute('data-iframefile-id');
  const apptype = $('.selectedfile').attr('data-apptype');

  // to add type dynamically
  /*let type = 'RecycleBin';*/

  deleteFunction(filekey, filetype);
  closeiframe(appkey, filekey, fileid, apptype);
  $('.selectapp').removeClass('.selectedfile');
});

$(document).on('click', '.context-menulist .restoreFunction', function (e) {
  e.preventDefault();

  const filekey = $('.selectedfile').attr('data-filekey');

  const fileid = this.getAttribute('data-iframefile-id');

  restoreFunction(filekey, fileid);
  closeiframe(filekey, fileid);
  $('.selectapp').removeClass('.selectedfile');
});


/*$(document).on('click', '.restoreAdminFunction', function (e) {
 e.preventDefault();
 alert('user');
     const filekey = $('.selectedfile').attr('data-filekey');

     const fileid = this.getAttribute('data-iframefile-id');

     restoreAdminFunction(filekey,fileid);
     closeiframe(filekey,fileid);
     $('.selectapp').removeClass('.selectedfile');
   });*/


/*$(document).on('click', '.restoreAdminFunction', function (e) {
  e.preventDefault();


  $.ajax({
    url: restoreAdminRoute,
    method: 'GET',
    data: {},
    success: function (response) {
    
      $('.loaddetails').html(response.html);

    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
});*/

$(document).on('click', '.context-menulist .cutFunction', function (e) {
  e.preventDefault();
  const filekey = $('.selectedfile').attr('data-filekey');
  const filepath = $('.selectedfile').attr('data-path');
  const filetype = $('.selectedfile').attr('data-filetype');
  copyFunction(filepath, 'cut', filetype, filekey);
  $('.selectapp').removeClass('.selectedfile');
});
$(document).on('click', '.context-menulist .pasteFunction', function (e) {
  e.preventDefault();
  pasteFunction(path);
});

// Minimize button functionality
$(document).on('click', '#alliframelist .minimizeiframe-btn', function () {
  var iframeId = $(this).data('iframe-id');
  var iframePopup = $('#alliframelist #iframepopup' + iframeId);
  const iframe = $('#alliframelist #iframepopup' + iframeId);
  if (!iframe.hasClass('minimized')) {
    iframe.addClass("minimized");
    iframe.removeClass("fall-down");
    minimized = true;
    setTimeout(() => {
      //    iframe.addClass("hidden");
    }, 600);
  }

});

// Close button functionality
$(document).on('click', '#alliframelist .closeiframe-btn', function (e) {
  e.preventDefault();
  e.stopPropagation();
  const appkey = this.getAttribute('data-appkey');
  const filekey = this.getAttribute('data-filekey');
  const filetype = this.getAttribute('data-filetype');
  const fileid = this.getAttribute('data-iframefile-id');
  const apptype = this.getAttribute('data-apptype');
  closeiframe(appkey, filekey, fileid, apptype);

});

// Close button functionality
$(document).on('click', '#iframeheaders .popup .iframefilepopupclosebtn', function (e) {
  e.preventDefault();
  e.stopPropagation();
  const appkey = this.getAttribute('data-appkey');
  const filekey = this.getAttribute('data-filekey');
  const filetype = this.getAttribute('data-filetype');
  const fileid = this.getAttribute('data-iframefile-id');
  const apptype = this.getAttribute('data-apptype');
  closeiframe(appkey, filekey, fileid, apptype);
});



// Maximize button functionality
$(document).on('click', '#alliframelist .maximizeiframe-btn', function () {
  var iframeId = $(this).data('iframe-id');
  var iframePopup = $('#alliframelist #iframepopup' + iframeId);
  iframePopup.toggleClass('maximized');
  let pinIcon = $('#pinned');
  if (iframePopup.hasClass('maximized')) {
    if (pinIcon.hasClass('ri-unpin-line')) {
      iframePopup.removeClass('reduced-height')

    } else {
      iframePopup.addClass('reduced-height')
    }
  }
});


/// click iframe icon
$(document).on('click', '#iframeheaders .iframemainheadericon', function () {
  var iframeId = $(this).data('iframe-id');
  var iframefileId = $(this).data('iframefile-id');
  let img = $(this).find('.app-icon');
  $('#iframeheaders .parentiframe .iframetabselement').addClass('hidden');

  /// animation close
  var popupcount = $(this).data('popup-count');
  if (popupcount > 1) {
    $('#iframeheaders #iframetab' + iframeId).removeClass('hidden');
  } else {
    let iframetabs = $('#alliframelist #iframepopup' + iframefileId);
    if (iframetabs.hasClass('fall-down')) {
      iframetabs.addClass('minimized');
      iframetabs.removeClass('fall-down');
    } else {
      iframetabs.removeClass('hidden');
      iframetabs.removeClass('minimized');
      if (!iframetabs.hasClass('fall-down')) {
        iframetabs.addClass('fall-down');

      }
    }
  }

});

let isHoveringPopup = false;
let isPopupClicked = false;

// Mouseenter: Show popup when hovering
$(document).on('mouseenter', '#iframeheaders .iframemainheadericon', function () {
  var iframeId = $(this).data('iframe-id');
  var popupcount = $(this).data('popup-count');
  if (popupcount > 1) {
    $('#iframeheaders #iframetab' + iframeId).removeClass('hidden');
  }
});

// Mouseleave: Hide popup if not clicked
$(document).on('mouseleave', '#iframeheaders .iframemainheadericon', function () {
  var iframeId = $(this).data('iframe-id');
  var popupcount = $(this).data('popup-count');
  if (popupcount > 1 && !isPopupClicked) {
    $('#iframeheaders #iframetab' + iframeId).addClass('hidden');
  }
});

// Click: Keep popup open when clicking the icon
$(document).on('click', '#iframeheaders .iframemainheadericon', function (event) {
  isPopupClicked = true; // Set flag to keep popup open
  event.stopPropagation(); // Prevent click from closing the popup immediately
});

// Close popup when clicking anywhere outside the icon or the popup
$(document).on('click', function (event) {
  // Check if the click is outside of the popup and icon
  if (!$(event.target).closest('#iframeheaders, .iframemainheadericon').length) {
    isPopupClicked = false; // Reset the flag
    $('.iframetab').addClass('hidden'); // Hide the popup
  }
});



/// click iframe icon
$(document).on('click', '#iframeheaders .iframemainheaderpopup', function (e) {
  e.preventDefault();
  var iframeId = $(this).data('iframe-id');
  var iframefileId = $(this).data('iframefile-id');
  //var popupcount = $(this).data('popup-count');

  $('#alliframelist #iframepopup' + iframefileId).removeClass('hidden');
  $('#alliframelist #iframepopup' + iframefileId).removeClass('minimized');
  $('#alliframelist #iframepopup' + iframefileId).addClass('fall-down');
  console.log('#iframeheaders #iframetab' + iframeId);
  $('#iframeheaders #iframetab' + iframeId).addClass('hidden');
  // if(!$('#alliframelist #iframepopup'+iframefileId).hasClass('show')){
  //     $('#alliframelist #iframepopup'+iframefileId).removeClass('show');

  // }


});

/// animate function
function animateIcon(icon, originalIcon, callback) {
  const $originalIcon = $(originalIcon);
  const $toolbar = $('#iframeheaders');
  const rect = $originalIcon[0].getBoundingClientRect();
  const toolbarRect = $toolbar[0].getBoundingClientRect();
  const toolbarCenterX = toolbarRect.left + (toolbarRect.width / 2) - (rect.width / 2);
  const toolbarCenterY = toolbarRect.top + (toolbarRect.height / 2) - (rect.height / 2);

  const moveX = toolbarCenterX - rect.left;
  const moveY = toolbarCenterY - rect.top;

  const $clone = $originalIcon.clone();
  $clone.css({
    position: 'fixed',
    left: `${rect.left}px`,
    top: `${rect.top}px`,
    width: `${rect.width}px`,
    height: `${rect.height}px`,
    'z-index': 9999,
    '--move-x': `${moveX}px`,
    '--move-y': `${moveY}px`
  });
  $clone.addClass('moving-to-top');
  $('body').append($clone);

  $clone.on('animationend', function () {
    $clone.remove();
    // $toolbar.append(icon);
    animateIconToCenter(icon);
    if (callback) callback();
  });
}

function animateIconToCenter(icon) {
  const $icon = $(icon);
  $icon.css('opacity', 0);
  setTimeout(() => {
    $icon.css({
      transition: 'opacity 0.5s, transform 0.5s',
      opacity: 1,
      transform: 'translateY(0)'
    });
  }, 10);
}


/// Upload files
$(document).on('click', '.context-menulist .uploadFiles', function (e) {
  e.preventDefault();
  $('#popupuploadfiles').removeClass('hidden');
});
$('#close-popup').on('click', function (e) {
  e.preventDefault();
  $('#popupuploadfiles').addClass('hidden');
});



function createFolderFunction() {
  $.ajax({
    url: createFolderRoute,
    method: 'GET',
    data: { parentFolder: path },
    success: function (response) {
      if (response.status) {
        toastr.success(response.message);

      } else {
        toastr.error(response.message);
      }
      desktoplightapp();
      showapathdetail(path);
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}
function createFileFunction(filetype) {
  $.ajax({
    url: createFileRoute,
    method: 'GET',
    data: { destination: path, filetype: filetype },
    success: function (response) {
      if (response.status) {
        toastr.success(response.message);

      } else {
        toastr.error(response.message);
      }
      desktoplightapp();
      showapathdetail(path);
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}
openiframe();
function openiframe(data) {

  $.ajax({
    url: openIframeRoute,
    method: 'GET',
    data: data,
    success: function (response) {
      // Update the app list container with the updated list
      if (response.status) {
        closeallpopup();
        $('#alliframelist').html(response.html);
        $('#sortable-apps').html(response.html2);

        if (response.filekey != '') {
          $('#alliframelist #' + response.filekey).removeClass('hidden');
          $('#alliframelist #' + response.filekey).addClass('show');
        }
      } else {
        toastr.error(response.message);
      }


    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}

function closeiframe(appkey, filekey, fileid, apptype) {
  $('#alliframelist #iframepopup' + fileid).removeClass('hidden');
  $.ajax({
    url: closeIframeRoute,
    method: 'GET',
    data: { appkey: appkey, filekey: filekey, apptype: apptype },
    success: function (response) {
      // Update the app list container with the updated list
      $('#alliframelist').html(response.html);
      $('#sortable-apps').html(response.html2);
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}

function copyFunction(filepath, type, filetype, filekey) {
  $.ajax({
    url: copyRoute,
    method: 'GET',
    data: { filepath: filepath, type: type, filekey: filekey, filetype: filetype },
    success: function (response) {
      if (response.status) {
        toastr.success(response.message);
        $('.pastefileButton').removeClass('hidden');
      } else {
        toastr.error(response.message);
      }
      desktoplightapp();
      showapathdetail(path);

    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });

}
function renameFunction(filekey, filetype, name) {
  $.ajax({
    url: renameroute,
    method: 'GET',
    data: { filekey: filekey, filetype: filetype, name: name },
    success: function (response) {
      if (response.status) {
        toastr.success(response.message);

      } else {
        toastr.error(response.message);
      }
      desktoplightapp();
      showapathdetail(path);

    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}

$(document).on('click', '.context-menulist .shareFunction', function (e) {
  e.preventDefault();
  const filekey = $('.selectedfile').attr('data-filekey');
  const filepath = $('.selectedfile').attr('data-path');
  const filetype = $('.selectedfile').attr('data-filetype');
  // shareFunction(filepath,'share',filetype,filekey);
  shareFunction(filetype, filekey, 'share');
  $('.selectapp').removeClass('.selectedfile');
});

function shareFunction(filetype, filekey) {
  $.ajax({
    type: "GET",
    url: shareRoute,
    data: {
      filetype: filetype,
      filekey: filekey
    },
    success: function (response) {
      // console.log(response.html);
      $('#shareFilesFolderModal').html(response.html);
      // $('#sharePopup').removeClass('hidden');
    }
  });
}


function deleteFunction(filekey, filetype) {

  $.ajax({
    url: deleteRoute,
    method: 'GET',
    data: { filekey: filekey, filetype: filetype },
    success: function (response) {
      if (response.status) {
        desktoplightapp();
        showapathdetail(path);
        toastr.success(response.message);


      } else {
        toastr.error(response.message);
      }


    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}

function restoreFunction(filekey, fileid) {

  $.ajax({
    url: restoreRoute,
    method: 'GET',
    data: { filekey: filekey, fileid: fileid },
    success: function (response) {
      if (response.status) {
        desktoplightapp();
        showapathdetail(path);
        toastr.success(response.message);
        parent.location.reload();




      } else {
        toastr.error(response.message);
      }


    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}

//admin user deleted


function sortFunction() {

}
function pasteFunction(filepath) {
  $.ajax({
    url: pasteRoute,
    method: 'GET',
    data: { path: filepath },
    success: function (response) {
      if (response.status) {
        toastr.success(response.message);
        $('.pastefileButton').addClass('hidden');
      } else {
        toastr.error(response.message);
      }
      desktoplightapp();
      showapathdetail(path);

    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}



/// end file functions


///upload code
$(document).ready(function () {
  $('#dropzone').on('click', function () {
    $('#file-input').click();
  });

  $('#file-input').on('change', function (e) {
    handleFiles(e.target.files);
  });

  $('#dropzone').on('dragover', function (e) {
    e.preventDefault();
    $(this).addClass('bg-gray-200');
  });

  $('#dropzone').on('dragleave', function (e) {
    e.preventDefault();
    $(this).removeClass('bg-gray-200');
  });

  $('#dropzone').on('drop', function (e) {
    e.preventDefault();
    $(this).removeClass('bg-gray-200');
    handleFiles(e.originalEvent.dataTransfer.files);
  });

  function handleFiles(files) {
    if (files.length > 0) {
      $('#file-list-container').removeClass('hidden');
    }
    $('#file-list').empty();
    for (let i = 0; i < files.length; i++) {
      let file = files[i];
      let fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
      let fileRow = $('<tr class="bg-gray-50"></tr>');
      fileRow.append('<td class="py-2 px-4">' + file.name + '</td>');
      fileRow.append('<td class="py-2 px-4">' + fileSize + '</td>');
      let progressBarContainer = $('<td class="py-2 px-4"></td>');
      let progressBar = $('<div class="w-full bg-gray-200 rounded-full h-2.5 relative"><div class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div></div>');
      progressBarContainer.append(progressBar);
      fileRow.append(progressBarContainer);
      $('#file-list').append(fileRow);

      uploadFile(file, progressBar);
    }
  }

  function uploadFile(file, progressBar) {
    let formData = new FormData();
    formData.append('files[]', file);

    $.ajax({
      url: uploadRoute,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      headers: {
        'Upload-Directory': path,
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Specify the directory name here
      },
      xhr: function () {
        let xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener('progress', function (e) {
          if (e.lengthComputable) {
            let percentComplete = (e.loaded / e.total) * 100;
            progressBar.find('div').css('width', percentComplete + '%');
          }
        }, false);
        return xhr;
      },
      success: function (response) {
        progressBar.find('div').css('background-color', 'green');
        progressBar.find('i').removeClass('hidden');
        desktoplightapp();
        showapathdetail(path);
      },
      error: function (error) {
        console.error('Error uploading file:', error);
      }
    });
  }
});

// upload code end


// close all popup
function closeallpopup() {
  $('#search').addClass('hidden');
  $('#administrator').addClass('hidden');
  $('#NotiContainer').addClass('hidden');
  $('#iframeheaders .parentiframe .iframetabselement').addClass('hidden');
}


$(document).on('click', '.leftArrowClick', function (e) {
  let path = $(this).data('path');
  let leftpath = $(this).data('leftpath');
  $.ajax({
    url: leftArrowClick,
    method: 'GET',
    data: { path: path },
    success: function (response) {
      window.location.href = leftpath;

    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
});


$(document).on('click', '.rightArrowClick', function (e) {
  let path = $(this).data('path');
  let leftpath = $(this).data('leftpath');
  $.ajax({
    url: rightArrowClick,
    method: 'GET',
    data: { path: path },
    success: function (response) {
      window.location.href = path;

    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
});


//button press delete
//for keypress delete
$('html').keyup(function (e) {
  if (e.keyCode == 46) {
    //alert('Delete key released');
    const filekey = $('.selectedfile').attr('data-filekey');
    const appkey = $('.selectedfile').attr('data-appkey');
    const filepath = $('.selectedfile').attr('data-path');

    const filetype = $('.selectedfile').attr('data-filetype');
    const fileid = this.getAttribute('data-iframefile-id');

    // to add type dynamically


    deleteFunction(filekey, type);
    closeiframe(appkey, filekey, fileid, filetype);
    $('.selectapp').removeClass('.selectedfile');
  }
});

$(document).ready(function () {
  //For Share Model
  $(document).on('change', '#Users, #Groups, #Roles', function () {
    const targetId = $(this).attr('id');
    if ($(this).is(':checked')) {
      $('#Div' + targetId).show();
    } else {
      $('#Div' + targetId).hide();
    }
  });
  $(document).on('change', '#Everyone', function () {
    if ($(this).is(':checked')) {
      $('#Users, #Groups, #Roles').prop('checked', false);
      $('#DivUsers, #DivGroups, #DivRoles').hide();
    }
  });
  $(document).on('change', '#EditUsers, #EditGroups, #EditRoles', function () {
    const targetId = $(this).attr('id');
    if ($(this).is(':checked')) {
      $('#Div' + targetId).show();
    } else {
      $('#Div' + targetId).hide();
    }
  });
  $(document).on('change', '#EditEveryone', function () {
    if ($(this).is(':checked')) {
      $('#EditUsers, #EditGroups, #EditRoles').prop('checked', false);
      $('#DivUsers, #DivEditGroups, #DivEditRoles').hide();
    }
  });
  $(document).on('click', '#RandomPassword', function () {
    console.log('here');
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let password = '';
    for (let i = 0; i < 6; i++) {
      const randomIndex = Math.floor(Math.random() * characters.length);
      password += characters.charAt(randomIndex);
    }
    $('#Password').val(password);
  });

  $(document).on('click', '#ClosePopup', function () {
    $('#sharePopup').addClass('hidden');
  });

  //for copy share link
  $(document).on("click", ".ClicktoCopy", function (e) {
    e.preventDefault();
    var copyText = $('input[name="url"]');
    copyText.select();
    document.execCommand('copy');
  });

  //for generate qr
  // $(document).on("click", ".showqrcode", function(e) {
  //     var elText = $('input[name="url"]').val();
  //     var qrcode = new QRCode(document.getElementById("qrcode"), {
  //         width: 100,
  //         height: 100,
  //     });

  //     function makeCode() {
  //         qrcode.makeCode(elText);
  //     }
  //     makeCode();
  //     $('#QrCodeModal').removeClass('hidden');
  // });
  // $(document).on("click", ".hideqrmodal", function(e) {
  //     $('#qrcode').html('');
  //     $('#QrCodeModal').addClass('hidden');
  // });
});

//for taskbar option of documention and onscreen guide
$(document).ready(function () {
  const trigger = $('.icon-trigger-dropdown');
  const dropdownMenu = $('.taskbar-dropdown-menu');
  let hideTimeout;

  // Show dropdown on hover
  trigger.on('mouseenter', function () {
    clearTimeout(hideTimeout);
    dropdownMenu.addClass('show');
  });

  trigger.add(dropdownMenu).on('mouseleave', function (e) {
    hideTimeout = setTimeout(function () {
      if (!$(e.relatedTarget).closest('.icon-trigger-dropdown, .taskbar-dropdown-menu').length) {
        dropdownMenu.removeClass('show');
      }
    }, 100);
  });

  dropdownMenu.on('mouseenter', function () {
    clearTimeout(hideTimeout);
  });
});

function checkNotifications() {
  if ($('#ULNoti li').length > 0 && $('#ULNoti li').text().trim() !== 'No new notifications') {
    $('#notification-icon').removeClass('icon-color').addClass('bell');
  } else {
    $('#notification-icon').removeClass('bell').addClass('icon-color');
  }
}

$(document).ready(function () {
  checkNotifications();
});



$(document).on('click', '.ReadThisNoti', function (event) {
    event.stopPropagation();

    var id = $(this).attr('data-id');
    var listItem = $(this).closest('li');
    $.ajax({
        type: "GET",
        url: base_url + "/read-noti/" + id,
        success: function (response) {
            if (response.status === 'success') {
              listItem.remove();

              if ($('#ULNoti li').length === 0) {
                $('#ULNoti').html(`<li class="text-center mt-16">No new notifications</li>`);
                $('#notification-icon').removeClass('bell').addClass('icon-color');
              }
            }
        }
    });
});
$(document).on('click', '#MarkAllRead', function (event) {
  $.ajax({
    type: "GET",
    url: base_url + "/read-all",
    success: function (response) {
      if (response.status === 'success') {
        var html = `<li class="text-center mt-16">
                                No new notifications
                            </li>`;
        $('#notification-icon').removeClass('bell').addClass('icon-color');
        $('#ULNoti').html(html);
      }
    }
  });
});

$(document).on('click','.dismissModel',function(){
    var modal = $(this).closest('.previewmodal');
    if (modal) {
        modal.addClass('hidden');
    }
});

$(document).on('click', '.MarkasRead', function () {
    var modal = $(this).closest('.previewmodal');
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: base_url + "/read-noti/" + id,
        success: function (response) {
            if (response.status === 'success') {
                modal.addClass('hidden');
                $('#ULNoti').find('li').has('span[data-id="' + id + '"]').remove();
            }
        }
    });
});

$(document).on('click', function (event) {
  if (!$(event.target).closest('#NotiContainer').length) {
    $('#NotiContainer').addClass('hidden');
  }
});

//move files and folders
let selectedItems = new Set();

document.addEventListener('click', function(event) {
    const target = event.target.closest('.app'); // Identify file/folder item.
    
    if (target) {
        event.preventDefault();
        const fileKey = target.getAttribute('data-filekey');

        // Multi-select with Ctrl/Meta key
        if (event.ctrlKey || event.metaKey) {
            // Toggle selection
            if (selectedItems.has(fileKey)) {
                selectedItems.delete(fileKey);
                target.classList.remove('selected');
            } else {
                selectedItems.add(fileKey);
                target.classList.add('selected');
            }
        } else {
            // Single selection and clear others
            clearSelection();
            selectedItems.add(fileKey);
            target.classList.add('selected');
        }
    } else {
        // Deselect all if clicked outside the app elements
        clearSelection();
    }
});

function clearSelection() {
    selectedItems.forEach(fileKey => {
        const element = document.querySelector(`.app[data-filekey="${fileKey}"]`);
        if (element) {
            element.classList.remove('selected');
        }
    });
    selectedItems.clear();
}

function drag(event) {
    const targetElement = event.target.closest('.app');
    const fileKey = targetElement.getAttribute('data-filekey');
    const isFolder = targetElement.getAttribute('data-folder') === '1';

    // If no items selected, select the current item being dragged
    if (selectedItems.size === 0) {
        selectedItems.add(fileKey);
        targetElement.classList.add('selected');
    }

    // Separate folderKeys and fileKeys
    let fileKeys = [];
    let folderKeys = [];

    selectedItems.forEach(itemKey => {
        const element = document.querySelector(`.app[data-filekey="${itemKey}"]`);
        const isFolder = element.getAttribute('data-folder') === '1';
        if (isFolder) {
            folderKeys.push(itemKey); // Collect folder keys
        } else {
            fileKeys.push(itemKey); // Collect file keys
        }
    });

    event.dataTransfer.setData("fileKeys", JSON.stringify(fileKeys));
    event.dataTransfer.setData("folderKeys", JSON.stringify(folderKeys));

    console.log("Dragging files:", fileKeys);
    console.log("Dragging folders: ", folderKeys);
}
function drop(event) {
  event.preventDefault();

  const folderElement = event.target.closest('.app[data-folder="1"]');
  const folderPath = folderElement ? folderElement.getAttribute('data-path') : null;

  if (!folderPath) {
      console.error("Target folder not found.");
      return;
  }

  const fileKeysString = event.dataTransfer.getData("fileKeys") || '[]';
  const folderKeysString = event.dataTransfer.getData("folderKeys") || '[]';
  let fileKeys = JSON.parse(fileKeysString);
  let folderKeys = JSON.parse(folderKeysString);

  if (fileKeys.length === 0 && folderKeys.length === 0) {
      console.log("No files or folders to move.");
      return;
  }

  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  fetch(moveUrl, { 
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
          fileKeys: fileKeys,
          folderKeys: folderKeys,
          targetFolder: folderPath
      })
  })
  .then(response => response.json())
  .then(data => {
      if (data.status) {
          toastr.success(data.message);

          // Remove moved items from their current location in the DOM
          fileKeys.forEach(key => {
              const element = document.querySelector(`.app[data-filekey="${key}"]`);
              if (element) {
                  element.remove(); // Remove from the current view
              }
          });
          folderKeys.forEach(key => {
              const element = document.querySelector(`.app[data-filekey="${key}"]`);
              if (element) {
                  element.remove(); // Remove from the current view
              }
          });

          // Re-render the moved items in the new folder
          reRenderMovedItems(fileKeys, folderKeys, folderElement);
      } else {
          console.error('Error moving items:', data.message);
          alert('Error: ' + data.message);
      }
  })
  .catch(error => {
      console.error('Error:', error);
      alert('An unexpected error occurred: ' + error.message);
  });
}


function reRenderMovedItems(fileKeys, folderKeys, targetFolderElement) {
    const targetFolderPath = targetFolderElement.getAttribute('data-path');
    fileKeys.forEach(key => {
        const fileElement = document.querySelector(`.app[data-filekey="${key}"]`);
        if (fileElement) {
            fileElement.setAttribute('data-parentpath', targetFolderPath);
            targetFolderElement.appendChild(fileElement);
        }
    });

    folderKeys.forEach(key => {
        const folderElement = document.querySelector(`.app[data-filekey="${key}"]`);
        if (folderElement) {
            folderElement.setAttribute('data-parentpath', targetFolderPath);
            targetFolderElement.appendChild(folderElement);
        }
    });
}

function allowDrop(event) {
    event.preventDefault();
    event.currentTarget.classList.add('hover');
}

function dragLeave(event) {
    event.currentTarget.classList.remove('hover');
}


