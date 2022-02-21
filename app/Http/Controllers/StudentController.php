<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\UserCases\StudentService;

class StudentController extends Controller
{
    public $service;

    public function __construct(StudentService $service)
    {
        $this->service = $service;
    }


    public function show()
    {
        return response()->json(Student::with('subject')->all(), 200);
    }


    public function view(int $id)
    {
        if ($student = Student::where('id', $id)->first()){
            return response()->json($student, 200);
        }else{
            return response()->json('Student not found', 404);
        }
    }


    public function store(StudentRequest $request)
    {
        try {
            return response()->json($this->service->create($request), 201);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }


    public function update(StudentRequest $request, Student $student)
    {
        try {
            return response()->json($this->service->update($request, $student), 205);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }


    public function remove(Student $student)
    {
        try {
            return response()->json($this->service->remove($student), 200);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
