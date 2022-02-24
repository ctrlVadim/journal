<?php

namespace App\UserCases;


use App\Http\Requests\SubjectRequest;
use App\Http\Requests\Search\FilterRequest;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Collection;

class SubjectService
{
    /**
     * @param SubjectRequest $form
     * @return Subject
     */
    public function store(SubjectRequest $form) : Subject
    {
        return Subject::create($form->validated());
    }

    /**
     * @param SubjectRequest $form
     * @param Subject $subject
     * @return Subject
     */
    public function update(SubjectRequest $form, Subject $subject) : Subject
    {
        $subject->update($form->validated());

        return $subject;
    }

    /**
     * @param Subject $subject
     */
    public function remove(Subject $subject) : void
    {
        $subject->delete();
    }

    /**
     * @param FilterRequest|null $filter
     * @return Collection
     */
    public function search(FilterRequest $filter = null) : Collection
    {
        $query = Subject::where('id', '>', 0);

        if (isset($filter)){
            if (
                isset($filter['search']) && $filter['search']
                && (
                    isset($filter['search_field'])
                    && in_array($filter['search_field'], Subject::SEARCH_FIELDS)
                )){
                $query->where($filter['search_field'], 'like', "%".$filter['search']."%");
            }

            if (isset($filter['sort']) && in_array($filter['sort'], ['ASC', 'DESC'])
                && isset($filter['sort_field'])
                && in_array($filter['sort_field'], Subject::SEARCH_FIELDS)){
                $query->orderBy($filter['sort_field'], $filter['sort']);
            }
        }
        return $query->get();
    }
}
