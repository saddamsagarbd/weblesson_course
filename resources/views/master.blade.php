<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
  	<div class="container">
  		@yield('content')
  	</div>
    <!-- @yield('custome_js') -->
    <script type="text/javascript">
      $(document).ready(function(){
        $("#student_table").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('ajaxdata.getdata') }}",
            "columns":[
              {'data': 'first_name'},
              {'data': 'last_name'}
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
                $('#action').val('Save');
                $('.model-title').text('Add Data');
                $('#btn_action').val('insert');
                $('#studentModal').modal('hide');
                $('#student_table').DataTable().ajax.reload();
              }

            }
          });
        });
      });
      
    </script>
  </body>
</html>