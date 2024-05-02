<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\utilisateur>
 */
class UtilisateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['utilisateur', 'administrateur']);
        $name = $type == 'utilisateur' ? $this->faker->name : $this->faker->userName;

        return [
            'nom' => $name,
            'prenom' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'role' => $type,
     
        ];
    }
}
