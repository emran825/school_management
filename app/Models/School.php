<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name', 'address', 'email', 'contact_no', 'principle_name', 'principle_contact_no', 'reference_person', 'reference_contact_no', 'registration_date', 'valid_till', 'remarks'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

}
