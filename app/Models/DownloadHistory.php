<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadHistory extends Model
{
    use HasFactory;

    protected $table = 'downloadhistory'; // Table name

    protected $fillable = ['upload_id','user_id', 'seen_status', 'date_for_action', 'remarks', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}


?>
