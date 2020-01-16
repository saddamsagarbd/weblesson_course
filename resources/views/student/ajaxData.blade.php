@extends('master')
@section('title')
Student List
@endsection

@section('content')
<br>
<h3 align="center">Datatables server side processing Laravel</h3>
<br>
<div align="right">
	<button type="button" name="add" id="add_data" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>&nbsp;Add</button>	
</div>
<br>
<span id="form_output"></span>
<br>
<table id="student_table" class="table table-bordered" style="width:100%">
<thead>
	<tr>
		<th>First name</th>
		<th>Last name</th>
	</tr>
</thead>
</table>
<div id="studentModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="student_form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Student</h4>
				</div>
				<div class="modal-body">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="first_name">Enter First Name</label>
						<input type="text" name="first_name" id="first_name" class="form-control">
					</div>
					<div class="form-group">
						<label for="last_name">Enter Last Name</label>
						<input type="text" name="last_name" id="last_name" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="btn_action" id="btn_action" value="insert">
					<button type="submit" name="submit" id="action" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Save</button>
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">cancel</button>
				</div>				
			</form>
		</div>
	</div>
	
</div>
@endsection