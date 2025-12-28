<?php

namespace App\Containers\AppSection\User\Data\Factories;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Factories\FactoryParent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @phpstan-extends FactoryParent<User>
 */
final class UserFactory extends FactoryParent
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'login' => $this->faker->word(),
            'password' => Hash::make('Password1'),
        ];
    }
}
