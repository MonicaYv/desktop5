$(document).ready(function () {
    const pinIcon = $('#pinned');
    const $taskbar = $('.navbar');


    
    // Initial setup
    $taskbar.addClass('show');

    $(document).on('click', '#pinned', function () {
        
        let $iframePopup = $('#alliframelist .popupiframe');
        
        
        
        if (pinIcon.hasClass('ri-pushpin-line')) {
            $(document).on('mousemove', handleMouseMove);
            if ($iframePopup.hasClass('maximized')) {
                $iframePopup.removeClass('reduced-height')
            }
            pinIcon.removeClass('ri-pushpin-line').addClass('ri-unpin-line');

               
            
        } else {
            $(document).off('mousemove', handleMouseMove);
            if ($iframePopup.hasClass('maximized')) {
                $iframePopup.addClass('reduced-height')
              
            }
            pinIcon.addClass('ri-pushpin-line').removeClass('ri-unpin-line')
               
            }
        
    });

    function handleMouseMove(event) {
        const taskbarHeight = $taskbar.outerHeight();
      

      

        // Show the taskbar when the cursor is at the very top of the screen (y = 0)
        if (event.clientY === 0 || event.clientY <= 1) { // Ensures it triggers at the top edge
            $taskbar.addClass('show');
        }

        // Hide the taskbar when the cursor moves out of the taskbar's height
        if (event.clientY > taskbarHeight && !pinIcon.hasClass('ri-pushpin-line')) {
                $taskbar.removeClass('show');
        }
    }
    
    $taskbar.on('mouseover', function () {
        $taskbar.addClass('show');
    });

    $taskbar.on('mouseout', function (event) {
        const taskbarHeight = $taskbar.outerHeight();

        if (event.clientY > taskbarHeight && !pinIcon.hasClass('ri-pushpin-line')) {
            $taskbar.removeClass('show');
        }
    });


});
