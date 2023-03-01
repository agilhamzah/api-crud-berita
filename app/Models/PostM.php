<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostM extends Model
{
    use HasFactory;
    
    protected $table = 'posts';
    protected $filltable = [
        'image',
        'title',
        'content',
    ];
}
