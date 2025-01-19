<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Notifications\AccountCreationNotification;

class ProcessImportJob implements ShouldQueue
{
    use Queueable;

    public $user;

    public $password;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new AccountCreationNotification($this->user, $this->password));
        sleep(20);
    }
}
