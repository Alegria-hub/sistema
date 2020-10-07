<?php

namespace Database\Factories;

use App\Models\Entrada;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntradaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entrada::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $total=User::count();
        return [
            "titulo"=>$this->faker->name,
            "contenido"=>$this->faker->text($maxNbChars=400),
            "user_id"=>$this->faker->numberBetween(1,$total)
        ];
    }
}
