<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entrada;

class EntradasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Entrada::factory()->times(20)->create();
    }
}
