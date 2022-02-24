<?php


namespace App\Http\Requests\Search;


use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'sort' => 'string|max:4|min:3',
        ];
    }
}
