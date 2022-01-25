<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->insert([
            'uuid'=>Str::uuid(),
            'name'=> 'Admin',
            'email'=> 'admin@admin.com',
            'email_verified_at'=>now(),
            'password'=> Hash::make('123456789'),
            'remember_token'=> Str::random(10)
        ]);
    }
}
