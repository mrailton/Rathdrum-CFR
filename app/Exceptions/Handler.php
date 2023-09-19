<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [

    ];

    protected $dontReport = [

    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e): void {
        });
    }

    public function report(Throwable $e): void
    {
        if (app()->bound('honeybadger') && $this->shouldReport($e)) {
            app('honeybadger')->notify($e, app('request'));
        }

        parent::report($e);
    }
}
