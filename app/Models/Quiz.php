<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['year_id', 'class_id', 'subject_id', 'topic_id', 'title', 'instruction', 'attachment', 'remote_media_file_link', 'total_question', 'status'];

    public function subjects(){
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
    public function classes(){
        return $this->belongsTo(Classe::class,'class_id','id');
    }
    public function topices(){
        return $this->belongsTo(Topic::class,'topic_id','id');
    }
}

