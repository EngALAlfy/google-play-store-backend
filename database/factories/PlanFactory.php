<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Plan;

class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'accounts_count' => $this->faker->numberBetween(-10000, 10000),
            'old_accounts' => $this->faker->boolean(),
            'photo' => $this->faker->regexify('[A-Za-z0-9]{2048}'),
            'website' => $this->faker->regexify('[A-Za-z0-9]{255}'),
        ];
    }
}
