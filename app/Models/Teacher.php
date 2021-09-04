<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'school_id','teacher_id', 'address', 'email', 'contact_no', 'first_name', 'middle_name', 'last_name', 'dob', 'nationality', 'gender', 'last_qualification', 'speciality', 'job_type','salary', 'remarks', 'status'
    ];

    public function users(){
        return $this->hasMany(User::class,'typable_id');
    }

    public function teacher_subjects(){
        return $this->belongsToMany('App\Models\ClassSubject','teacher_subjects','teacher_id', 'class_subject_id')->withPivot('class_subject_id');
    }
}
