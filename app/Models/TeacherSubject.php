<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    protected $primaryKey = 'id';
    protected $fillable =['class_subject_id','teacher_id'];

    public function subjects(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
    public function classes(){
        return $this->belongsTo(Classe::class,'class_id','id');
    }
    public function KeyStages(){
        return $this->belongsTo(KeyStage::class,'key_stage_id','id');
    }
    public function teacher(){
        return $this->hasMany(Teacher::class);
    }

}
