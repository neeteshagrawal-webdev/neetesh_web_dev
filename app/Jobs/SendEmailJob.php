<?php

namespace App\Jobs;

use App\Mail\NotifyUsers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $details;

    public function __construct($user, $details)
    {
        $this->user = $user;
        $this->details = $details;
    }

    public function handle()
    {
        Mail::to($this->user->email)->send(new NotifyUsers($this->details));
    }
}