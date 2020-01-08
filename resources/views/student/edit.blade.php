@extends('master')

@section('title')
Edit Student Record
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<br>
		<h3 align="center">Edit Student Info</h3>
		<br>
		@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<form method="post" action="{{ action('StudentController@update', $id) }}">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="PATCH">
			<div class="form-group">
				<input type="text" class="form-control" name="first_name" value="{{$student->first_name}}" placeholder="Enter first name">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="last_name" value="{{$student->last_name}}" placeholder="Enter last name">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Update</button>
			</div>
			
		</form>
	</div>
</div>
@endsection