@extends('layout')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Request</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Request</li>
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
                    <th>Item name</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
                @foreach ($req as $c)
                <tr>
                    <td>{{$c->r_item->item}}</td>
                    <td>{{$c->description}}</td>
                    <td>{!!$c->getstatus()!!}</td>
                    
                </tr>
                @endforeach
        
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>

@endsection





