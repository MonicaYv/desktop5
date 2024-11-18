@extends('layouts.backendsettings')
@section('title', 'Clients')
@section('content')

    <div class="flex-grow h-100 main">
        <div class="flex w-full h-full flex-col content">
            <div class="px-9 py-3.5 lg:py-6 lg:px-5">
                <div class="flex items-center gap-4">
                    <i class="ri-settings-3-fill ri-xl"></i>
                    <span class="text-lg text-c-black font-normal">Client Management</span>
                </div>
            </div>
            <!-- topTaskbar in desktop -->
            <div class="pl-4 md:pl-6 py-4 pr-4 md:pr-6 w-full flex flex-row justify-between items-center taskbar">
                <div class="w-full md:w-6/12 xl:w-8/12">
                    <div class="flex items-center gap-1 sm:gap-2">
                        <span class="text-c-light-black whitespace-nowrap font-normal">
                            Client Management
                        </span>
                        <i class="ri-arrow-right-line ri-lg text-c-light-black"></i>
                        <span class="font-semibold text-c-black">
                            Clients
                        </span>
                    </div>
                </div>
                <div class="relative taskicon hidden md:flex md:w-5/12 flex flex-row items-center justify-end gap-6">
                    <div id="searchbutton"
                        class="flex items-center rounded overflow-hidden flex-shrink-0 flex-grow bg-c-white h-7 w-1/12 md:w-2/12 hidden md:flex">
                        <input type="text"
                            class="search pl-4 pt-2.5 pb-2.5 flex-shrink flex-grow border-none outline-none font-size-14 w-3/12"
                            placeholder="Search clients, Name & Username" id="searchterm" />
                        <div class="searchicon pt-3 pb-3 pr-4 flex items-center justify-center">
                            <i class="ri-search-line" id="search"></i>
                        </div>
                    </div>
                    <button class="has-tooltip addclientmodel">
                        <i class="ri-add-circle-fill ri-xl"></i>
                    </button>
                    <div class="absolute py-1 px-2 text-start text-xs tooltip -bottom-8 right-5 z-10 bg-white border rounded-md border-c-yellow z-0 font-normal">
                        Add Client
                    </div>
                </div>
            </div>
            <!-- searchbar in mobile-->
            <div class="pl-4 pt-3 mt-3 pb-3 pr-4 w-full flex flex-row justify-between items-center bg-c-light-white-smoke md:hidden"
                id="mobiletaskbar">
                <div class="relative w-full flex flex-row items-center justify-end gap-2">
                    <div class="flex items-center rounded overflow-hidden flex-shrink-0 flex-grow bg-c-white h-8 w-1/12">
                        <input type="text" id="searchterm"
                            class="pl-4 pt-2.5 pb-2.5 flex-shrink flex-grow border-none outline-none w-3/12"
                            placeholder="Search clients..." />
                        <div class="pt-3 pb-3 pr-4 flex items-center justify-center">
                            <i class="ri-search-line" id="search"></i>
                        </div>
                    </div>
                    <button class="px-2 has-tooltip addclientmodel" >
                        <i class="ri-add-circle-fill ri-xl"></i>
                    </button>
                    <div
                        class="absolute py-1 px-2 text-start text-xs tooltip -bottom-8 right-5 z-10 bg-white border rounded-md border-c-yellow z-0">
                        Add Client
                    </div>
                </div>
            </div>

            <!--Main content -->
            <div class="p-4 relative h-full flex flex-col main-content overflow-y-scroll scroll">
                <div class="bg-white cs-table-container border border-c-gray rounded-md mt-5">
                    <table class="table-auto w-full">
                        <thead class="h-14">
                            <tr class="bg-c-dark-gray">
                                <th class="text-c-white font-medium text-left pl-3 rounded-tl-md"></th>
                                <th class="text-c-white font-medium text-left pl-3 whitespace-nowrap w-1/4 pr-3 md:pr-0">
                                    Name
                                </th>
                                <th class="text-c-white font-medium text-left pl-3 pr-3 md:pr-0">
                                    Head Name
                                </th>
                                <th class="text-c-white font-medium text-left pl-3 pr-3 md:pr-0">
                                    Head Username
                                </th>

                                <th class="rounded-tr-md text-c-white font-medium text-left pl-3 pr-3 md:pr-0">Action</th>
                            </tr>
                        </thead>
                        <tbody id="searchableTableBody">
                        </tbody>
                    </table>
                </div>
                <div class="mt-auto flex justify-end pt-3 font-normal">
                </div>
            </div>
        </div>
    </div>

    <div id="allClientModel">
        <!-- Add client model-->
        <div id="addClientModelDiv" role="dialog"
            class="fixed hidden inset-0 flex items-center justify-center bg-black bg-opacity-50 z-10">
        </div>
        <!-- Edit client model-->
        <div id="editClientModalDiv" role="dialog"
            class="fixed hidden inset-0 flex items-center justify-center bg-black bg-opacity-50 z-10">
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" tabindex="-1"
        class="fixed hidden inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="delete-modal relative bg-white rounded-lg">
            <div class="p-4 md:p-5 text-center">
                <div class="delete-header flex items-center gap-4 mb-1 py-1">
                    <i class="ri-delete-bin-6-line ri-xl text-c-yellow"></i>
                    <h1 class="text-lg font-medium">Delete Client</h1>
                </div>
                <hr>
                <div class="mt-6 flex items-center justify-center">
                    <h1 class="text-md font-medium text-c-black">
                        Are you sure? This action cannot be undone!
                    </h1>
                </div>
                <div class="flex items-center justify-center gap-3 mt-9">
                    <button id="okdelete" class="bg-c-black text-white rounded-full px-12 sm:px-14 py-2" type="button">
                        OK
                    </button>
                    <button id="canceldelete"class="bg-white text-c-yellow px-9 sm:px-12 py-2 rounded-full border border-c-yellow">
                        Cancel
                    </button>
                    <input type="hidden" id="delete-id" value="">
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '#allClientModel .togglePassword', function(e) {
            var passwordField = $('#allClientModel .password');
            var toggleIcon = $(this).find('.toggleIcon');
            var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            toggleIcon.toggleClass('ri-eye-line ri-eye-off-line');
            });

            // Populate the table with client data
            populateTable();

            function populateTable(searchTerm = '', page = 1) {
                const listroute = @json(route('clients.list'));
                $.ajax({
                    url: listroute,
                    method: 'GET',
                    data: {
                        page: page,
                        searchTerm: searchTerm
                    },
                    success: function(response) {
                        $('#searchableTableBody').html(response.html);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Search handling
            $('#searchterm').on('input', function() {
                populateTable($(this).val());
            });

            // Pagination handling
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                populateTable($('#searchterm').val(), page);
            });

            // Add client modal
            $('.addclientmodel').on('click', function() {
                $.ajax({
                    url: @json(route('clients.add')),
                    method: 'GET',
                    success: function(response) {
                        $('#addClientModelDiv').html(response.html).show();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $(document).on('click', '#addClientModelDiv .closeModalButton', function() {
                $('#addClientModelDiv').hide();
            });

            // Save new client
            $(document).on('submit', '#addClientModelDiv #newclient', function(e) {
                e.preventDefault();
                const form = $(this);
                const formData = form.serialize();
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if(response.success) toastr.success(response.success);
                        else toastr.error(response.error);
                        $('#addClientModelDiv').hide();
                        populateTable();
                    },
                    error: function(xhr) {
                        handleErrors(xhr, form);
                    }
                });
            });

            // Edit client modal
            $(document).on('click', '#searchableTableBody .editClientModal', function() {
                const clientId = $(this).data('client');
                $.ajax({
                    url: @json(route('clients.edit')),
                    method: 'GET',
                    data: { clientid: clientId },
                    success: function(response) {
                        $('#editClientModalDiv').html(response.html).show();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $(document).on('click', '#editClientModalDiv .closeModalButton', function() {
                $('#editClientModalDiv').hide();
            });

            // Update client
            $(document).on('submit', '#editClientModalDiv #editclient', function(e) {
                e.preventDefault();
                const form = $(this);
                const formData = form.serialize();
                $.ajax({
                    url: form.attr('action'),
                    method: 'PUT',
                    data: formData,
                    success: function(response) {
                        if(response.success) toastr.success(response.success);
                        else toastr.error(response.error);
                        $('#editClientModalDiv').hide();
                        populateTable();
                    },
                    error: function(xhr) {
                        handleErrors(xhr, form);
                    }
                });
            });

            // Delete client confirmation
            let deleteClientId;
            $(document).on('click', '.deleteClient', function() {
                deleteClientId = $(this).data('id');
                $('#delete-id').val(deleteClientId);
                $('#delete-modal').removeClass('hidden');
            });

            // Confirm delete
            $('#okdelete').on('click', function() {
                $.ajax({
                    url: @json(route('clients.delete')),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: deleteClientId
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        $('#delete-modal').addClass('hidden');
                        populateTable();
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred. Please try again.');
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#canceldelete').on('click', function() {
                $('#delete-modal').addClass('hidden');
            });

            function handleErrors(xhr, form) {
                if (xhr.status === 400) {
                    const errors = xhr.responseJSON.errors;
                    form.find('small.text-red-500').text('');
                    $.each(errors, function(field, messages) {
                        form.find(`[name="${field}"]`).siblings('small').text(messages[0]);
                    });
                } else {
                    console.error(xhr.responseText);
                }
            }
        });
    </script>
@endsection
