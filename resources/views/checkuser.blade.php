@extends('layout')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">User Management</li>
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
          
        <div class="card-body">
          <table class='table table-bordered'>
              <tr style="background-color:#F2F3F4">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                
                @foreach ($user as $c)
                <tr>
                    <td>{{$c->name}}</td>
                    <td>{{$c->email}}</td>
                    <td class="text-center">
                        <select class="form-control" onchange="changerole({{$c->id}},this.value)">
                            <option value="1" {{$c->role==1 ? 'selected' : null}}>User</option>
                            <option value="1" {{$c->role==2 ? 'selected' : null}}>Staff</option>
                            <option value="3" {{$c->role==3 ? 'selected' : null}}>Admin</option>
                        </select>
                    </td>
                    <td class="text-center">{!!$c->getstatus()!!}</td>
                    <td class="text-center">
                        <a href="{{url('user/'.$c->id.'/delete')}}" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                        <button onClick='resetpass({{$c->id}})' class="btn btn-info">
                            <i class="fas fa-key"></i>
                        </button>
                        
                    </td>
                </tr>
                @endforeach
        
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>

@endsection
@section('postscript')
<script>
function resetpass(id){
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
        url:"{{url('user/resetpassword')}}",
        type:'POST',
        data:{
            '_token':"{{csrf_token()}}",
          'user_id':id,  
        },
    }).done((response) => {
        if(response.status == 'success'){
            Swal.fire(
                'Success!',
                response.message,
                response.status
            )    
        } else {
            Swal.fire(
                'Error!',
                response.message,
                response.status
            )
        }
    })
}

function changerole(id, role){
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
        url:"{{url('admin/changerole')}}",
        type:'POST',
        data:{
          '_token': "{{csrf_token()}}",
          'user_id': id,
          'role_id': role
        },
    }).done((response) => {
        if(response.status == 'success'){
            Swal.fire(
                'Success!',
                response.message,
                response.status
            )    
        } else {
            Swal.fire(
                'Error!',
                response.message,
                response.status
            )
        }
    })
}

</script>
@endsection




