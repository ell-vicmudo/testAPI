<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulsu_goal extends Model
{
    use HasFactory;

    public function subgoals()
    {
        return $this ->hasMany('App\Models\bulsu_subGoal');
    }
}
