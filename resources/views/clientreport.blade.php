@extends('layout')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Item</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
          <h3 class="card-title"></h3>

          <div class="card-tools">
              <a href='{{url('clientreport/add')}}' class="btn btn-sm btn-primary">Add Item</a>
          </div>
        </div>
        <div class="card-body">
          <table class='table table-bordered'>
                <tr style="background-color:#F2F3F4">
                    <th>Item name</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Color</th>
                    <th>Serial Number</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($item as $r)
                <tr>
                    <td>{{$r->item}}</td>
                    <td>{{$r->r_category->category}}</td>
                    <td>{{$r->place_found}}</td>
                    <td>{{$r->date_found}}</td>
                    <td>{{$r->description}}</td>
                    <td>{{$r->color}}</td>
                    <td>{{$r->serial_num}}</td>
                    <td class="text-center">{!!$r->getstatus()!!}</td>
                    <td class="text-center">
                        <a href="{{url('admin/item/'.$r->id.'/delete')}}" class='btn btn-danger'>
                        <i class="fas fa-trash"></i>
                        </a>
                        <a href="{{url('admin/item/'.$r->id.'/return')}}" class='btn btn-success'>
                        <i class="fas fa-check"></i>
                        </a>
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




