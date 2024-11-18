@php
    $mergedPermissionContextMapping = [
        'download' => ['download', 'print'],
        'upload' => ['upload'],
        'edit' => ['new folder','new file', 'rename', 'unzip', 'compress'],
        'delete' => ['cut', 'copy', 'paste', 'delete', 'restore'],
        'share' => ['share'],
        'comments' => ['comments'],
    ];

    $default = [
        'refresh', 'icon size', 'sort order', 'open'
    ];

    // Merge permissions without the 'default' key
    $permissionContextMapping = $mergedPermissionContextMapping;
    $permissionContextMapping['default'] = $default;
@endphp

@if(!empty($contextTypes))
    @if ($type=='rightclick')
        <ul class="ullist">
            @foreach ($contextTypes as $contextType)
                @php
                    $lowerContextTypeName = strtolower($contextType->name);
                    $hasPermission = false;

                    // Check if the context type name matches any permission context
                    foreach ($filteredPermissions['fileManager'] as $permission) {
                        $lowerPermission = strtolower($permission);

                        if (array_key_exists($lowerPermission, $permissionContextMapping) && 
                            in_array($lowerContextTypeName, $permissionContextMapping[$lowerPermission])) {
                            $hasPermission = true;
                            break;
                        }
                    }

                    // Always show default options
                    if (in_array($lowerContextTypeName, $permissionContextMapping['default'])) {
                        $hasPermission = true;
                    }
                @endphp

                @if ($hasPermission)
                    @if ($contextType->is_options != 1)
                        <a href="#" class="clickmenu {{ $contextType->function }} {{ session()->has($contextType->conditional) ? '' : 'hidden' }}" data-option="{{ $contextType->is_options }}">
                            <li class="flex items-center justify-between px-4 py-2">
                                <p class="text-c-black text-sm">{{ $contextType->name }}</p>
                                <p class="menu-sidename">{{ $contextType->shortcut }}</p>
                            </li>
                        </a>
                    @else
                        <li class="flex items-center justify-between px-4 py-2">
                            <p class="text-c-black text-sm">{{ $contextType->name }}</p>
                            <i class="ri-arrow-right-s-line"></i>
                            <ul class="submenu clickmenu newfile-submenu absolute shadow-md rounded-md hidden {{ $contextType->function }}" data-option="{{ $contextType->is_options }}">
                                @if (!empty($contextType->contextOptions))
                                    @foreach ($contextType->contextOptions as $option)
                                        <a href="#" class="clickmenu {{ $contextType->function }} {{ session()->has($contextType->conditional) ? '' : 'hidden' }}" data-type="{{ $option->function }}">
                                            <li class="flex items-center px-5 py-2 gap-2">
                                                @if (checkIconExist($option->image, 'menu'))
                                                    <img class="w-4" src="{{ checkIconExist($option->image, 'menu') }}" alt="{{ $option->name }}" />
                                                @else
                                                    {!! $option->icon !!}
                                                @endif
                                                <p class="text-c-black text-sm">{{ $option->name }}</p>
                                            </li>
                                        </a>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    @endif
                @endif
            @endforeach
        </ul>
    @else
        <!-- Apps context-menu -->
        <ul class="ullist">
            <!-- Always show default options -->
            @foreach ($contextTypes as $contextType)
                @php
                    $lowerContextTypeName = strtolower($contextType->name);
                @endphp

                @if (in_array($lowerContextTypeName, $permissionContextMapping['default']))
                    <a href="#" class="allappoptions appoptions openrightclick clickmenu {{ $contextType->function }}" data-option="{{ $contextType->is_options }}">
                        <li class="flex items-center justify-between px-2 py-2">
                            <p class="text-c-black text-sm">{{ $contextType->name }}</p>
                            <p class="menu-sidename">{{ $contextType->shortcut }}</p>
                        </li>
                    </a>
                @endif
            @endforeach

            @foreach ($filteredPermissions['fileManager'] as $permission)
                @php
                    $lowerPermission = strtolower($permission);
                @endphp

                @if (array_key_exists($lowerPermission, $permissionContextMapping))
                    @foreach ($contextTypes as $contextType)
                        @php
                            $lowerContextTypeName = strtolower($contextType->name);
                        @endphp

                        @if (in_array($lowerContextTypeName, $permissionContextMapping[$lowerPermission]))
                            <a href="#" class="allappoptions appoptions openrightclick clickmenu {{ $contextType->function }}" data-option="{{ $contextType->is_options }}">
                                <li class="flex items-center justify-between px-2 py-2">
                                    <p class="text-c-black text-sm">{{ $contextType->name }}</p>
                                    <p class="menu-sidename">{{ $contextType->shortcut }}</p>
                                </li>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            
        </ul>
    @endif
@endif
