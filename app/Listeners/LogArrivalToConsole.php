<?php

namespace App\Listeners;

use App\Events\StudentArrived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class LogArrivalToConsole
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\StudentArrived  $event
     * @return void
     */
    public function handle(StudentArrived $event)
    {
        info(now()->toTimeString('second') . ': welcome ' . $event->student_name);
    }
}
