<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    public function bulsu_personnel()
    {
       return $this->hasMany('App\Models\bulsu_personnel');
    }

    protected $fillable = [
        'campus_name',
        'campus_overview',
        'campus_contact_number'
    ];
}
