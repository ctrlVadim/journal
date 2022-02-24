<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'speciality';

    protected $fillable = [
        'name',
        'description'
    ];

    const SEARCH_FIELDS = [
        'name',
        'description'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
