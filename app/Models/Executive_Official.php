<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Executive_Official extends Model
{
    use HasFactory;

    public function bulsu_personnel(){
        return $this->belongsTo('App\Models\bulsu_personnel');
    }
}
