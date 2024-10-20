<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            "name"=>"admin",
            "address"=>"aaaaa",
            "email"=>"aaa@gmail.com",
            "account"=>"aaaaa",
            "password"=>Hash::make("gorin"),
        ]);
    }
}
