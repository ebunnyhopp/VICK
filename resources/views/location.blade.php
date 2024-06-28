@extends('layout')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Location</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Location</li>
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
          <h3 class="card-title">Location List</h3>

          <div class="card-tools">
            <a href='javascript:void(0)' class="btn btn-sm btn-primary" onclick="modalLocation()">
            Add Location
            </a>
          </div>
        </div>
        <div class="card-body">
            <table class='table table-bordered'>
                <tr style="background-color:#F2F3F4">
                    <th width="80%">Location</th>
                    <th width="20%">Action</th>
                </tr>
                @foreach($location as $l)
                <tr>
                    <td>{{$l->location}}</td>
                    <td class='text-center'>
                        <a href="javascript:void(0)" onclick="modalLocation({{$l->id}})" class='btn btn-primary'>
                            <!--<i class="fas fa-edit">-->Edit</i>
                        </a>
                        <a href="{{url('admin/setting/location/'.$l->id.'/delete')}}" class='btn btn-danger'>
                            <!--<i class="fas fa-trash">-->Delete</i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
            <div id="variable"></div>
        </div>
        <!-- /.card-body -->
        
      </div>
      <!-- /.card -->
      
    </section>
    
    <script>
        modalLocation = (id) => {
            $.ajax({
                type: "POST",
                url: "{{ url('ajax/modal-location') }}",
                data: {
                    '_token': '{{csrf_token() }}',
                    'id': id
                }
            }).done((response) => {
                $("#variable").html(response)
                $("#modal-location").modal('show')
            });
        }
    </script>
@endsection

