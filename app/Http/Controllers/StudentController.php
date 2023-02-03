<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

use function PHPUnit\Framework\isEmpty;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Student::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Student::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Student::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $student->update($request->all());
        return $student;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Student::destroy($id);
    }
    /**
     * Search for the specified resource from storage.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Student::where('name', 'like', '%' . $name . '%')->get();
    }
    /**
     *  Find if student is late
     *
     * @param  str  $name
     * @return str student status 1 - late, 0 - not late, -1 not found
     */
    public function is_late($name)
    {
        $student = Student::where('name', 'like', $name)->get();
        if (count($student) <= 0) return -1;
        //if there are multiple students with same name, we take the first one
        $current_time = strtotime($student->first()->arrival);
        $end_time = strtotime('8:00:00');
        return  $current_time > $end_time ? 1 : 0;
    }
    /**
     * Find students that are late
     *
     * @return \Illuminate\Http\Response
     */
    public function show_late()
    {
        return Student::where('arrival', '>', '08:00:00')->get();
    }
}