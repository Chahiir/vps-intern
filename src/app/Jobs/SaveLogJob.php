<?php

namespace App\Jobs;

use App\Models\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveLogJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $logData;
    /**
     * Create a new job instance.
     */
    public function __construct(array $logData)
    {
      $this->logData = $logData;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

      Log::create($this->logData);

    }
}
