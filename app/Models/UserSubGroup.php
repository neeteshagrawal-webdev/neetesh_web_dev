<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubGroup extends Model
{
    //
    protected $table = 'user_sub_groups'; 
    protected $fillable = ['group_id','name'];
}
