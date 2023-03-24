<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulsu_subGoal extends Model
{
    use HasFactory;

    public function goal()
    {
        return $this->belongsTo('App\Models\bulsu_goal');
    }
}
