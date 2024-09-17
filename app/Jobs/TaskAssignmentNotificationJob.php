<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\TaskAssigned;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TaskAssignmentNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $task;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, $task)
    {
        $this->user = $user;
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Send email to the user
        Mail::to($this->user->email)->send(new TaskAssigned($this->user, $this->task));
    }
}
