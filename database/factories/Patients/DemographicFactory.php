<?php

namespace Database\Factories\Patients;

use App\Models\Users\User;
use Database\Factories\Users\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patients\Demographic>
 */
class DemographicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $genre = fake()->randomElement(['male', 'female']);
        return [
            'title'                 => fake()->randomElement(['unassigned', 'mr', 'mrs', 'ms', 'dr', 'other']),
            'firstName'             => fake()->firstName($genre),
            'middleName'            => fake()->firstName($genre),
            'lastName'              => fake()->lastName(),
            'dateOfBirth'           => fake()->dateTimeBetween('-80 years', '-2 years'),
            'genre'                 => $genre,
            'socialSecurityNumber'  => fake()->unique()->randomNumber(9),
            'driverLicenseNumber'   => fake()->unique()->randomNumber(9),
            'street'                => fake()->streetName(),
            'city'                  => fake()->city(),
            'zip'                   => fake()->randomNumber(5),
            'country'               => fake()->countryCode(),
            'homePhone'             => fake()->phoneNumber(),
            'emailAddress'          => fake()->safeEmail(),
            'civilStatus'           => fake()->randomElement(['unassigned', 'single', 'married', 'divorced', 'widowed', 'separated', 'domesticPartner', 'other']),
            'language'              => fake()->randomElement(['en', 'es']),
            'ethnicity'             => fake()->randomElement(['latino', 'nonLatino']),
            'race'                  => fake()->randomElement(['white', 'africanAmerican', 'asian', 'latino']),
        ];
    }
}
