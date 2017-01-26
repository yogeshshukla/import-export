<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Students;
use App\Course;
use Excel;

class ExportController extends Controller
{
    public function __construct()
    {

    }

    public function welcome()
    {
        return view('hello');
    }

    /**
     * View all students found in the database
     */
    public function viewStudents()
    {
        $students = Students::with('course')->get();//Students::with('course')->get();
        return view('view_students', compact(['students']));
    }

    /**
     * Exports all student data to a CSV file
     */
    public function exportStudentsToCSV(Request $request)
    {
    	if(isset($request['studentId']) and !empty($request['studentId'])){
			$data = Students::with('course')->get()->whereIn('id', $request['studentId']);	
		}else{
			$data = Students::with('course')->get();	
		}
		$count = $data->count();
		Excel::create('students_'.$count, function($excel) use($data) {

		    $excel->sheet('Sheetname', function($sheet) use($data) {

		        $sheet->fromArray($data);

		    });

		})->export('xls');
    }

    /**
     * Exports the total amount of students that are taking each course to a CSV file
     */
    public function exporttCourseAttendenceToCSV()
    {

    }
}
