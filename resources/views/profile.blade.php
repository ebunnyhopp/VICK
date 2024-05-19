@extends('layout')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

                <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Profile</h3>
        </div>
          <div class="card-body">
                <form id="profileData" class="row">
                    @csrf
                    <div class="col-md-6 mt-3">
                        <label>Name <span class="text-danger">*</span></label>
                        <input class="form-control" value="{{ auth()->user()->name }}" name="name" required/>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Email Address<span class="text-danger">*</span></label>
                        <input class="form-control" value="{{ auth()->user()->email }}" name="email" required/>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Telephone Num</label>
                        <input class="form-control" value="{{ auth()->user()->r_details->tel_num ?? NULL }}" name="tel_num"/>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label>Address</label>
                        <textarea class="form-control" name="address">{{ auth()->user()->r_details->address ?? NULL }}</textarea>
                    </div>
                </form>
              <div class="col-md-12">
                  <button onClick="submit()" class="btn btn-primary">Save</button>
              </div>
            </div>
        </div>
        <!-- /.card-body --> 
      </div>
      <!-- /.card -->
    </section>
@endsection

@section('postscript')
<script>
     function submit(){
        var validateGroup = $(".needs-validation");
        var formData = new FormData($('#profileData')[0]);
        
        if($('#profileData')[0].checkValidity() === true){
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
                url:"{{url('ajax/store-profile')}}",
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
                            location.reload()
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
@endsection