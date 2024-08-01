<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\LogService;
use Illuminate\Support\Facades\Log;

class ActionLogger
{
    protected $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    public function handle(Request $request, Closure $next)
    {

        $response = $next($request);


        if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('delete')) {
            $action = $request->method() . ' ' . $request->path();
            $description = json_encode($request->all());
            $ip = $request->ip(); // Get the IP address


            $this->logService->logAction($action, $description, $ip);
        }

        return $response;
    }
}
