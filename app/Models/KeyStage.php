<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeyStage extends Model
{
    protected $fillable =['name','class_group'];

    public function classes(){
        return $this->hasMany('App\Models\Classe','key_stage_id','id');
    }
}
