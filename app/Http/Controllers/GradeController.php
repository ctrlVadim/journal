<?php

namespace App\Http\Controllers;


use App\Http\Requests\GradeRequest;
use App\Models\Grade;
use App\UserCases\GradeService;
use Illuminate\Http\JsonResponse;

class GradeController extends Controller
{
    public $service;

    public function __construct(GradeService $service)
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function show() : JsonResponse
    {
        return response()->json(Grade::with(['student', 'subject'])->get(), 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function view(int $id) : JsonResponse
    {
        if ($grade = Grade::where('id', $id)->first()){
            return response()->json($grade, 200);
        }else{
            return response()->json('Grade not found', 404);
        }
    }

    /**
     * @param GradeRequest $request
     * @return JsonResponse
     */
    public function store(GradeRequest $request) : JsonResponse
    {
        try {
            return response()->json($this->service->create($request), 201);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param GradeRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(GradeRequest $request, int $id) : JsonResponse
    {
        try {
            if ($grade = Grade::where('id', $id)->first())
                return response()->json($this->service->update($request, $grade), 205);
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
            if ($grade = Grade::where('id', $id)->first()){
                $this->service->remove($grade);

                return response()->json( 'OK', 200);
            } else
                return response()->json('Not found', 404);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
