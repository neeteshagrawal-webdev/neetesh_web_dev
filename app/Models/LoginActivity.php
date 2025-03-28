<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    //

    use HasFactory;
  /*  protected $fillable = ['user_id', 'ip_address', 'user_agent', 'login_time'];

    public function user()
    {
       return $this->belongsTo(User::class, 'user_id', 'id');
    }*/
    protected $table = 'login_activities'; // Table name
    protected $fillable = [
        'user_id',
        'email',
        'ip_address',
        'user_agent',
        'event_type',
        'message',
        'status',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
