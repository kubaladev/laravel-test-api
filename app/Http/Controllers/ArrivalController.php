<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Arrival;
use App\Events\StudentArrived;

use function PHPUnit\Framework\isEmpty;

class ArrivalController extends Controller
{
    function get_current_time()
    {
        $time_string = now()->toTimeString('second');
        return $time_string;
    }

    public function register_student($student_id)
    {
        $arrival = Arrival::create([
            'arrival_time' => $this->get_current_time(),
            'student_id' => $student_id
        ]);
        //trigger event
        $student = Student::where('id', $student_id)->first();
        event(new StudentArrived($student->name));
        return $arrival;
    }
    public function is_late($id)
    {
        $arrival = Arrival::where('id', $id);
        if (isEmpty($arrival)) return -1;
        $current_time = strtotime($arrival->arrival_time);
        $end_time = strtotime('8:00:00');
        return  $current_time > $end_time ? 1 : 0;
    }
    /**
     * Find students that are late
     *
     * @return \Illuminate\Http\Response
     */
    public function show_late_arrivals($student_id)
    {
        $arrivals = Arrival::where('student_id', $student_id)->where('arrival_time', '>', '07:59:59')->get();
        return $arrivals;
    }
    public function show_all_arrivals($student_id)
    {
        return Arrival::where('student_id', $student_id)->get();
    }
}
