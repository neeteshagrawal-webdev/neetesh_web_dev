<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class uploadmaster extends Model
{
    //
    use HasFactory;

    protected $fillable = ['category','subcategory','priority','letter_date','letter_number','subject_of_letter', 'sub_group_id','user_group_id','upload_file'];
}
