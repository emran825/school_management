<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable =['name','details','key_stage_id'];

    public function KeyStages(){
        return $this->belongsTo(KeyStage::class,'key_stage_id','id');
    }
    public function subjects(){
        return $this->belongsToMany(Subject::class,'class_subjects','class_id','subject_id');
    }
    public function student_classes(){
        return $this->belongsTo(StudentClass::class,'id','class_id');
    }



}
