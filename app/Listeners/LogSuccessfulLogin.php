<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\LoginActivity;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogin
{
    public function handle(Login $event): void
    {
        LoginActivity::create([
            'user_id' => $event->user->id,
            'email' => $event->user->email,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
            'event_type' => 'login',
            'status' => 'success',
            'message' => 'Login Success',
        ]);
    }
}
