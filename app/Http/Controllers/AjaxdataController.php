<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use DataTables;

class AjaxdataController extends Controller
{
	public function index()
	{
		return view('student.ajaxData');

	}
	public function getdata()
	{
		$students = Student::select('first_name', 'last_name');
		return DataTables::of($students)->make(true);
	}
}
