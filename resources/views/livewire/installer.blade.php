<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="container mx-auto p-6">
        <div class="bg-white p-8 shadow-lg rounded-lg w-full max-w-3xl">
            <!-- Progress bar -->
            <div class="flex items-center mb-6">
                <div class="w-full bg-gray-300 h-2 rounded-full">
                    <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $step * 25 }}%;"></div>
                </div>
                <span class="ml-4 text-black font-bold flex items-center">
                    <i class="ri-step-forward-fill text-yellow-500 mr-2"></i> Step {{ $step }} of 4
                </span>
            </div>

            <!-- Step 1: Extensions and Permissions -->
            @if($step == 1)
                <form wire:submit.prevent="nextStep">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold mb-4 flex items-center">
                            <i class="ri-checkbox-multiple-fill text-yellow-500 mr-2"></i> Check Extensions & Permissions
                        </h2>
                        <ul>
                            @foreach($extensions as $extension => $status)
                                <li class="flex items-center mb-2">
                                    <i class="ri-{{ $status ? 'checkbox-circle-fill text-green-500' : 'close-circle-fill text-red-500' }}"></i>
                                    <span class="ml-2">{{ $extension }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <ul>
                            @foreach($permissions as $folder => $status)
                                <li class="flex items-center mb-2">
                                    <i class="ri-{{ $status ? 'checkbox-circle-fill text-green-500' : 'close-circle-fill text-red-500' }}"></i>
                                    <span class="ml-2">{{ $folder }} permission</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-yellow-500 text-black py-2 px-4 rounded">Next</button>
                    </div>
                </form>
            @endif

            <!-- Step 2: Database Connectivity -->
            @if($step == 2)
                <form wire:submit.prevent="nextStep">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold mb-4 flex items-center">
                            <i class="ri-database-fill text-yellow-500 mr-2"></i> Database Connectivity
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <input type="text" wire:model="db_details.DB_HOST" placeholder="DB Host" class="input-field w-full p-2 border rounded">
                                @error('db_details.DB_HOST') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="text" wire:model="db_details.DB_PORT" placeholder="DB Port" class="input-field w-full p-2 border rounded">
                                @error('db_details.DB_PORT') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="text" wire:model="db_details.DB_DATABASE" placeholder="DB Database" class="input-field w-full p-2 border rounded">
                                @error('db_details.DB_DATABASE') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="text" wire:model="db_details.DB_USERNAME" placeholder="DB Username" class="input-field w-full p-2 border rounded">
                                @error('db_details.DB_USERNAME') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="password" wire:model="db_details.DB_PASSWORD" placeholder="DB Password" class="input-field w-full p-2 border rounded">
                                @error('db_details.DB_PASSWORD') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-6">
                        <button type="button" wire:click="previousStep" class="bg-black text-white py-2 px-4 rounded">Previous</button>
                        <button type="submit" class="bg-yellow-500 text-black py-2 px-4 rounded">Next</button>
                    </div>
                </form>
            @endif

            <!-- Step 3: Company & SMTP Details -->
            @if($step == 3)
                <form wire:submit.prevent="nextStep">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold mb-4 flex items-center">
                            <i class="ri-building-fill text-yellow-500 mr-2"></i> Company & SMTP Details
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <input type="text" wire:model="company_details.COMPANY_NAME" placeholder="Company Name" class="input-field w-full p-2 border rounded">
                                @error('company_details.COMPANY_NAME') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="text" wire:model="company_details.COMPANY_EMAIL" placeholder="Company Email" class="input-field w-full p-2 border rounded">
                                @error('company_details.COMPANY_EMAIL') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="text" wire:model="company_details.MAIL_HOST" placeholder="Mail Host" class="input-field w-full p-2 border rounded">
                                @error('company_details.MAIL_HOST') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="text" wire:model="company_details.MAIL_PORT" placeholder="Mail Port" class="input-field w-full p-2 border rounded">
                                @error('company_details.MAIL_PORT') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="text" wire:model="company_details.MAIL_USERNAME" placeholder="Mail Username" class="input-field w-full p-2 border rounded">
                                @error('company_details.MAIL_USERNAME') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="text" wire:model="company_details.MAIL_PASSWORD" placeholder="Mail Password" class="input-field w-full p-2 border rounded">
                                @error('company_details.MAIL_PASSWORD') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="text" wire:model="company_details.MAIL_ENCRYPTION" placeholder="Mail ENCRYPTION" class="input-field w-full p-2 border rounded">
                                @error('company_details.MAIL_ENCRYPTION') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="text" wire:model="company_details.MAIL_FROM_ADDRESS" placeholder="Mail FROM ADDRESS" class="input-field w-full p-2 border rounded">
                                @error('company_details.MAIL_FROM_ADDRESS') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-6">
                        <button type="button" wire:click="previousStep" class="bg-black text-white py-2 px-4 rounded">Previous</button>
                        <button type="submit" class="bg-yellow-500 text-black py-2 px-4 rounded">Next</button>
                    </div>
                </form>
            @endif

            <!-- Step 4: Admin Details -->
            @if($step == 4)
                <form wire:submit.prevent="nextStep">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold mb-4 flex items-center">
                            <i class="ri-admin-fill text-yellow-500 mr-2"></i> Admin Account
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <input type="text" wire:model="admin_details.name" placeholder="Name" class="input-field w-full p-2 border rounded">
                                @error('admin_details.name') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="text" wire:model="admin_details.username" placeholder="Username" class="input-field w-full p-2 border rounded">
                                @error('admin_details.username') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="text" wire:model="admin_details.email" placeholder="Email" class="input-field w-full p-2 border rounded">
                                @error('admin_details.email') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input type="password" wire:model="admin_details.password" placeholder="Password" class="input-field w-full p-2 border rounded">
                                @error('admin_details.password') <span class="text-red-500 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-6">
                        <button type="button" wire:click="previousStep" class="bg-black text-white py-2 px-4 rounded">Previous</button>
                        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
