<?php

namespace App\Http\Controllers;


use App\Http\Requests\Search\FilterRequest;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\UserCases\SubjectService;
use Illuminate\Http\JsonResponse;

class SubjectController extends Controller
{
    public SubjectService $service;

    public function __construct(SubjectService $service)
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
        if ($grade = Subject::where('id', $id)->first()){
            return response()->json($grade, 200);
        }else{
            return response()->json('Grade not found', 404);
        }
    }

    /**
     * @param SubjectRequest $request
     * @return JsonResponse
     */
    public function store(SubjectRequest $request) : JsonResponse
    {
        try {
            return response()->json($this->service->create($request), 201);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param SubjectRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(SubjectRequest $request, int $id) : JsonResponse
    {
        try {
            if ($grade = Subject::where('id', $id)->first())
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
            if ($grade = Subject::where('id', $id)->first()){
                $this->service->remove($grade);

                return response()->json( 'OK', 200);
            } else
                return response()->json('Not found', 404);
        }catch (\DomainException $e){
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
