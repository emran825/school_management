<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'subject_name','subject_details', 'status'
    ];

    public function KeyStages(){
        return $this->belongsTo(KeyStage::class,'key_stage_id','id');
    }

    public function classes()
    {
        return $this->belongsToMany('App\Models\Classe', 'class_subjects', 'subject_id', 'class_id')->withPivot('id');
    }

    public function topics(){
        return $this->hasMany(Topic::class);
    }
}
