<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'vlog_id',
        'user_id',
        'comment',
    ];

    public function vlog()
    {
        return $this->belongsTo(Vlog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
