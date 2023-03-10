@extends('layout')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Category</li>
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
          <h3 class="card-title">Add Category</h3>
        </div>
        <div class="card-body">
            <form class='row' action='{{url('admin/setting/category/add')}}' method='post'>
                @csrf
                <div class='col-md-12'>
                    <label>
                        Category Name
                    </label>
                    <input class='form-control'name='category'>
                </div>
                <div class='col-md-12 text-center mt-3'>
                    <button type='submit' class='btn btn-success'>Save</button>
                </div>
            </form>
            
        </div>
        <!-- /.card-body --> 
      </div>
      <!-- /.card -->
    </section>

@endsection





