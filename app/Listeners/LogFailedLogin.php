<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use App\Models\LoginActivity;
use Illuminate\Support\Facades\Request;

class LogFailedLogin
{
    public function handle(Failed $event): void
    {
         LoginActivity::create([
            'user_id' => null,
            'email' => $event->credentials['email'] ?? 'unknown',
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
            'event_type' => 'failed_login',
            'status' => false,
        ]);
    }
}
