<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrative_Offices extends Model
{
    use HasFactory;

    public function bulsu_personnel(){
        return $this->belongsTo('App\Models\bulsu_personnel');
    }

    protected $fillable = [ "bulsu_personnel_id", "admin_offices" ];
}
