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
		<th>Action</th>
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
					<input type="hidden" name="student_id" id="student_id" value="">
					<input type="hidden" name="btn_action" id="btn_action" value="insert">
					<button type="submit" name="submit" id="action" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Save</button>
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">cancel</button>
				</div>				
			</form>
		</div>
	</div>
</div>
@endsection
@section('custome_js')
<script type="text/javascript">
    $(document).ready(function(){
        $("#student_table").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('ajaxdata.getdata') }}",
            "columns":[
              {'data': 'first_name'},
              {'data': 'last_name'},
              {'data' : 'action', orderable: false, searchable: false}
            ]
        });
        $('#add_data').click(function(){
          $('#studentModal').modal('show');
          $('#student_form')[0].reset();
          $('#form_output').html('');
          $('#btn_action').val('insert');
          $('#action').val('Save');
        });

        $('#student_form').on('submit', function(event){
          event.preventDefault();
          var form_data = $(this).serialize();
          $.ajax({
            url:"{{ route('ajaxdata.postdata') }}",
            method: "POST",
            data: form_data,
            dataType: "JSON",
            success:function(data){
              if(data.error.length > 0){
                var error_html = '';
                for (var i = 0; i<data.error.length; i++) {
                  error_html += "<div class='alert alert-danger'>"+data.error[i]+"<button type='button' class='close' data-dismiss='alert'>&times;</button></div>"
                }
                $("#form_output").html(error_html);
              }else{
                $('#form_output').html(data).success;
                $('#student_form')[0].reset();
                $('#action').text('Save');
                $('.model-title').text('Student Information');
                $('#btn_action').val('insert');
                $('#studentModal').modal('hide');
                $('#student_table').DataTable().ajax.reload();
              }

            }
          });
        });
        
      });
    $(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		$.ajax({
			url: "{{ route('ajaxdata.fetchdata') }}",
			method: "GET",
			data: {id:id},
			dataType: "JSON",
			success: function(data){
				$('#first_name').val(data.first_name);
				$('#last_name').val(data.last_name);
				$('#student_id').val(id);
				$('#studentModal').modal('show');
				$('.modal-title').text('Update Student Information');
				$('#action').text('Update');
				$('#btn_action').val('update');
			}
		})
    });
    $(document).on('click', '.delete', function () {
    var id = $(this).attr('id');
    if(confirm("Are you sure to delete data?")){
    	$.ajax({
    		url: "{{ route('ajaxdata.destroy') }}",
    		method:"GET",
    		data:{id:id},
    		success:function(data){
    			alert(data);
    			$('#student_table').DataTable().ajax.reload();
    		}
    	})

    }else{
    	return false;
    }
});
  </script>
@endsection