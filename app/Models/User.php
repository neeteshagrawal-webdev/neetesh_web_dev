<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
class User extends Authenticatable implements \Illuminate\Contracts\Auth\CanResetPassword
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'designation',
        'zone',
        'user_group',
        'subgroup',
        'department',
        'status',
        'password_status',
        'genrate_password',
        'image',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function userGroup()
    {
        return $this->belongsTo(UserGroup::class, 'user_group', 'id');
    }

  
    public function sub_group()
    {
        return $this->belongsTo(UserSubGroup::class, 'subgroup', 'id');
    }
      
}
