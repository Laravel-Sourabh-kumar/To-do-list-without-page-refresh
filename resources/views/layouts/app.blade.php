<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple To Do List </title>
    @toaster
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        @yield('content')
    </div>

    @include('partials.footer')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
@csrf
</form>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
       <script src="{{ asset('js/bootstrap.min.js') }}"></script>
       <script src="{{ asset('js/script.js') }}"></script>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
       
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script>
    $(function () {
       
          var table = $('#mytable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "/todo",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'status', name: 'status'},
                  {data: 'action', name: 'action'},
              ]
          });
        });
</script>
<script>
         function getMessage() {
            var form = document.getElementById('myForm'); 
             var formData = $('form').serialize();
           
            $.ajax({
               type:'Get',
               url:'/todo-create',
               data:formData, 
                 success:function(data) {
                    $('#mytable').DataTable().ajax.reload();
                    alert(data.msg);
               }
            });
         }
      </script>

<script>
         function updatemessage(id) {
             
            $.ajax({
               type:'Get',
               url:'/todo-update/'+id,
               
                 success:function(data) {
                    $('#mytable').DataTable().ajax.reload();
                    alert(data.msg);
               }
            });
         }
      </script>
<script>
         function deletemessage(id) {
            var confirmDelete = confirm("Are u sure to delete this task ?");
    if (confirmDelete) {
       
     
            $.ajax({
               type:'Get',
               url:'/todo-delete/'+id,
               
                 success:function(data) {
                    $('#mytable').DataTable().ajax.reload();
                    alert(data.msg);
               }
            });
         }
        }
      </script>
</body>
</html>