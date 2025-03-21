<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'media', 'media_type','type'];
   // protected $fillable = ['title', 'content', 'video', 'image'];
}