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
		$students = Student::select('id', 'first_name', 'last_name');
		return DataTables::of($students)
				->addColumn('action', function($student){
					return '<a href="#" class="btn btn-primary btn-xs edit" id="'.$student->id.'"><i class="fa fa-edit"></i>&nbsp;Edit</a>
						&nbsp;<a href="#" class="btn btn-danger btn-xs delete" id="'.$student->id.'"><i class="fa fa-edit"></i>&nbsp;Delete</a>';
				})
				->make(true);
	}

	/*
	insertion block
	*/
	public function postdata(Request $res)
	{
		$validation = Validator::make($res->all(), [
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
			if($res->get('btn_action') == "insert"){
				$student = new Student([
				'first_name' 	=> $res->get('first_name'),
				'last_name' 	=> $res->get('last_name'),
				'created_at'    => date('Y-m-d H:i:s')
			]);
			$student->save();
			$success_output = "<div class='alert alert-success'>Data inserted.</div>";
			}
			if($res->get('btn_action') == "update"){
				$student = Student::find($res->get('student_id'));
				$student->first_name = $res->get('first_name');
				$student->last_name = $res->get('last_name');
				$student->updated_at = date('Y-m-d H:i:s');
				$student->save();
				$success_output = "<div class='alert alert-success'>Data updated.</div>";
			}
		}
		$output = [
			'error' => $error_array,
			'success' => $success_output
		];
		echo json_encode($output);
	}

	/*
	fetch data block for data edit
	*/
	public function fetchdata(Request $res)
	{
		$id = $res->input('id');
		$student = Student::find($id);
		$output = array(
			'first_name' => $student->first_name,
			'last_name' => $student->last_name
		);
		// json_encode convert array to string
		echo json_encode($output);
	}

	/*
	destroy data
	*/
	public function destroy(Request $res)
	{
		$student = Student::find($res->input('id'));
		if($student->delete()){
			echo "Data Deleted.";
		}
	}
}
