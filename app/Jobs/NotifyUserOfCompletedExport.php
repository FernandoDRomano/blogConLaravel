<?php

namespace App\Jobs;

use App\Notifications\NotifyUserOfCompletedExportFile;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyUserOfCompletedExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $filePath;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $filePath)
    {
        $this->user = $user;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $this->user->notify(new NotifyUserOfCompletedExportFile($this->filePath));
    }
}
