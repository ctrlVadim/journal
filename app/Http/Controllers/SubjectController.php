<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\UserCases\SubjectService;

class SubjectController extends Controller
{
    public $service;

    public function __construct(SubjectService $service)
    {
        $this->service = $service;
    }


    public function show()
    {
        return response()->json(Subject::with(['user', 'subject'])->all(), 200);
    }


    public function view(int $id)
    {
        if ($subject = Subject::where('id', $id)->first()){
            return response()->json($subject, 200);
        }else{
            return response()->json('Grade not found', 404);
        }
    }


    public function store(SubjectRequest $request)
    {
        try {
            return response()->json($this->service->create($request), 201);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }


    public function update(SubjectRequest $request, Subject $subject)
    {
        try {
            return response()->json($this->service->update($request, $subject), 205);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }


    public function remove(Subject $subject)
    {
        try {
            return response()->json($this->service->remove($subject), 200);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
