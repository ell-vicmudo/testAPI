<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class bulsu_personnel extends Model
{
    use HasFactory;

    // protected $contactInfo = ['phone', 'local', 'email'];

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function campus()
    {
        return $this->belongsTo('App\Models\Campus');
    }
    public function executive_official()
    {
        return $this->hasMany('App\Models\Executive_Official');
    }

    public function administrative_offices()
    {
        return $this->hasOne('App\Models\Administrative_Offices');
    }
}
