<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['quiz_id', 'question_detail', 'mark', 'type', 'image', 'audio', 'serial', 'attachment', 'status'];

    public function options(){
        return $this->hasMany(Option::class);
    }
}
