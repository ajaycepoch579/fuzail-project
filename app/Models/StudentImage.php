<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentImage extends Model
{
    use HasFactory;
    protected $fillable = ['stu_id', 'image'];
    public function student()
    {
        return $this->belongsTo(Student::class, 'id');
    }
}
