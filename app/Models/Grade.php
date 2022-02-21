<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = [
        'student_id',
        'subject_id',
        'date',
        'grade',
    ];

    public function subject(){
        return $this->hasMany(Subject::class);
    }

    public function student(){
        return $this->hasMany(Subject::class);
    }
}
