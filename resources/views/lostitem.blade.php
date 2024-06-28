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
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
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
        <div class="card-body">
          <table id="itemList" class='table table-bordered'>
              <thead>
                <tr style="background-color:#F2F3F4">
                    <th>Item name</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Date</th>
                    <!--<th>Status</th>-->
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($item as $c)
                <tr>
                    <td>{{$c->item}}</td>
                    <td>{{$c->r_category->category}}</td>
                    <td>{{$c->r_location->location}}</td>
                    <td>{{$c->date_found}}</td>
                    <!--<td class="text-center">{!!$c->getstatus()!!}</td>-->
                    <td class="text-center">
                        <a href="{{url('lostitem/'.$c->id.'/view')}}" class='btn btn-primary'>
                        <!--<i class="fas fa-check">-->View Item</i>
                        </a>
                        <a href="{{url('item/'.$c->id.'/requestitem')}}" class='btn btn-success'>
                        <!--<i class="fas fa-check">-->Claim Item</i>
                        </a>
                        
                    </td>
                </tr>
                @endforeach
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
