<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulsu_course extends Model
{
    use HasFactory;

    public function college() {
        return $this->belongsTo('App/Models/bulsu_college');
    }

    protected $fillable = [
        'course_title',
        'college_id'
    ];
}
