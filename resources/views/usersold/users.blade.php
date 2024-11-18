@extends('layouts.setting')
@section('title', 'Users and Groups')
@section('content')
    <main class="bg-gray-100 pt-5">
        <div class="flex items-center mb-4 ml-4 p-3">
            <!-- Setting icon -->
            <span class="text-gray-500 mr-3 text-2xl ">
                <i class="fas fa-cog"></i>
            </span>
            <!-- Title -->
            <span class="text-2xl">System Settings</span>
        </div>
        
    <div class="flex items-center justify-between bg-yellow-400 p-2 pl-8  mb-4">

        <div>
            <h2 class="text">Admin & Users > <span class="font-semibold">Users and Groups</span></h2>
        </div>
        <div class="flex items-center">
            <!-- Search icon -->
            <div class="flex items-center">
                <!-- Search input -->
                <input id="searchInput" type="text" placeholder="Search users, groups" class="border rounded-l-md p-2 focus:outline-none bg-gray-100" style="height: 40px;">
                <!-- File folder icon -->
                <span class="bg-gray-100 p-2 rounded-r-md cursor-pointer" style="height: 40px;">
                    <i class="fas fa-search"></i>
                </span>
            </div>
            <span class="ml-4 text-2xl mr-3">
                <i class="fas fa-plus-circle"></i>
            </span>
            <span class="ml-2 text-2xl">
                <i class="fas fa-folder"></i>
            </span>
        </div>
    </div>
    
        <div class="users-admin-btn-grp pl-8 flex items-center relative justify-between">
            
            <div class="flex items-center">
            <!-- Dropdown 1 -->
            
            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
              Add User
             </button>

          <!--   <div class="relative">
                <button onclick="toggleDropdown('dropdownOptions-1')" class="flex items-center focus:border-yellow-500 dropdown-toggle border border-gray-300 rounded px-4 py-1 mr-2">
                        <span class="">Group 1</span>
                        <span class="pb-1 pl-2">
                            <i class="fas fa-sort-down"></i>
                        </span>
                </button>
                <div id="dropdownOptions-1" class="dropdown-options absolute top-0 left-0 mt-10 bg-white border border-gray-300 rounded shadow-md dropdown-options-custom-width">
                    <div class="p-2 dropdown-options-custom-width">
                        <a href="#" class="block py-1">Edit</a>
                        <a href="#" class="block py-1">Set space size batches</a>
                        <a href="#" class="block py-1"></a>Add sub-group</a>
                        <a href="#" class="block py-1"></a>New user</a>
                    </div>
                </div>
            </div>
     -->
            <!-- Dropdown 2 -->
            <!-- <div class="relative">
                <button onclick="toggleDropdown('dropdownOptions-2')" class="flex items-center dropdown-toggle focus:border-yellow-500 border border-gray-300 rounded px-4 py-1 mr-2">
                        <span class="" >New User</span>
                        <span class="pb-1 pl-2">
                            <i class="fas fa-sort-down"></i>
                        </span>
                </button>
                <div id="dropdownOptions-2" class="dropdown-options absolute top-0 left-0 mt-10 bg-white border border-gray-300 rounded shadow-md">
                    <div class="p-1 px-5">
                        <a href="#" class="block">Add in bulk</a>
                    </div>
                </div>
            </div> -->
    
            <!-- Dropdown 3 -->
            <!-- <div class="relative">
                <button  onclick="toggleDropdown('dropdownOptions-3')" class="flex items-center focus:border-yellow-500 dropdown-toggle border border-gray-300 rounded px-4 py-1 mr-2">
                        <span class="">Bulk Operations</span>
                        <span class="pb-1 pl-2">
                            <i class="fas fa-sort-down"></i>
                        </span>
                </button>
                <div id="dropdownOptions-3" class="dropdown-options absolute top-0 left-0 mt-10 bg-white border border-gray-300 rounded shadow-md dropdown-options-custom-width">
                 <div class="p-2">
                        <a href="#" id="userRoleSetting" class="block py-1 px-2 dropdown-item" onclick="setActive('userRoleSetting')">User role setting</a>
                        <a href="#" id="spaceSizeSetting" class="block py-1 px-2 dropdown-item" onclick="setActive('spaceSizeSetting')">Space size setting</a>
                        <a href="#" id="removeFromGroup" class="block py-1 px-2 dropdown-item" onclick="setActive('removeFromGroup')">Remove from group</a>
                        <a href="#" id="addToGroup" class="block py-1 px-2 dropdown-item" onclick="setActive('addToGroup')">Add to group</a>
                        <a href="#" id="migrateToDepartment" class="block py-1 px-2 dropdown-item" onclick="setActive('migrateToDepartment')">Migrate to department</a>
                   </div>
                </div>
            </div> -->
    
            <!-- Disabled Button 1 -->
            <!-- <button class="disabled-btn bg-gray-300 text-gray-600 px-4 py-2 rounded mr-2" disabled>Button 1</button> -->
    
            <!-- Disabled Button 2 -->
           <!--  <button class="disabled-btn bg-gray-300 text-gray-600 px-4 py-2 rounded mr-2" disabled>Button 2</button> -->
            
            <!-- Disabled Button 3 -->
           <!--  <button class="disabled-btn bg-gray-300 text-gray-600 px-4 py-2 rounded" disabled>Button 3</button> -->
        </div>
            <div>
                <p class="text-sm mr-6">ID: 1 Dep: 1</p>
            </div>
        </div>
    
        <div class="users-admin-content-wrapper pl-8  pr-3">
            <div class="container mx-auto mt-10">
                <!-- Searchable Table -->
                <div class="overflow-x-auto rounded-lg shadow-lg">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                        <thead class="bg-gray-500">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-300  text-left text-xs leading-4 font-medium text-gray-100 border-none tracking-wider">Nickname/Account</th>
                            <th class="px-6 py-3 border-b border-gray-300  text-left text-xs leading-4 font-medium text-gray-100 border-none tracking-wider flex items-center">
                                <div class="flex items-center">
                                    <span>Roles</span>
                                    <span class="pb-1 pl-2">
                                        <i class="fas fa-sort-down"></i>
                                    </span>
                                </div>
                            </th>
                            <th class="px-6 py-3 border-b border-gray-300  text-left text-xs leading-4 font-medium text-gray-100 border-none tracking-wider">
                                <div class="flex items-center">
                                    <span>Space Usage</span>
                                    <span class="pb-1 pl-2">
                                        <i class="fas fa-sort-down"></i>
                                    </span>
                                </div>
                            </th>
                            <th class="px-6 py-3 border-b border-gray-300  text-left text-xs leading-4 font-medium text-gray-100 border-none tracking-wider">Group</th>
                        </tr>
                        </thead>
                        <tbody id="searchableTableBody">
                            <!-- Table rows will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

</main>

<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add User
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <form class="max-w-sm mx-auto" action="{{ route('user-create') }}" method="POST">
                    @csrf
                      <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name (username)</label>
                        <input type="text" name="name" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="username" required />
                      </div>
                      <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nick-Name</label>
                        <input type="text"  name="nickName" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="" required />
                      </div>
                      <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="name@flowbite.com" required />
                      </div>
                      <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                      </div>
                       <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Space-Size</label>
                        <input type="text" name="sizeMax" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="alloted space" required />
                      </div>
                      <div class="mb-5">
                      <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                      <select id="countries" name="roleID" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                         @foreach($roles as $role)
                         <option value="{{ $role->id }}">{{ $role->name }}</option>
                         @endforeach
                      </select>
                    </div>
                    <div class="mb-5">
                      <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group</label>
                      <select id="countries" name=" groupID" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                         @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                      </select>
                  </div>
                    
                      
                      <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
               <!--  <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button> -->
                <!-- <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button> -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset($constants['JSFILEPATH'].'setting.js') }}"></script>
    <script>
    function toggleDropdown(id) {
        var dropdownOptions = document.getElementById(id);
        var allDropdowns = document.querySelectorAll('.dropdown-options');

        allDropdowns.forEach(function(dropdown) {
            if (dropdown.id !== id) {
                dropdown.style.display = 'none';
            }
        });

        if (dropdownOptions.style.display === 'none') {
            dropdownOptions.style.display = 'block';
        } else {
            dropdownOptions.style.display = 'none';
        }

        // Toggle active class on button
        var dropdownButton = document.getElementById(id.replace('dropdownOptions-', 'dropdownButton-'));
        var allDropdownButtons = document.querySelectorAll('.dropdown-toggle');

        allDropdownButtons.forEach(function(button) {
            if (button.id !== dropdownButton.id) {
                button.classList.remove('dropdown-button-active');
            }
        });

        dropdownButton.classList.toggle('dropdown-button-active');
    }

    function setActive(elementId) {
        // Remove active class from all dropdown items
        var dropdownItems = document.getElementsByClassName('dropdown-item');
        for (var i = 0; i < dropdownItems.length; i++) {
            dropdownItems[i].classList.remove('dropdown-item-active');
        }

        // Add active class to the clicked dropdown item
        var clickedItem = document.getElementById(elementId);
        clickedItem.classList.add('dropdown-item-active');
    }
     // Data for the table (example)
     // const tableData = [
     //            { nickname: "Vicky", role: "Administrator", spaceUsage: "1.1MB/Unlimited", group: "Group" },
     //            { nickname: "Administrator", role: "Administrator", spaceUsage: "1.1KB/2GB", group: "Group" },
     //            { nickname: "Vighnesh", role: "User", spaceUsage: "1.1KB/4GB", group: "Developer" }
     //        ];
        const tableData = @php echo $users @endphp;  
        
            // Function to populate the table with data
            function populateTable(data) {
                const tableBody = document.getElementById('searchableTableBody');
                tableBody.innerHTML = ''; // Clear previous data
        
                data.forEach(row => {
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">${row.name}</td>
                        <td class="py-4 whitespace-no-wrap border-b border-gray-300">${row.roleID}</td>
                        <td class="py-4 whitespace-no-wrap border-b border-gray-300">
                            <input type="range" class="w-full" min="0" max="500" value="${row.sizeMax}">
                            <span class="block text-sm">${row.sizeMax}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">${row.groupID}</td>
                    `;
                    tableBody.appendChild(newRow);
                });
            }
        
            // Initial population of the table
            populateTable(tableData);
        
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.toLowerCase();
                const filteredData = tableData.filter(row =>
                     row.name.toLowerCase().includes(searchTerm) //||
                    // row.roleID.toLowerCase().includes(searchTerm) ||
                    // row.groupID.toLowerCase().includes(searchTerm)
                );
                populateTable(filteredData);
            });

</script>
@endsection
