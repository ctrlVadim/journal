<?php

namespace Database\Factories;

use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->firstName,
            'patronymic' => $this->faker->firstName,
            'gender' => $this->faker->randomElement(['Ж', 'М']),
            'birth' => $this->faker->date,
            'date_of_admission' => $this->faker->date,
            'group' => $this->faker->text(10),
            'course' => $this->faker->numberBetween(1, 4),
            'speciality_id' => Speciality::all()->random()->id,
            'form_of_study' => $this->faker->boolean(),
            'parents' => $this->faker->randomElement(['Нет', 'Отец', 'Мать', 'Отец и мать']),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'passport_data' => $this->faker->numberBetween(1000000000, 9999999999),
            'report_card' => $this->faker->numberBetween(10000000, 99999999),
        ];
    }
}
