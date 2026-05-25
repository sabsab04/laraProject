<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->firstName(), // Solo il nome
            'surname' => fake()->lastName(), // Solo il cognome
            'birth_date' => fake()->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'), // Data di nascita fake per maggiorenni
            'username' => fake()->unique()->userName(), 
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => 2, // Di default crea Clienti (Livello 2)
            'organization' => null, // I clienti non hanno un'organizzazione
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}