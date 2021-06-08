<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'first_name','last_name','email','phone','dob'
    ];

    /**
     * Get the student full name
     */
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . $this->last_name;
    }

    /**
    * The students that belong to the subjects.
    */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withTimestamps();
    }
}
