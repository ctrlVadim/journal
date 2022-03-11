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
    public function view() : JsonResponse
    {
        $speciality = Speciality::paginate(1);
        return response()->json($speciality, 200);
    }

    public function item(int $id)
    {
        if ($speciality = Speciality::where('id', $id)->first())
            return response()->json($speciality, 200);
        else
            return response()->json('Not found', 404);
    }


    /**
     * @param SpecialityRequest $request
     * @return JsonResponse
     */
    public function store(SpecialityRequest $request) : JsonResponse
    {
        try {
            return response()->json($this->service->store($request), 201);
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
            if ($speciality = Speciality::where('id', $id)->first())
                return response()->json($this->service->update($request, $speciality), 205);
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
            if ($speciality = Speciality::where('id', $id)->first()){
                $this->service->remove($speciality);

                return response()->json( 'OK', 200);
            } else
                return response()->json('Not found', 404);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
