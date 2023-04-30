<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Vernands',
            'email' => 'vernan@email.com',
            'password' => bcrypt('vernan'),
            'is_admin' => false
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('admin'),
            'is_admin' => true
        ]);
    }
}
