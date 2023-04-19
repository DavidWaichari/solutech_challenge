<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create an admin for solutech
        //check if david exists
        $user = User::where('email', 'dwaichari@gmail.com')->first();

        if ($user == '') {
            User::create([
                'name'=>'David Waichari',
                'email'=>'dwaichari@gmail.com',
                'password' => Hash::make('secret1234'),
            ]);
        }
    }
}
