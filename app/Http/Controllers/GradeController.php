<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeRequest;
use App\Models\Grade;
use App\UserCases\GradeService;

class GradeController extends Controller
{
    public $service;

    public function __construct(GradeService $service)
    {
        $this->service = $service;
    }


    public function show()
    {
        return response()->json(Grade::with(['student', 'subject'])->get(), 200);
    }


    public function view(int $id)
    {
        if ($grade = Grade::where('id', $id)->first()){
            return response()->json($grade, 200);
        }else{
            return response()->json('Grade not found', 404);
        }
    }


    public function store(GradeRequest $request)
    {
        try {
            return response()->json($this->service->create($request), 201);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }


    public function update(GradeRequest $request, Grade $grade)
    {
        try {
            return response()->json($this->service->update($request, $grade), 205);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }


    public function remove(Grade $grade)
    {
        try {
            return response()->json($this->service->remove($grade), 200);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
