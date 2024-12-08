<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Account;
use App\Models\User;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'seller_id' => User::factory(),
            'creation_date' => $this->faker->date(),
            'apps_count' => $this->faker->numberBetween(-10000, 10000),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'photo' => $this->faker->regexify('[A-Za-z0-9]{2048}'),
            'website' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'user_id' => User::factory(),
        ];
    }
}
