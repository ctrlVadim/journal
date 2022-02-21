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
        return response()->json(Speciality::with(['user', 'subject'])->all(), 200);
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


    public function update(SpecialityRequest $request, Speciality $speciality)
    {
        try {
            return response()->json($this->service->update($request, $speciality), 205);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }


    public function remove(Speciality $speciality)
    {
        try {
            return response()->json($this->service->remove($speciality), 200);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
