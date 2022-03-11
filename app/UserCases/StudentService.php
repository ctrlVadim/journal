<?php

namespace App\UserCases;


use App\Http\Requests\StudentRequest;
use App\Http\Requests\Search\FilterRequest;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class StudentService
{
    /**
     * @param StudentRequest $form
     */
    public function store(StudentRequest $form)
    {
        $form['birth'] = date('Y-d-m', strtotime($form['birth']));
        $form['date_of_admission'] = date('Y-d-m', strtotime($form['date_of_admission']));

        return DB::table('student')->insert([
            'name' => $form['name'],
            'surname' => $form['surname'],
            'patronymic' => $form['patronymic'],
            'gender' => $form['gender'],
            'birth' => DB::raw("STR_TO_DATE('".$form['birth']."', '%Y-%d-%m')"),
            'parents' => $form['parents'],
            'address' => $form['address'],
            'phone' => $form['phone'],
            'passport_data' => $form['passport_data'],
            'report_card' => $form['report_card'],
            'date_of_admission' => DB::raw("STR_TO_DATE('".$form['date_of_admission']."', '%Y-%d-%m')"),
            'group' => $form['group'],
            'course' => $form['course'],
            'speciality_id' => $form['speciality_id'],
            'form_of_study' => $form['form_of_study'],
        ]);
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
        $query = Student::with(['speciality']);

        if (isset($filter)){
            if ((
                    (isset($filter['search']) && $filter['search'])
                    || (isset($filter['date_from']) && $filter['date_from'])
                    || (isset($filter['date_to']) && $filter['date_to'])
                ) && (
                    isset($filter['search_field'])
                    && in_array($filter['search_field'], Student::SEARCH_FIELDS)
                )){
                switch ($filter['search_field']){
                    case 'name':
                        $query
                            ->leftJoin('grade', 'grade.student_id', '=', 'student.id')
                            ->orWhere('student.name', 'like', "%".$filter['search']."%")
                            ->orWhere('student.surname', 'like', "%".$filter['search']."%")
                            ->orWhere('student.patronymic', 'like', "%".$filter['search']."%");
                        break;
                    case 'date_of_admission':
                    case 'birth':
                        $dates = $this->sortDates($filter['date_from'], $filter['date_to']);
                        if ($filter['date_from'] !== null)
                            $query->where($filter['search_field'], '>', DB::raw("STR_TO_DATE('".$dates[0]."', '%Y-%m-%d')"));
                        if ($filter['date_to'] !== null)
                            $query->where($filter['search_field'], '<', DB::raw("STR_TO_DATE('".$dates[1]."', '%Y-%m-%d')"));
                        break;
                    default:
                        $query->where($filter['search_field'], 'like', "%".$filter['search']."%");
                }
            }

            if (isset($filter['sort']) && in_array($filter['sort'], ['ASC', 'DESC'])
                && isset($filter['sort_field'])
                && in_array($filter['sort_field'], Student::SEARCH_FIELDS)){
                    $query->orderBy($filter['sort_field'], $filter['sort']);
            }
        }
        return $query->get();
    }

    public function sortDates( $date_from, $date_to) : array
    {
        return [
            date('Y-d-m', strtotime($date_from && $date_to ? (strtotime($date_from) < strtotime($date_to) ? $date_from: $date_to) : ($date_from? $date_from: null))),
            date('Y-d-m', strtotime($date_from && $date_to ? (strtotime($date_from) > strtotime($date_to) ? $date_from : $date_to) : ($date_to ? $date_to: null)))
        ];
    }
}
