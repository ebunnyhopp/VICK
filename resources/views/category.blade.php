@extends('layout')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admindashboard">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
          <h3 class="card-title">Category List</h3>

          <div class="card-tools">
            <a href='javascript:void(0)' class="btn btn-sm btn-primary" onclick="modalCategory()">
            Add Category
            </a>
          </div>
        </div>
        <div class="card-body">
            <table class='table table-bordered'>
                <tr style="background-color:#F2F3F4">
                    <th width="80%">Category</th>
                    <th width="20%">Action</th>
                </tr>
                @foreach($category as $c)
                <tr>
                    <td>{{$c->category}}</td>
                    <td class='text-center'>
                        <a href="javascript:void(0)" onclick="modalCategory({{$c->id}})" class='btn btn-primary'>
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{url('admin/setting/category/'.$c->id.'/delete')}}" class='btn btn-danger'>
                            <i class="fas fa-trash"></i>
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
        modalCategory = (id) => {
            $.ajax({
                type: "POST",
                url: "{{ url('ajax/modal-category') }}",
                data: {
                    '_token': '{{csrf_token() }}',
                    'id': id
                }
            }).done((response) => {
                $("#variable").html(response)
                $("#modal-category").modal('show')
            });
        }
    </script>
@endsection

