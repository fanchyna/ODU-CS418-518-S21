<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'    => 'Pooja Sonmale',
            'email'    => 'pooja24sonmale@gmail.com',
            'password'   =>  Hash::make('password'),
            'remember_token' =>  str::random(10),
        ]);
    }
}