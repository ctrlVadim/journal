<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => Student::all()->random()->id,
            'subject_id' => Subject::all()->random()->id,
            'date' => $this->faker->date,
            'grade' => $this->faker->numberBetween(1, 5),
        ];
    }
}
