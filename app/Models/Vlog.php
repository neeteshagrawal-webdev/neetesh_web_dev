<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vlog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'like', 'dislike', 'user_id'];


    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function comments()
{
    return $this->hasMany(Comment::class);
}


}


