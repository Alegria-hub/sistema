<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->truncateTables([
            "users",
            "entradas",
            "comentarios"
        ]);
        //$this->call(UsersTableSeedes::class);
        $this->call(entradasTableSeeder::class);
    }
    public function truncateTables(array $tables){
        foreach ($tables as $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table($table)->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}
