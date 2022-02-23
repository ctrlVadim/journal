<?php


namespace App\UserCases;


use App\Http\Requests\GradeRequest;
use App\Http\Requests\Search\FilterRequest;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;

class GradeService
{
    public function store(GradeRequest $form) : Grade
    {
        return Grade::create($form->validated());
    }


    public function update(GradeRequest $form, Grade $grade) : Grade
    {
        $grade->update($form->validated());

        return $grade;
    }


    public function remove(Grade $grade)
    {
        $grade->delete();
    }

    public function search(FilterRequest $filter = null)
    {
        $query = Grade::with(['student', 'subject']);

        if (isset($filter)){
            if (isset($filter['search']) && $filter['search'] && isset($filter['search_field']) && in_array($filter['search_field'], Grade::SEARCH_FIELDS)){
                switch ($filter['search_field']){
                    case 'student':
                        $query
                            ->join('student', 'student.id', '=', 'grade.student_id')
                            ->orWhere('student.name', 'like', "%".$filter['search']."%")
                            ->orWhere('student.surname', 'like', "%".$filter['search']."%")
                            ->orWhere('student.patronymic', 'like', "%".$filter['search']."%")
                            ->orWhere(DB::raw('CONCAT(student.name, student.surname)'), 'like', "%".$filter['search']."%")
                            ->orWhere(DB::raw('CONCAT(student.name, student.patronymic)'), 'like', "%".$filter['search']."%")
                            ->orWhere(DB::raw('CONCAT(student.surname, student.patronymic)'), 'like', "%".$filter['search']."%")
                            ->orWhere(DB::raw('CONCAT(student.name, student.surname, student.patronymic)'), 'like', "%".$filter['search']."%");
                        break;
                    case 'subject':
                        $query
                            ->join('subject', 'subject.id', '=', 'grade.subject_id')
                            ->where('subject.name', 'like', "%".$filter['search']."%");
                        break;
                    default:
                        $query->where($filter['search_field'], 'like', "%".$filter['search']."%");
                }
            }

            if (isset($filter['sort']) && in_array($filter['sort'], ['ASC', 'DESC']) && isset($filter['sort_field']) && in_array($filter['sort_field'], Grade::SEARCH_FIELDS)){
                switch ($filter['sort_field']){
                    case 'student':
                        $query->join('student', 'student.id', '=', 'grade.student_id')->orderBy('student.name', $filter['sort']);
                        break;
                    case 'subject':
                        $query->join('subject', 'subject.id', '=', 'grade.subject_id')->orderBy('subject.name', $filter['sort']);
                        break;
                    default:
                        $query->orderBy($filter['sort_field'], $filter['sort']);
                }
            }
        }

        return $query->get();
    }
}
