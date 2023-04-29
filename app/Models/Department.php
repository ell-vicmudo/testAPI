<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function bulsu_personnel()
    {
       return $this->hasMany('App\Models\bulsu_personnel');
    }

    protected $fillable = [
        'office_code',
        'office_name',
        'contact_number'
    ];
}
