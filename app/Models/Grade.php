<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'grade';

    protected $fillable = [
        'student_id',
        'subject_id',
        'date',
        'grade',
    ];

    const SEARCH_FIELDS = [
        'student',
        'subject',
        'date',
        'grade'
    ];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
