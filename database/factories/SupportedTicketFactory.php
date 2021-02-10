<?php

namespace Database\Factories;

use App\Models\SupportedTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupportedTicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SupportedTicket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->paragraph(),
        ];
    }
}
