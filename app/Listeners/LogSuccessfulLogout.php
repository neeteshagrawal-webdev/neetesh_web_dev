<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\LoginActivity;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogout
{
    public function handle(Logout $event): void
    {
        LoginActivity::create([
            'user_id' => $event->user->id,
            'email' => $event->user->email,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
            'event_type' => 'logout',
            'status' => 'success',
            'message' => 'User Logged Out',
        ]);
    }
}