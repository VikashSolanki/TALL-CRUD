<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Student;

class Subject extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name'
    ];

    /**
     * The students that belong to the employees.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    /**
     * Get the subject data
     */
    public static function getSubjectList()
    {
        return self::pluck('name', 'id');
    }

    /**
     * Save the subjects
     */
    public static function saveSubject($model, $data)
    {
        $model->subjects()->sync($data);
    }
}
