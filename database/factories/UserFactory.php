<?php

namespace Database\Factories;

use App\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserModelFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition(): array
    {
        return [
            'Email' => $this->faker->unique()->safeEmail(),
            'Password' => Hash::make('password123'), // use a known password for testing
            'Role' => 'user', // or use $this->faker->randomElement(['admin', 'user'])
        ];
    }
}
