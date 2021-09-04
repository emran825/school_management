<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'school_id','class_id','student_no', 'address', 'email', 'contact_no', 'first_name', 'middle_name', 'last_name', 'dob', 'gender', 'parent_name', 'parent_contact_no', 'parent_email', 'remarks', 'status'
    ];

    public function users(){
        return $this->hasMany(User::class,'typable_id');
    }
    public function student_classes(){
        return $this->belongsTo(StudentClass::class,'id','student_id');
    }
    public function classes(){
        return $this->belongsToMany(Classe::class,'student_classes','student_id','class_id')->withPivot('status');
    }
    public function student_subjects(){
        return $this->belongsToMany('App\Models\ClassSubject','student_subjects','student_id', 'class_subject_id')->withPivot('class_subject_id');
    }

}
