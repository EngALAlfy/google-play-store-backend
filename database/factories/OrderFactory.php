<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Account;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'buyer_id' => User::factory(),
            'seller_id' => User::factory(),
            'account_id' => Account::factory(),
            'broker_id' => User::factory(),
            'total_price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'description' => $this->faker->text(),
            'photo' => $this->faker->regexify('[A-Za-z0-9]{2048}'),
            'website' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'user_id' => User::factory(),
        ];
    }
}
