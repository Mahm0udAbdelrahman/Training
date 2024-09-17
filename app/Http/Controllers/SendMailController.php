<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\TaskAssignmentNotificationJob;

class SendMailController extends Controller
{
    public function assignTask(\App\Models\User $user, $task)
    {

        TaskAssignmentNotificationJob::dispatch($user, $task);
    }
}
