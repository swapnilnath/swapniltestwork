<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'role_id' => '1',
        ]);

        User::create([
            'name' => 'testeditor',
            'email' => 'testeditor@admin.com',
            'password' => Hash::make('12345678'),
            'role_id' => '2',
        ]);

        User::create([
            'name' => 'testuser',
            'email' => 'testuser@admin.com',
            'password' => Hash::make('12345678'),
            'role_id' => '3',
        ]);

        User::create([
            'name' => 'demouser',
            'email' => 'demouser@admin.com',
            'password' => Hash::make('12345678'),
            'role_id' => '3',
        ]);       
    }
}
