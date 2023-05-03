<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulsu_bac extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'title',
        'type_id',
        'body',
        'file'
    ];

    public function bac_type() {
        return $this->belongsTo('App/Models/bulsu_bac_type');
    }
}
