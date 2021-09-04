<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeCategory extends Model
{
    protected $fillable = [
        'category_name','status','details',
    ];

    // public function notice(){
    //     return $this->hasMany(Notice::class);
    // }
    public function notice()
    {
        return $this->hasMany(Notice::class, 'notice_category_id', 'id');
    }

}
