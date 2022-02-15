<?php

namespace App\Jobs;

use App\Donation;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Throwable;

class SyncDonations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $donation;
    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @param  Donation  $donation
     * @return void
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug('Processed a donation', ['donation' => $this->donation]);
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        Log::error('Could not process a donation', ['donation' => $this->donation]);
    }
}
