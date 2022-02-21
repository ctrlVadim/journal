<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'subject';

    protected $fillable = [
        'name',
        'description'
    ];

    public function subject(){
        return $this->hasMany(Subject::class);
    }
}
