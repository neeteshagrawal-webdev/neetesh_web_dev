<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogSharedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $blog;
    public $user;

    public function __construct($blog, $user)
    {
        $this->blog = $blog;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('New Blog Shared with You')
                    ->view('emails.blog_shared')
                    ->with([
                        'blogTitle' => $this->blog->title,
                        'blogDescription' => $this->blog->description,
                        'userName' => $this->user->name,
                    ]);
    }
}
