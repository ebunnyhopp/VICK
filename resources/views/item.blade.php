@extends('layout')
@section('content')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Item</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Item</li>
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
          <h3 class="card-title">Item List</h3>

          <div class="card-tools">
              <a href='{{url('admin/item/add')}}' class="btn btn-sm btn-primary">Add Item</a>
          </div>
        </div>
        <div class="card-body">
          <table id="itemList" class='table table-bordered'>
              <thead>
                <tr style="background-color:#F2F3F4">
                    <th>Item name</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Receiver Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($item as $c)
                <tr>
                    <td>{{$c->item}}</td>
                    <td>{{$c->r_category->category}}</td>
                    <td>{{$c->date_found}}</td>
                    <td>{{$c->r_location->location}}</td>
                    <td>{{$c->r_receiver->name}}</td>
                    <td>{{$c->description}}</td>
                    <td class="text-center">{!!$c->getstatus()!!}</td>
                    <td class="text-center">
                        <a href="{{url('admin/item/'.$c->id.'/view')}}" class='btn btn-primary'>
                        <!--<i class="fas fa-check"></i>-->View
                        </a>
                        <a href="{{url('admin/item/'.$c->id.'/delete')}}" class='btn btn-danger'>
                        <!--<i class="fas fa-trash">Delete</i>-->Delete
                        </a>
                        <a href="{{url('admin/item/'.$c->id.'/return')}}" class='btn btn-success'>
                        <!--<i class="fas fa-check">Return</i>-->Return
                        </a>
                    </td>
                </tr>
                @endforeach
<!--                eloquent-->
              </tbody>
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
@endsection

@section('postscript')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    dt = $("#itemList").DataTable();
</script>
@endsection



