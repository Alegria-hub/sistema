<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeedes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeders creados manualmente
        //User::create(["name"=>"Lizbeth","email"=>"liz_fc@gmail.com","password"=>"123456"]);
        //User::create(["name"=>"Karla","email"=>"karla_mp@gmail.com","password"=>"12345678"]);
        // Seeders creados automaticamente
        User::factory()->times(7)->create();
    }
}
