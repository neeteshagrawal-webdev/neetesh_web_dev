<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vlog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image','pdf','video','like','status','dislike', 'user_id','share_user_ids'];


    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function comments()
{
    return $this->hasMany(Comment::class);
}


}


