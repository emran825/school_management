<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    protected $fillable =['class_subject_id','student_id'];

    public function subjects(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
    public function classes(){
        return $this->belongsTo(Classe::class,'class_id','id');
    }
    public function student_classes(){
        return $this->belongsTo(StudentClass::class,'id','student_id');
    }



}
