<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'firstname' => 'Shaniel',
            'lastname' => 'Samadhan',
            'email' => 'shaniel29samadhan@gmail.com',
            'e_id_number' => 'FS289916 M',
            'address' => 'Commissaris Thurkowweg 39',
            'mobile' => 8958112,
            'type' => 'admin',
            'password' => Hash::make('admin1234'),
        ]);
    }
}
