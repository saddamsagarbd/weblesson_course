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
  </head>
  <body>
  	<div class="container">
  		@yield('content')
  	</div>
    <!-- @yield('custome_js') -->
    <script type="text/javascript">
      $("#student_table").DataTable({
          "processing": true,
          "serverSide": true,
          "ajax": "{{ route('ajaxdata.getdata') }}",
          "columns":[
            {'data': 'first_name'},
            {'data': 'last_name'}
          ]
      });
    </script>
  </body>
</html>