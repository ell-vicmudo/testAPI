<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulsu_bac_type extends Model
{
    use HasFactory;

    protected $fillable = ['type_title'];

    public function bac(){
        return $this->hasMany('App/Models/bulsu_bac_type');
    }
}
