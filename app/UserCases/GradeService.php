<?php


namespace App\UserCases;


use App\Http\Requests\GradeRequest;
use App\Models\Grade;
use phpDocumentor\Reflection\Types\Void_;
use PhpOption\None;

class GradeService
{
    public function store(GradeRequest $request) : Grade
    {
        return Grade::create($request->validated());
    }


    public function update(GradeRequest $request, Grade $grade) : Grade
    {
        $grade->update($request->validated());

        return $grade;
    }


    public function remove(Grade $grade)
    {
        $grade->delete();
    }
}
