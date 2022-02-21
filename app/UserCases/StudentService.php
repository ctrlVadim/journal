<?php


namespace App\UserCases;


use App\Http\Requests\StudentRequest;
use App\Models\Student;
use phpDocumentor\Reflection\Types\Void_;

class StudentService
{
    public function store(StudentRequest $request) : Student
    {
        return Student::create($request->validated());
    }

    public function update(StudentRequest $request, Student $student) : Student
    {
        $student->update($request->validated());

        return $student;
    }

    public function remove(Student $student) : Void_
    {
        $student->delete();
    }
}
