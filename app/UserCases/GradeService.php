<?php

namespace App\UserCases;


use App\Http\Requests\GradeRequest;
use App\Http\Requests\Search\FilterRequest;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class GradeService
{
    /**
     * @param GradeRequest $form
     */
    public function store(GradeRequest $form)
    {
        return DB::table('grade')->insert([
            'student_id' => $form['student_id'],
            'subject_id' => $form['subject_id'],
            'grade' => $form['grade'],
            'date' => DB::raw("STR_TO_DATE('".$form['date']."', '%Y-%d-%m')"),
        ]);
    }

    /**
     * @param GradeRequest $form
     * @param Grade $grade
     * @return Grade
     */
    public function update(GradeRequest $form, Grade $grade) : Grade
    {
        DB::table('grade')
            ->where('id', $grade->id)
            ->update([
                'student_id' => $form['student_id'],
                'subject_id' => $form['subject_id'],
                'grade' => $form['grade'],
                'date' => DB::raw("STR_TO_DATE('".$form['date']."', '%Y-%d-%m')"),
            ]);
        return $grade;
    }

    /**
     * @param Grade $grade
     */
    public function remove(Grade $grade) : void
    {
        $grade->delete();
    }

    /**
     * @param FilterRequest|null $filter
     * @return Collection
     */
    public function search(FilterRequest $filter = null) : Collection
    {
        $query = Grade::with(['student', 'subject'])
            ->select('grade.id as grade_id', 'grade.*');

        if (isset($filter)){
            if ((
                    (isset($filter['search']) && $filter['search'])
                    || (isset($filter['date_from']) && $filter['date_from'])
                    || (isset($filter['date_to']) && $filter['date_to'])
                ) && (
                    isset($filter['search_field'])
                    && in_array($filter['search_field'], Grade::SEARCH_FIELDS)
                )){
                switch ($filter['search_field']){
                    case 'student':
                        $query
                            ->leftJoin('student', 'grade.student_id', '=', 'student.id')
                            ->orWhere('student.name', 'like', "%".$filter['search']."%")
                            ->orWhere('student.surname', 'like', "%".$filter['search']."%")
                            ->orWhere('student.patronymic', 'like', "%".$filter['search']."%");
                        break;
                    case 'subject':
                        $query
                            ->leftJoin('subject', 'grade.subject_id', '=', 'subject.id')
                            ->where('subject.name', 'like', "%".$filter['search']."%");
                        break;
                    case 'date':
                        $dates = $this->sortDates($filter['date_from'], $filter['date_to']);
                        if ($filter['date_from'] !== null)
                            $query->where('date', '>', DB::raw("STR_TO_DATE('".$dates[0]."', '%Y-%m-%d')"));
                        if ($filter['date_to'] !== null)
                            $query->where('date', '<', DB::raw("STR_TO_DATE('".$dates[1]."', '%Y-%m-%d')"));
                        break;
                    default:
                        $query->where($filter['search_field'], 'like', "%".$filter['search']."%");
                }
            }

            if (isset($filter['sort']) && in_array($filter['sort'], ['ASC', 'DESC'])
                && isset($filter['sort_field'])
                && in_array($filter['sort_field'], Grade::SEARCH_FIELDS)){
                switch ($filter['sort_field']){
                    case 'student':
                        $query
                            ->leftJoin('student', 'grade.student_id', '=', 'student.id')
                            ->orderBy('student.name', $filter['sort']);
                        break;
                    case 'subject':
                        $query
                            ->leftJoin('subject', 'grade.subject_id', '=', 'subject.id')
                            ->orderBy('subject.name', $filter['sort']);
                        break;
                    default:
                        $query->orderBy($filter['sort_field'], $filter['sort']);
                }
            }
        }

        return $query->get();
    }

    /**
     * @param string $date_from
     * @param string $date_to
     * @return array
     */
    public function sortDates( $date_from,  $date_to) : array
    {
        return [
            date('Y-d-m', strtotime($date_from && $date_to ? (strtotime($date_from) < strtotime($date_to) ? $date_from: $date_to) : ($date_from? $date_from: null))),
            date('Y-d-m', strtotime($date_from && $date_to ? (strtotime($date_from) > strtotime($date_to) ? $date_from : $date_to) : ($date_to ? $date_to: null)))
        ];
    }
}
