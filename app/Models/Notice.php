<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'title','notice_category_id','details','notice_date','attachment','expire_date','status','created_by','updated_by',
    ];
    // public function notice_category(){
    //     return $this->belongsTo(NoticeCategory::class,'notice_category_id');
    // }
    public function notice_category()
    {
        return $this->belongsTo('App\Models\NoticeCategory');
    }

}
