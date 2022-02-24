<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false;

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

    const SEARCH_FIELDS = [
        'name',
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
        'speciality',
        'form_of_study'
    ];

    public function speciality(){
        return $this->hasOne(Speciality::class);
    }

    public function grade(){
        return $this->hasMany(Grade::class);
    }
}
