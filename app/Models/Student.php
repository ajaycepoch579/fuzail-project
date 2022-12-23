<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'class', 'roll_number'];
    public function images()
    {
        return $this->hasMany(StudentImage::class, 'stu_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
