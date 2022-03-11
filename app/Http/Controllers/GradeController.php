<?php

namespace App\Http\Controllers;


use App\Http\Requests\GradeRequest;
use App\Http\Requests\Search\FilterRequest;
use App\Models\Grade;
use App\UserCases\GradeService;
use Illuminate\Http\JsonResponse;

class GradeController extends Controller
{
    public GradeService $service;

    public function __construct(GradeService $service)
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
        $grade = Grade::paginate(1);
        return response()->json($grade, 200);
    }

    public function item(int $id)
    {
        if ($grade = Grade::where('id', $id)->first())
            return response()->json($grade, 200);
        else
            return response()->json('Not found', 404);
    }

    /**
     * @param GradeRequest $request
     * @return JsonResponse
     */
    public function store(GradeRequest $request) : JsonResponse
    {
        try {
            $request['date'] = date('Y-d-m', strtotime($request['date']));
            return response()->json($this->service->store($request), 201);
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
        $request['date'] = date('Y-d-m', strtotime($request['date']));
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
