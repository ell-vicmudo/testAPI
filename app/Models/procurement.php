<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class procurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'publisher',
        'title',
        'body',
        'document'
    ];
}
