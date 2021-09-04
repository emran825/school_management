<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    protected $fillable =['class_id','subject_id','status'];

    public function subjects(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
    public function classes(){
        return $this->belongsTo(Classe::class,'class_id','id');
    }



}
