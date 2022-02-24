<?php

namespace App\Http\Controllers;


use App\Http\Requests\GradeRequest;
use App\Http\Requests\Search\FilterRequest;
use App\Http\Requests\SpecialityRequest;
use App\Models\Grade;
use App\Models\Speciality;
use App\UserCases\GradeService;
use App\UserCases\SpecialityService;
use Illuminate\Http\JsonResponse;

class SpecialityController extends Controller
{
    public SpecialityService $service;

    public function __construct(SpecialityService $service)
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
    public function view(int $id) : JsonResponse
    {
        if ($grade = Speciality::where('id', $id)->first()){
            return response()->json($grade, 200);
        }else{
            return response()->json('Grade not found', 404);
        }
    }

    /**
     * @param SpecialityRequest $request
     * @return JsonResponse
     */
    public function store(SpecialityRequest $request) : JsonResponse
    {
        try {
            return response()->json($this->service->create($request), 201);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param SpecialityRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(SpecialityRequest $request, int $id) : JsonResponse
    {
        try {
            if ($grade = Speciality::where('id', $id)->first())
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
            if ($grade = Speciality::where('id', $id)->first()){
                $this->service->remove($grade);

                return response()->json( 'OK', 200);
            } else
                return response()->json('Not found', 404);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
