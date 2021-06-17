<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AuthsTableSeeder extends Seeder
{
    /***
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        $admin = new \App\User([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => \Illuminate\Support\Facades\Hash::make('prspadmin'),
            'email_verified_at' => Carbon\Carbon::now()->toDateTimeString(),
            'role' => 'admin',
            'activation_status' => 1,
            'is_logged_in' => 0
        ]);
        $admin->save();

        // $admin->roles()->attach(1, ['created_at' => Carbon\Carbon::now()->toDateTimeString(), 'updated_at' => Carbon\Carbon::now()->toDateTimeString()]);

        //user
        $client = new \App\User([
            'name' => 'manager',
            'email' => 'manager@user.com',
            'password' => \Illuminate\Support\Facades\Hash::make('clientpass'),
            'email_verified_at' => Carbon\Carbon::now()->toDateTimeString(),
            'activation_status' => 1,
            'role' => 'manager',
            'is_logged_in' => 0
        ]);
        $client->save();


          //user
          $client = new \App\User([
            'name' => 'manager',
            'email' => 'user@user.com',
            'password' => \Illuminate\Support\Facades\Hash::make('clientpass'),
            'email_verified_at' => Carbon\Carbon::now()->toDateTimeString(),
            'activation_status' => 1,
            'role' => 'user',
            'is_logged_in' => 0
        ]);
        $client->save();

        // $client->roles()->attach(2, ['created_at' => Carbon\Carbon::now()->toDateTimeString(), 'updated_at' => Carbon\Carbon::now()->toDateTimeString()]);


        // //Admin , mobidev
        // \App\Role::query()->insert([
        //     'name' => 'Admin',
        //     'slug' => 'administrator',
        //     'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        //     'updated_at' => Carbon\Carbon::now()->toDateTimeString()
        // ]);

        // //Client, an app owner
        // \App\Role::query()->insert([
        //     'name' => 'Client',
        //     'slug' => 'client',
        //     'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        //     'updated_at' => Carbon\Carbon::now()->toDateTimeString()
        // ]);


    }
}
