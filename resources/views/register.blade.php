
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg" font-size="20px"><b>Register New Account</b></p>
            <form id="register_data">
                @csrf
                <div class="input-group mb-3 needs-validation">
                    <input type="text" class="form-control" placeholder="Full name" name="name" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>    
                </div>
                <div class="input-group mb-3 needs-validation">
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3 needs-validation">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3 needs-validation">
                    <input type="password" class="form-control" placeholder="Retype password" name="password_confirm" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">I agree to the <a href="#">terms</a></label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="button" onclick="submit()" class="btn btn-primary btn-block">Register</button>
                </div>
            </div>
            <a href="login.html" class="text-center">I already have a membership</a>
        </div>
    </div>
</div>

<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
<script>
    function submit(){
        var validateGroup = $(".needs-validation");
        var formData = new FormData($('#register_data')[0]);
        
        if($('#register_data')[0].checkValidity() === true){
            Swal.fire({
                title: 'Saving...',
                html: 'Please wait for a moment...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            })
            
            $.ajax({
                url:"{{url('register')}}",
                type:'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done((response) => {
                if(response.status == 'success'){
                    Swal.fire(
                        'Success!',
                        response.message,
                        response.status
                    )
                    .then((result) => {
                        if(result.value){
                            window.location.replace("{{url('login')}}")
                        }
                    })
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


