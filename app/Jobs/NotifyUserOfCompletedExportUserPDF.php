<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\NotifyUserOfCompletedExportFile;

class NotifyUserOfCompletedExportUserPDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $ownerReport;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 600;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, User $ownerReport)
    {
        $this->user = $user;
        $this->ownerReport = $ownerReport;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pdf = PDF::loadView('admin.exports.pdf.user', ['user' => $this->user->load(['roles', 'permissions', 'posts', 'comments', 'socialProfiles'])])->setPaper('a4', 'landscape');
        $filePath = 'reports/';
        $fileName = $filePath . $this->user->getFullName() . '-' . now(). '.pdf';

        Storage::put($fileName, $pdf->download());
        $url = Storage::url($fileName);

        //NOTIFICAR AL USUARIO
        $this->ownerReport->notify(new NotifyUserOfCompletedExportFile($url));
    }
}
