<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'topic_name','topic_details','subject_id', 'status'
    ];
    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
}
