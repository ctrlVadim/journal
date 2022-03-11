<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'gender' => 'required',
            'birth' => 'required',
            'parents' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'passport_data' => 'required',
            'report_card' => 'required',
            'date_of_admission' => 'required',
            'group' => 'required',
            'course' => 'required',
            'speciality_id' => 'required',
            'form_of_study' => 'required',
        ];
    }
}
