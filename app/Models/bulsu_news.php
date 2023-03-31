<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulsu_news extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'publisher',
        'publish_date',
        'heading',
        'body',
        'thumbnail',
    ];
}
