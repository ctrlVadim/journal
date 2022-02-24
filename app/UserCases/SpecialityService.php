<?php

namespace App\UserCases;


use App\Http\Requests\SpecialityRequest;
use App\Http\Requests\Search\FilterRequest;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SpecialityService
{
    /**
     * @param SpecialityRequest $form
     * @return Speciality
     */
    public function store(SpecialityRequest $form) : Speciality
    {
        return Speciality::create($form->validated());
    }

    /**
     * @param SpecialityRequest $form
     * @param Speciality $speciality
     * @return Speciality
     */
    public function update(SpecialityRequest $form, Speciality $speciality) : Speciality
    {
        $speciality->update($form->validated());

        return $speciality;
    }

    /**
     * @param Speciality $speciality
     */
    public function remove(Speciality $speciality) : void
    {
        $speciality->delete();
    }

    /**
     * @param FilterRequest|null $filter
     * @return Collection
     */
    public function search(FilterRequest $filter = null) : Collection
    {
        $query = Speciality::where('id', '>', 0);

        if (isset($filter)){
            if (
                isset($filter['search']) && $filter['search']
                 && (
                    isset($filter['search_field'])
                    && in_array($filter['search_field'], Speciality::SEARCH_FIELDS)
                )){
                $query->where($filter['search_field'], 'like', "%".$filter['search']."%");
            }

            if (isset($filter['sort']) && in_array($filter['sort'], ['ASC', 'DESC'])
                && isset($filter['sort_field'])
                && in_array($filter['sort_field'], Speciality::SEARCH_FIELDS)){
                $query->orderBy($filter['sort_field'], $filter['sort']);
            }
        }
        return $query->get();
    }
}
