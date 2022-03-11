<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'student_id' => 'required',
            'subject_id' => 'required',
            'date' => 'required',
            'grade' => 'required',
        ];
    }
}
