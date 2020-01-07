@extends('master')
@section('title')
	Create Student
@endsection
@section('content')
	<div class="row">
		<div class="col-md-12">
			<br>
			<h3>Add Student</h3>
			<br>
			<a href="route('student.index')" class="btn btn-sm btn-primary"><i class="fa fa-list"></i>&nbsp;Student List</a><br><br>
			@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
		@if(\Session::has('success'))
		<div class="alert alert-success">
			<p>{{ \Session::get('success') }}</p>
		</div>
		@endif
		<form method="post" action="{{url('student')}}">
			{{ csrf_field() }}
			<div class="form-group">
				<input type="text" name="first_name" class="form-control" placeholder="Enter First Name">
			</div>
			<div class="form-group">
				<input type="text" name="last_name" class="form-control" placeholder="Enter Last Name">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-sm btn-primary">
			</div>
		</form>
		</div>
	</div>
@endsection