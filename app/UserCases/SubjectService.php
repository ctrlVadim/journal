<?php


namespace App\UserCases;


use App\Http\Requests\StudentRequest;
use App\Http\Requests\SubjectRequest;
use App\Models\Student;
use App\Models\Subject;
use phpDocumentor\Reflection\Types\Void_;

class SubjectService
{
    public function store(SubjectRequest $request) : Subject
    {
        return Student::create($request->validated());
    }


    public function update(SubjectRequest $request, Subject $subject) : Subject
    {
        $subject->update($request->validated());

        return $subject;
    }


    public function remove(Subject $subject) : Void_
    {
        $subject->delete();
    }
}
