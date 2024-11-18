<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_type')->insert([
            [
                'name' => 'Master',
                'flag' => 'master',
                'related_table' => 'users',
                'level' => 1,
                'voice_authentication' => 0,
                'face_authentication' => 0,
            ],
            [
                'name' => 'Client',
                'flag' => 'client',
                'related_table' => 'client',
                'level' => 2,
                'voice_authentication' => 0,
                'face_authentication' => 0,
            ],
            [
                'name' => 'Company',
                'flag' => 'company',
                'related_table' => 'company',
                'level' => 3,
                'voice_authentication' => 1,
                'face_authentication' => 1,
            ],
            [
                'name' => 'Group',
                'flag' => 'group',
                'related_table' => 'groups',
                'level' => 4,
                'voice_authentication' => 1,
                'face_authentication' => 1,
            ],
            [
                'name' => 'User',
                'flag' => 'user',
                'related_table' => 'users',
                'level' => 5,
                'voice_authentication' => 1,
                'face_authentication' => 1,
            ],
        ]);
    }
}
