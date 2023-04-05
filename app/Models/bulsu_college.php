<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulsu_college extends Model
{
    use HasFactory;

    public function courses() {
        return $this->hasMany('App/Models/bulsu_course');
    }

    protected $fillable = [
        "college_abbv",
        "college_name"
    ];
}
