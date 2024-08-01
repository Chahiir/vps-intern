<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Jobs\SaveLogJob;
use Illuminate\Support\Facades\Log;

class LogService
{
    public function logAction($action, $description = null, $ip = null)
    {
        $logData = [
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
            'ip' => $ip,
            'created_at' => now(),
        ];

        Log::info('LogService: dispatching SaveLogJob', $logData);

        dispatch(new SaveLogJob($logData));
    }
}
