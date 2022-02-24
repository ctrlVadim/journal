<?php

namespace App\UserCases;


use App\Http\Requests\StudentRequest;
use App\Http\Requests\Search\FilterRequest;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class StudentService
{
    /**
     * @param StudentRequest $form
     * @return Student
     */
    public function store(StudentRequest $form) : Student
    {
        return Student::create($form->validated());
    }

    /**
     * @param StudentRequest $form
     * @param Student $student
     * @return Student
     */
    public function update(StudentRequest $form, Student $student) : Student
    {
        $student->update($form->validated());

        return $student;
    }

    /**
     * @param Student $student
     */
    public function remove(Student $student) : void
    {
        $student->delete();
    }

    /**
     * @param FilterRequest|null $filter
     * @return Collection
     */
    public function search(FilterRequest $filter = null) : Collection
    {
        $query = Student::where('id', '>', 0);

        if (isset($filter)){
            if (
                isset($filter['search']) && $filter['search']
                && (
                    isset($filter['search_field'])
                    && in_array($filter['search_field'], Student::SEARCH_FIELDS)
                )){
                $query->where($filter['search_field'], 'like', "%".$filter['search']."%");
            }

            if (isset($filter['sort']) && in_array($filter['sort'], ['ASC', 'DESC'])
                && isset($filter['sort_field'])
                && in_array($filter['sort_field'], Student::SEARCH_FIELDS)){
                $query->orderBy($filter['sort_field'], $filter['sort']);
            }
        }
        return $query->get();
    }
}
