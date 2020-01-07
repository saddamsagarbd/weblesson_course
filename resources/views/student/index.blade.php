@extends('master')
@section('title')
Student List
@endsection
@section('content')
	<div class="row">
		<div class="col-md-12">
			<br>
			<h3 align="center">List of Students</h3>
			<br>
			@if($message = Session::get('success'))
			<div class="alert alert-success">
				<p>{{ $message }}</p>
			</div>
			@endif
			<a href="{{route('student.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Add Student</a>
			<br>
			<br>
			<table class="table table-border">
				<thead>
					<tr>
						<th>SL</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; ?>
					@foreach($students as $row)
					<tr>
						<td>{{ $i += 1 }}</td>
						<td>{{$row['first_name']}}</td>
						<td>{{$row['last_name']}}</td>
						<td>
							<a href="{{ action('StudentController@edit',$row['id']) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
							
						</td>
						
					</tr>
					@endforeach
				</tbody>
				
			</table>
		</div>
	</div>
@endsection