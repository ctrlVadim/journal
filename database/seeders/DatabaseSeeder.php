<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Speciality;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Subject::factory(10)->create();
        Speciality::factory(10)->create();
        Student::factory(10)->create();
        Grade::factory(300)->create();
    }
}
