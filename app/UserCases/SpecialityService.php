<?php


namespace App\UserCases;


use App\Http\Requests\SpecialityRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Speciality;
use App\Models\Student;
use phpDocumentor\Reflection\Types\Void_;

class SpecialityService
{
    public function store(SpecialityRequest $request) : Speciality
    {
        return Speciality::create($request->validated());
    }


    public function update(SpecialityRequest $request, Speciality $speciality) : Speciality
    {
        $speciality->update($request->validated());

        return $speciality;
    }


    public function remove(Speciality $speciality) : Void_
    {
        $speciality->delete();
    }
}
