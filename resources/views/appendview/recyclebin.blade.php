@if(Auth::user()->id == $authId && Auth::user()->cID == 0)


          <!--Main content -->
          <div class="relative h-full overflow-y-auto scroll">
            <div class="w-full mx-auto rounded">
              <!--personal space-->
              <div class="transition personal">
                <!-- header -->
                <div
                  class="accordion-header cursor-pointer transition flex justify-between px-6 items-center h-8 hover-bg-c-yellow border-b"
                >
                  <h3 class="font-weight-500">Admin Space</h3>
                  <i class="ri-arrow-drop-right-line ri-xl"></i>
                </div>
                <!-- Content -->
                <div class="accordion-content pt-0 overflow-hidden max-h-0">
                  <!--grid container -->

                  <div
                    class="transition-all duration-300 p-4 overflow-y-auto"
                  >
                   <!-- start -->
                   <div class="flex flex-wrap gap-4 p-6 ">




@foreach ($adminFiles as $file)
@if($file->folder==1)

<div class="app maindesktopapp w-21 h-28 cursor-pointer relative" data-option="recyclebin">
   <a href="#" class="files openiframe selectapp" data-path =" {{ base64UrlEncode($file->path) }}" data-appkey="{{ base64UrlEncode($file->openwith) }}" data-filekey="{{ base64UrlEncode($file->id) }}" data-filetype="file" data-apptype="{{ (checkFileGroup($file->extension) !='editor') ? 'app' : 'lightapp' }}"> 
    <!-- <a href="{{url('filemanager/'.base64UrlEncode($file->path))}}" class="folders selectapp" data-path =" {{ base64UrlEncode($file->path) }}" data-appkey="{{ base64UrlEncode($file->openwith) }}" data-filekey="{{ base64UrlEncode($file->id) }}" data-filetype="folder" data-apptype="app">  -->

   <div class="fixed w-full app-tools absolute flex item-center gap-8 px-2 invisible showappoptions">
          <input type="checkbox" class="appcheckbox" id="checkboxdocument{{ base64UrlEncode($file->id) }}">
          <div class="ml-auto -mt-1">
              <i class="ri-arrow-drop-down-fill ri-xl text-black"></i>
          </div>
        </div>
       <div class="flex flex-col items-center imagewraper">
              <img class="w-16 icondisplay" src="{{ asset($constants['FILEICONPATH'].'folder.png')}}" alt="{{ $file->name }}"/>
            
            <div class="input-wrapper" id="inputWrapperfolder{{ base64UrlEncode($file->id) }}">
                <input type="text" class="text-center text-black appinputtext" disabled id="inputFieldfolder{{ base64UrlEncode($file->id) }}" value="{{ $file->name }}">
            </div>
        </div>
     </a>
</div>
@else
<div class="app maindesktopapp w-21 h-28 cursor-pointer relative" data-option="recyclebin">
  <a href="#" class="files openiframe selectapp" data-path =" {{ base64UrlEncode($file->path) }}" data-appkey="{{ base64UrlEncode($file->openwith) }}" data-filekey="{{ base64UrlEncode($file->id) }}" data-filetype="file" data-apptype="{{ (checkFileGroup($file->extension) !='editor') ? 'app' : 'lightapp' }}"> 

   <div class="fixed w-full app-tools absolute flex item-center gap-8 px-2 invisible showappoptions">
          <input type="checkbox" class="appcheckbox" id="checkboxdocument{{ base64UrlEncode($file->id) }}">
          <div class="ml-auto -mt-1">
              <i class="ri-arrow-drop-down-fill ri-xl text-black"></i>
          </div>
        </div>
       <div class="flex flex-col items-center imagewraper">
          
            @if(checkFileGroup($file->extension)=='image')
                 <img class="w-16 icondisplay" src="{{ url(Storage::url($constants['ROOTPATH'].$file->path)) }}" alt="{{ $file->name }}"/>
            @else
                <img class="w-16 icondisplay " src="{{ checkIconExist($file->extension,'file')}}" alt="{{ $file->name }}"/>
            @endif    
            <div class="input-wrapper" id="inputWrapperfile{{ base64UrlEncode($file->id) }}">
                <input type="text" class="text-center text-black appinputtext" disabled id="inputFieldfile{{ base64UrlEncode($file->id) }}" value="{{ $file->name }}">
            </div>

    </div>
    </a>
</div>   
@endif 
@endforeach

                  </div>
                </div>
              </div>

              <div class="transition departmental">
                <!-- header -->
                <div
                  class="accordion-header cursor-pointer transition flex justify-between px-6 items-center h-8 hover-bg-c-yellow border-b"
                >
                  <h3 class="font-weight-500">User Delete Space</h3>
                  <i class="ri-arrow-drop-right-line ri-xl"></i>
                </div>
                <!-- Content -->
                <div class="accordion-content pt-0 overflow-hidden max-h-0">
                  <!--grid container -->
                  <div
                    class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 xl:grid-cols-10 2xl:grid-cols-12 gap-4 transition-all duration-300 p-4 overflow-y-auto"
                  >
                    
                    @foreach ($userFiles as $file)
@if($file->folder==1)

<div class="app maindesktopapp w-21 h-28 cursor-pointer relative" data-option="recyclebin">
   <a href="#" class="files openiframe selectapp" data-path =" {{ base64UrlEncode($file->path) }}" data-appkey="{{ base64UrlEncode($file->openwith) }}" data-filekey="{{ base64UrlEncode($file->id) }}" data-filetype="file" data-apptype="{{ (checkFileGroup($file->extension) !='editor') ? 'app' : 'lightapp' }}"> 
  <!--   <a href="{{url('filemanager/'.base64UrlEncode($file->path))}}" class="folders selectapp" data-path =" {{ base64UrlEncode($file->path) }}" data-appkey="{{ base64UrlEncode($file->openwith) }}" data-filekey="{{ base64UrlEncode($file->id) }}" data-filetype="folder" data-apptype="app">  -->

   <div class="fixed w-full app-tools absolute flex item-center gap-8 px-2 invisible showappoptions">
          <input type="checkbox" class="appcheckbox" id="checkboxdocument{{ base64UrlEncode($file->id) }}">
          <div class="ml-auto -mt-1">
              <i class="ri-arrow-drop-down-fill ri-xl text-black"></i>
          </div>
        </div>
       <div class="flex flex-col items-center imagewraper">
              <img class="w-16 icondisplay" src="{{ asset($constants['FILEICONPATH'].'folder.png')}}" alt="{{ $file->name }}"/>
            
            <div class="input-wrapper" id="inputWrapperfolder{{ base64UrlEncode($file->id) }}">
                <input type="text" class="text-center text-black appinputtext" disabled id="inputFieldfolder{{ base64UrlEncode($file->id) }}" value="{{ $file->name }}">
            </div>
        </div>
     </a>
</div>
@else
<div class="app maindesktopapp w-21 h-28 cursor-pointer relative" data-option="recyclebin">
  <a href="#" class="files openiframe selectapp" data-path =" {{ base64UrlEncode($file->path) }}" data-appkey="{{ base64UrlEncode($file->openwith) }}" data-filekey="{{ base64UrlEncode($file->id) }}" data-filetype="file" data-apptype="{{ (checkFileGroup($file->extension) !='editor') ? 'app' : 'lightapp' }}"> 

   <div class="fixed w-full app-tools absolute flex item-center gap-8 px-2 invisible showappoptions">
          <input type="checkbox" class="appcheckbox" id="checkboxdocument{{ base64UrlEncode($file->id) }}">
          <div class="ml-auto -mt-1">
              <i class="ri-arrow-drop-down-fill ri-xl text-black"></i>
          </div>
        </div>
       <div class="flex flex-col items-center imagewraper">
          
            @if(checkFileGroup($file->extension)=='image')
                 <img class="w-16 icondisplay" src="{{ url(Storage::url($constants['ROOTPATH'].$file->path)) }}" alt="{{ $file->name }}"/>
            @else
                <img class="w-16 icondisplay " src="{{ checkIconExist($file->extension,'file')}}" alt="{{ $file->name }}"/>
            @endif    
            <div class="input-wrapper" id="inputWrapperfile{{ base64UrlEncode($file->id) }}">
                <input type="text" class="text-center text-black appinputtext" disabled id="inputFieldfile{{ base64UrlEncode($file->id) }}" value="{{ $file->name }}">
            </div>

    </div>
    </a>
</div>   
@endif 
@endforeach
</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="script/sidebar.js"></script>
    <script src="script/taskbar.js"></script>
    <script>
      // toggle cancel sharing button in action bar
      const cancel = document.getElementById("cancelshare");
      function togglebutton() {
        cancel.classList.toggle("hidden");
      }

      const accordionHeader = document.querySelectorAll(".accordion-header");
      // on page load the content of accordion is display
      window.addEventListener("load", () => {
        accordionHeader.forEach((header) => {
          const accordionContent =
            header.parentElement.querySelector(".accordion-content");
          let accordionMaxHeight = accordionContent.style.maxHeight;
          accordionContent.style.maxHeight = `${
            accordionContent.scrollHeight + 32
          }px`;
          header
            .querySelector("i")
            .classList.remove("ri-arrow-drop-right-line");
          header.querySelector("i").classList.add("ri-arrow-drop-down-line");
        });
      });
      // on click of accordion header show content
      accordionHeader.forEach((header) => {
        header.addEventListener("click", function () {
          const accordionContent =
            header.parentElement.querySelector(".accordion-content");
          let accordionMaxHeight = accordionContent.style.maxHeight;

          // Condition handling
          if (accordionMaxHeight == "0px" || accordionMaxHeight.length == 0) {
            accordionContent.style.maxHeight = `${
              accordionContent.scrollHeight + 32
            }px`;
            header
              .querySelector("i")
              .classList.remove("ri-arrow-drop-right-line");
            header.querySelector("i").classList.add("ri-arrow-drop-down-line");
          } else {
            accordionContent.style.maxHeight = `0px`;
            header.querySelector("i").classList.add("ri-arrow-drop-right-line");
            header
              .querySelector("i")
              .classList.remove("ri-arrow-drop-down-line");
          }
        });
      });
    </script>
    <script src="script/tour.js"></script>
    <script src="script/filemanager-linksharing-tour.js"></script>
  </body>
</html>

 
<!-- user data -->
 @else
 @foreach ($deletedByUser as $file)
@if($file->folder==1)

<div class="app maindesktopapp w-21 h-28 cursor-pointer relative" data-option="recyclebin">
   <a href="#" class="files openiframe selectapp" data-path =" {{ base64UrlEncode($file->path) }}" data-appkey="{{ base64UrlEncode($file->openwith) }}" data-filekey="{{ base64UrlEncode($file->id) }}" data-filetype="file" data-apptype="{{ (checkFileGroup($file->extension) !='editor') ? 'app' : 'lightapp' }}"> 
   <div class="fixed w-full app-tools absolute flex item-center gap-8 px-2 invisible showappoptions">
          <input type="checkbox" class="appcheckbox" id="checkboxdocument{{ base64UrlEncode($file->id) }}">
          <div class="ml-auto -mt-1">
              <i class="ri-arrow-drop-down-fill ri-xl text-black"></i>
          </div>
        </div>
       <div class="flex flex-col items-center imagewraper">
              <img class="w-16 icondisplay" src="{{ asset($constants['FILEICONPATH'].'folder.png')}}" alt="{{ $file->name }}"/>
            
            <div class="input-wrapper" id="inputWrapperfolder{{ base64UrlEncode($file->id) }}">
                <input type="text" class="text-center text-black appinputtext" disabled id="inputFieldfolder{{ base64UrlEncode($file->id) }}" value="{{ $file->name }}">
            </div>
        </div>
     </a>
</div>
@else
<div class="app maindesktopapp w-21 h-28 cursor-pointer relative" data-option="recyclebin">
  <a href="#" class="files openiframe selectapp" data-path =" {{ base64UrlEncode($file->path) }}" data-appkey="{{ base64UrlEncode($file->openwith) }}" data-filekey="{{ base64UrlEncode($file->id) }}" data-filetype="file" data-apptype="{{ (checkFileGroup($file->extension) !='editor') ? 'app' : 'lightapp' }}"> 

   <div class="fixed w-full app-tools absolute flex item-center gap-8 px-2 invisible showappoptions">
          <input type="checkbox" class="appcheckbox" id="checkboxdocument{{ base64UrlEncode($file->id) }}">
          <div class="ml-auto -mt-1">
              <i class="ri-arrow-drop-down-fill ri-xl text-black"></i>
          </div>
        </div>
       <div class="flex flex-col items-center imagewraper">
          
            @if(checkFileGroup($file->extension)=='image')
                 <img class="w-16 icondisplay" src="{{ url(Storage::url($constants['ROOTPATH'].$file->path)) }}" alt="{{ $file->name }}"/>
            @else
                <img class="w-16 icondisplay " src="{{ checkIconExist($file->extension,'file')}}" alt="{{ $file->name }}"/>
            @endif    
            <div class="input-wrapper" id="inputWrapperfile{{ base64UrlEncode($file->id) }}">
                <input type="text" class="text-center text-black appinputtext" disabled id="inputFieldfile{{ base64UrlEncode($file->id) }}" value="{{ $file->name }}">
            </div>

    </div>
    </a>
</div>   
 @endif
@endforeach

@endif





<!-- start details and preview pane  -->
<div id="detailContainer">
    @include('appendview.detailsview')
  </div>
  <!-- end details and preview pane  -->