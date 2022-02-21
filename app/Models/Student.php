<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'gender',
        'birth',
        'parents',
        'address',
        'phone',
        'passport_data',
        'report_card',
        'date_of_admission',
        'group',
        'course',
        'speciality_id',
        'form_of_study'
    ];

    public function speciality(){
        return $this->hasMany(Speciality::class);
    }
}
