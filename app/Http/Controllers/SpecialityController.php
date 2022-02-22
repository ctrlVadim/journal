<?php

namespace App\Http\Controllers;


use App\Http\Requests\SpecialityRequest;
use App\Models\Speciality;
use App\UserCases\SpecialityService;

class SpecialityController extends Controller
{
    public $service;

    public function __construct(SpecialityService $service)
    {
        $this->service = $service;
    }


    public function show()
    {
        return response()->json(Speciality::all(), 200);
    }


    public function view(int $id)
    {
        if ($speciality = Speciality::where('id', $id)->first()){
            return response()->json($speciality, 200);
        }else{
            return response()->json('Grade not found', 404);
        }
    }


    public function store(SpecialityRequest $request)
    {
        try {
            return response()->json($this->service->create($request), 201);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }


    public function update(SpecialityRequest $request, int $id)
    {
        try {
            if ($speciality = Speciality::where('id', $id)->first())
                return response()->json($this->service->update($speciality), 200);
            else
                return response()->json('Not found', 404);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }


    public function remove(int $id)
    {
        try {
            if ($speciality = Speciality::where('id', $id)->first())
                return response()->json($this->service->remove($speciality), 200);
            else
                return response()->json('Not found', 404);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
