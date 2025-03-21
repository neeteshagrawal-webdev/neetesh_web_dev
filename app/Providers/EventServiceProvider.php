<?php
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Logout;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogFailedLogin;
use App\Listeners\LogSuccessfulLogout;

protected $listen = [
    Login::class => [
        LogSuccessfulLogin::class,
    ],
    Failed::class => [
        LogFailedLogin::class,
    ],
    Logout::class => [
        LogSuccessfulLogout::class,
    ],
];