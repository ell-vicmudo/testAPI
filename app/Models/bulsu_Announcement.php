<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulsu_Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'publisher',
        'date',
        'body',
        'image',
        'attachment'
    ];
}
