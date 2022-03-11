<?php

namespace App\Http\Controllers;


use App\Http\Requests\GradeRequest;
use App\Http\Requests\Search\FilterRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Grade;
use App\Models\Student;
use App\UserCases\GradeService;
use App\UserCases\StudentService;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    public StudentService $service;

    public function __construct(StudentService $service)
    {
        $this->service = $service;
    }

    public function show(FilterRequest $request)
    {
        return response()->json($this->service->search($request), 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function view() : JsonResponse
    {
        $student = Student::paginate(1);
        return response()->json($student, 200);
    }

    public function item(int $id)
    {
        if ($student = Student::where('id', $id)->first())
            return response()->json($student, 200);
        else
            return response()->json('Not found', 404);
    }
    /**
     * @param StudentRequest $request
     * @return JsonResponse
     */
    public function store(StudentRequest $request) : JsonResponse
    {
        try {
            return response()->json($this->service->store($request), 201);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param StudentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(StudentRequest $request, int $id) : JsonResponse
    {
        try {
            if ($student = Student::where('id', $id)->first())
                return response()->json($this->service->update($request, $student), 205);
            else
                return response()->json('Not found', 404);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id) : JsonResponse
    {
        try {
            if ($student = Student::where('id', $id)->first()){
                $this->service->remove($student);

                return response()->json( 'OK', 200);
            } else
                return response()->json('Not found', 404);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
