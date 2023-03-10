
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">

</head>
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg"><b>Forgot Password</b></p>

      <form id="login_data" method="post">
          @csrf
        <div class="input-group mb-3 needs-validation">
          <input type="email" class="form-control" placeholder="Email" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        
    </form>  
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" onCLick="submit()" class="btn btn-primary btn-block">Send</button>
          </div>
          <!-- /.col -->
        </div>
     
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>

<script>
    function submit(){
        var validateGroup = $(".needs-validation");
        var formData = new FormData($('#login_data')[0]);
        
        if($('#login_data')[0].checkValidity() === true){
            Swal.fire({
                title: 'Loading...',
                html: 'Please wait for a moment...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            })
            
            $.ajax({
                url:"{{url('login')}}",
                type:'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done((response) => {
                if(response.status == 'success'){
                    window.location.replace("{{url('/')}}")
                } else {
                    Swal.fire(
                        'Error!',
                        response.message,
                        response.status
                    )
                }
            });
        } else {
            Swal.fire(
                'Error!',
                'Please fill all the required fields!',
                'error'
            )
            for (var i = 0; i < validateGroup.length; i++){
                validateGroup[i].classList.add('was-validated')
            }
        }
    }
</script>
</body>
</html>


