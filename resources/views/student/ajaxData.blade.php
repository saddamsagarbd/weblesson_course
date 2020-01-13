@extends('master')
@section('title')
Student List
@endsection

@section('content')
<br>
<h3 align="center">Datatables server side processing Laravel</h3>
<br>
<table id="student_table" class="table table-bordered" style="width:100%">
<thead>
	<tr>
		<th>First name</th>
		<th>Last name</th>
	</tr>
</thead>
</table>
@endsection