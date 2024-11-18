  <!-- listview  -->
  <div class="m-6 rounded-lg hidden md:flex" id="deskList" >
    <table class="min-w-full bg-c-white rounded-lg shadow-lg">
      <thead class="bg-c-dark-gray rounded-t-lg">
        <tr class="text-left font-medium border-none text-c-white">
          <th class="px-4 py-2 w-80">Name</th>
          <th class="px-4 py-2">Type</th>
          <th class="px-4 py-2">Size</th>
          <th class="px-4 py-2">Modification</th>
          <th class="px-4 py-2">Editor</th>
          <th class="px-4 py-2">Creation</th>
        </tr>
      </thead>
     
      @foreach ($defaultfolders as $dfolder)
      <tbody>
        <tr class="cursor-pointer text-left">
          <td class="px-4 py-2">
            <div class="app maindesktopapp cursor-pointer relative" data-option="all">

            <a href="{{ url('filemanager/'.base64UrlEncode($dfolder->path))}}" class="systemapp selectapp showappoptions" data-appkey="{{ base64UrlEncode($dfolder->id) }}" data-filekey="{{ base64UrlEncode($dfolder->id) }}" data-filetype="app" data-apptype="app">

              
                <div class="fixed w-full app-tools absolute flex item-center gap-8 px-2 invisible showappoptions">
                  <input type="checkbox" class="appcheckbox" id="checkboxsystemapp{{ base64UrlEncode($dfolder->id) }}">
                  <div class="ml-auto -mt-1">
                      <i class="ri-arrow-drop-down-fill ri-xl text-black"></i>
                  </div>
                </div>
                <div class="flex flex-row items-center pr-5 pl-8 imagewraper">
                      <img class="w-8 icondisplay" src="{{ asset($constants['APPFILEPATH'].$dfolder->icon) }}" alt="{{ $dfolder->name }}"/>                  

                    <div class="input-wrapper" id="inputWrappersystemapp{{ base64UrlEncode($dfolder->id) }}">
                      <input type="text" class="text-center text-black appinputtext" disabled id="inputFieldsystemapp{{ base64UrlEncode($dfolder->id) }}" value="{{ $dfolder->name }}">
                  </div>

                </div>
              </a>
            </div>
          </td>
          <td class="px-4 py-2">{{$dfolder->type}}</td>
          <td class="px-4 py-2">
          @php            
            $folderSize = ''; // Default size
            if ($dfolder->path === 'Desktop') {
              $folderSize = $sizeMap['desktop'];
            } elseif ($dfolder->path === 'Document') {
              $folderSize = $sizeMap['documents'];
            } elseif ($dfolder->path === 'RecycleBin') {
              $folderSize = $sizeMap['recyclebin'];
            } elseif ($dfolder->path === 'Download') {
              if($sizeMap['downloads'] >= 00)             
              $folderSize = $sizeMap['downloads'];
              else
              $folderSize = '';
            }
          @endphp
          {{ $folderSize }}
        </td>        
          <td class="px-4 py-2">{{ $dfolder->updated_at->format('Y-m-d H:i:s') }}</td>
          <td class="px-4 py-2">
            <div class="flex items-center">
              @if (Auth::user()->avatar != null)
                  <img class="w-6 h-6 pr-1"
                      src="{{ url('/') }}/{{ Auth::user()->avatar }}" alt="user image" />
              @else
                  <img class="w-6 h-6 pr-1" src="{{ asset($constants['IMAGEFILEPATH'] . 'profile.png') }}"
                      alt="user image" />
              @endif 
              {{$userName}}
            </div>
          </td>
          <td class="px-4 py-2">{{ $dfolder->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>                    
      </tbody>
      @endforeach

      @foreach ($files as $file)
      @if($file->folder==1)
      <tbody>
        <tr class="cursor-pointer text-left">
          <td class="px-4 py-2">
            <div class="app maindesktopapp cursor-pointer relative" data-option="all">

            <a href="{{url('filemanager/'.base64UrlEncode($file->path))}}" class="systemapp selectapp showappoptions" data-appkey="{{ base64UrlEncode($file->openwith) }}" data-filekey="{{ base64UrlEncode($file->id) }}" data-filetype="folder" data-apptype="app">           
          
              
                <div class="fixed w-full app-tools absolute flex item-center gap-8 px-2 invisible showappoptions">
                  <input type="checkbox" class="appcheckbox" id="checkboxsystemapp{{ base64UrlEncode($file->id) }}">
                  <div class="ml-auto -mt-1">
                      <i class="ri-arrow-drop-down-fill ri-xl text-black"></i>
                  </div>
                </div>
                <div class="flex flex-row items-center pr-5 pl-8 imagewraper">
                      <img class="w-8 icondisplay" src="{{ asset($constants['FILEICONPATH'].'folder.png')}}" alt="{{ $file->name }}"/>                  

                    <div class="input-wrapper" id="inputWrappersystemapp{{ base64UrlEncode($file->id) }}">
                      <input type="text" class="text-center text-black appinputtext" disabled id="inputFieldsystemapp{{ base64UrlEncode($file->id) }}" value="{{ $file->name }}">
                  </div>

                </div>
              </a>
            </div>
          </td>
          <td class="px-4 py-2">{{ $file->extension }}</td>
          <td class="px-4 py-2">{{ $file->size }}</td>                
          <td class="px-4 py-2">{{ $file->updated_at->format('Y-m-d H:i:s') }}</td>
          <td class="px-4 py-2">
            <div class="flex items-center">
            @if (Auth::user()->avatar != null)
                  <img class="w-6 h-6 pr-1"
                      src="{{ url('/') }}/{{ Auth::user()->avatar }}" alt="user image" />
              @else
                  <img class="w-6 h-6 pr-1" src="{{ asset($constants['IMAGEFILEPATH'] . 'profile.png') }}"
                      alt="user image" />
              @endif 
              {{$userName}}
            </div>
          </td>
          <td class="px-4 py-2">{{ $file->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>                    
      </tbody>
      @else
      <tbody>
        <tr class="cursor-pointer text-left">
          <td class="px-4 py-2">
            <div class="app maindesktopapp cursor-pointer relative" data-option="all">

            <a href="#" class="systemapp selectapp showappoptions" data-path =" {{ base64UrlEncode($file->path) }}" data-appkey="{{ base64UrlEncode($file->openwith) }}" data-filekey="{{ base64UrlEncode($file->id) }}" data-filetype="file" data-apptype="{{ (checkFileGroup($file->extension) !='editor') ? 'app' : 'lightapp' }}">

              
                <div class="fixed w-full app-tools absolute flex item-center gap-8 px-2 invisible showappoptions">
                  <input type="checkbox" class="appcheckbox" id="checkboxsystemapp{{ base64UrlEncode($file->id) }}">
                  <div class="ml-auto -mt-1">
                      <i class="ri-arrow-drop-down-fill ri-xl text-black"></i>
                  </div>
                </div>
                <div class="flex flex-row items-center pr-5 pl-8 imagewraper">
                      
                      @if(checkFileGroup($file->extension)=='image')
                      <img class="w-8 icondisplay" src="{{ url(Storage::url($constants['ROOTPATH'].$file->path)) }}" alt="{{ $file->name }}"/> 
                      @else
                          <img class="w-8 icondisplay " src="{{ checkIconExist($file->extension,'file')}}" alt="{{ $file->name }}"/>
                      @endif                   

                    <div class="input-wrapper" id="inputWrappersystemapp{{ base64UrlEncode($file->id) }}">
                      <input type="text" class="text-center text-black appinputtext" disabled id="inputFieldsystemapp{{ base64UrlEncode($file->id) }}" value="{{ $file->name }}">
                  </div>

                </div>
              </a>
            </div>
          </td>
          <td class="px-4 py-2">{{ $file->extension }}</td>
          <td class="px-4 py-2">{{ $file->size }}</td>                
          <td class="px-4 py-2">{{ $file->updated_at->format('Y-m-d H:i:s') }}</td>
          <td class="px-4 py-2">
            <div class="flex items-center">
              @if (Auth::user()->avatar != null)
                  <img class="w-6 h-6 pr-1"
                      src="{{ url('/') }}/{{ Auth::user()->avatar }}" alt="user image" />
              @else
                  <img class="w-6 h-6 pr-1" src="{{ asset($constants['IMAGEFILEPATH'] . 'profile.png') }}"
                      alt="user image" />
              @endif             
              {{ $userName }}
            </div>
          </td>
          <td class="px-4 py-2">{{ $file->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>                    
      </tbody>
      @endif 
      @endforeach
    </table>
  </div>

  <!-- start details and preview pane  -->
  <div id="detailContainer">
    @include('appendview.detailsview')
  </div>
  <!-- end details and preview pane  -->


  