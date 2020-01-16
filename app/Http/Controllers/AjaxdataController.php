<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Student;
use DataTables;

class AjaxdataController extends Controller
{
	public function index()
	{
		return view('student.ajaxData');

	}

	/*
	data retrive block
	*/
	public function getdata()
	{
		$students = Student::select('first_name', 'last_name');
		return DataTables::of($students)->make(true);
	}

	/*
	insertion block
	*/
	public function postdata(Request $r)
	{
		$validation = Validator::make($r->all(), [
			'first_name' => 'required',
			'last_name' => 'required'
		]);

		$error_array = array();
		$success_output = '';

		if($validation->fails()){
			foreach ($validation->messages()->getMessages() as $field_name => $messages) {
				$error_array[] = $messages;
			}
		}else{
			$student = new Student([
				'first_name' 	=> $r->get('first_name'),
				'last_name' 	=> $r->get('last_name'),
				'created_at'    => date('Y-m-d H:i:s')
			]);
			$student->save();
			$success_output = "<div class='alert alert-success'>Data inserted.</div>";
		}
		$output = [
			'error' => $error_array,
			'success' => $success_output
		];
		echo json_encode($output);
	}
}
