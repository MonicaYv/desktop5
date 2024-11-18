<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class Installer extends Component
{
    public $step = 1;
    public $extensions = [];
    public $permissions = [];
    public $db_details = [
        'DB_HOST' => '127.0.0.1',
        'DB_PORT' => '3306',
        'DB_DATABASE' => '',
        'DB_USERNAME' => '',
        'DB_PASSWORD' => '',
    ];
    public $company_details = [
        'COMPANY_NAME' => '',
        'COMPANY_EMAIL' => '',
        'MAIL_HOST' => '',
        'MAIL_PORT' => '',
        'MAIL_USERNAME' => '',
        'MAIL_PASSWORD' => '',
        'MAIL_ENCRYPTION' => '',
        'MAIL_FROM_ADDRESS' => '',
    ];
    public $admin_details = [
        'name' => '',
        'username' => '',
        'email' => '',
        'password' => '',
    ];

    public function mount()
    {
        $this->extensions = [
            'PDO' => extension_loaded('pdo'),
            'OpenSSL' => extension_loaded('openssl'),
            'Mbstring' => extension_loaded('mbstring'),
        ];

        $this->permissions = [
            'storage' => is_writable(storage_path()),
            'bootstrap/cache' => is_writable(base_path('bootstrap/cache')),
        ];
    }

    public function nextStep()
    {
        if ($this->step === 1 && !$this->validateExtensionsAndPermissions()) {
            return;
        }

        if ($this->step === 2) {
            $this->validate([
                'db_details.DB_HOST' => 'required',
                'db_details.DB_PORT' => 'required|integer',
                'db_details.DB_DATABASE' => 'required',
                'db_details.DB_USERNAME' => 'required',
                'db_details.DB_PASSWORD' => 'required',
            ]);

            if (!$this->validateDatabaseConnection()) {
                return;
            }
        }

        if ($this->step === 3) {
            $this->validate([
                'company_details.COMPANY_NAME' => 'required|string',
                'company_details.COMPANY_EMAIL' => 'required|email',
                'company_details.MAIL_HOST' => 'required',
                'company_details.MAIL_PORT' => 'required|integer',
                'company_details.MAIL_USERNAME' => 'required',
                'company_details.MAIL_PASSWORD' => 'required',
                'company_details.MAIL_ENCRYPTION' => 'required',
                'company_details.MAIL_FROM_ADDRESS' => 'required',
            ]);
            $this->updateEnvForCompanyDetails();
        }

        if ($this->step === 4) {
            $this->validate([
                'admin_details.name' => 'required|string',
                'admin_details.username' => 'required|alpha_dash|unique:users,username', // No spaces allowed
                'admin_details.email' => 'required|email|unique:users,email',
                'admin_details.password' => 'required|min:8',
            ]);
            Artisan::call('migrate:fresh --seed');
            $this->addAdminDetail();
            $this->updateEnvForAppInstalled();
            Artisan::call('key:generate');
            return redirect()->route('login');

        }

        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    protected function validateExtensionsAndPermissions()
    {

        foreach ($this->extensions as $extension) {
            if (!$extension) {
                $this->addError('extensions', 'Required extensions are missing.');
                return false;
            }
        }

        foreach ($this->permissions as $permission) {
            if (!$permission) {
                $this->addError('permissions', 'Required permissions are not set.');
                return false;
            }
        }

        return true;
    }

    protected function validateDatabaseConnection()
    {
        try {
            config([
                'database.connections.mysql.host' => $this->db_details['DB_HOST'],
                'database.connections.mysql.port' => $this->db_details['DB_PORT'],
                'database.connections.mysql.database' => $this->db_details['DB_DATABASE'],
                'database.connections.mysql.username' => $this->db_details['DB_USERNAME'],
                'database.connections.mysql.password' => $this->db_details['DB_PASSWORD'],
            ]);

            DB::connection()->getPdo();

            return true;
        } catch (\Exception $e) {
            $this->addError('db_connection', 'Database connection failed: ' . $e->getMessage());
            return false;
        }
    }

    protected function updateEnvForCompanyDetails()
    {
        $path = base_path('.env');
        $content = File::get($path);

        foreach ($this->company_details as $key => $value) {
            $content = preg_replace("/^$key=.*/m", "$key=$value", $content);
        }

        File::put($path, $content);

    }
    protected function addAdminDetail()
{
    try {
        $input = array();
        $input['usertype'] = 'master';
        $input['username'] = $this->admin_details['username'];
        $input['name'] = $this->admin_details['name'];
        $input['email'] = $this->admin_details['email'];
        $input['password'] = Hash::make($this->admin_details['password']);
        
        // Attempt to create the user
        $user = User::create($input);
        

        // Check if the user was created successfully
        if (!$user) {
            $this->addError('admin_details', 'Failed to create user.'); exit;
        }else{
            $userid = base64_encode($user->id.env('ENCRYPTION_TOKEN').$user->username);
            if (!File::exists(storage_path('app/root/' .$userid))) {
                File::makeDirectory(storage_path('app/root/' .$userid), 0755, true);
            }
            $basePath = storage_path('app/root/' .$userid);
            $folders = ['Desktop', 'Document', 'Download', 'Gallery', 'Recyclebin'];

            // Create the folders
            foreach ($folders as $folder) {
                $folderPath = $basePath . '/' . $folder;
                if (!File::exists($folderPath)) {
                    File::makeDirectory($folderPath, 0755, true);
                }
            }
        }
    } catch (\Exception $e) {
        // Log and display any error messages
        \Log::error('User creation failed: ' . $e->getMessage());
        $this->addError('admin_details', 'Error creating user: ' . $e->getMessage());
    }
}

    protected function updateEnvForAppInstalled()
{
    $path = base_path('.env');
    $content = File::get($path);

    // Update the APP_INSTALLED key in the .env file
    if (strpos($content, 'APP_INSTALLED') !== false) {
        $content = preg_replace("/^APP_INSTALLED=.*/m", "APP_INSTALLED=true", $content);
    } else {
        // Add the APP_INSTALLED key if it doesn't exist
        $content .= "\nAPP_INSTALLED=true";
    }

    File::put($path, $content);
}

    public function render()
    {
        return view('livewire.installer')->layout('components.layouts.app');
    }
}
