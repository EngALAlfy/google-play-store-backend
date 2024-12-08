<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => $this->faker->password(),
            'facebook' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'whatsapp' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'phone' => $this->faker->phoneNumber(),
            'website' => $this->faker->regexify('[A-Za-z0-9]{255}'),
        ];
    }
}
