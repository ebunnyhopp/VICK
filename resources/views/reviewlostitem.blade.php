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
              <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Item</li>
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
          <h3 class="card-title">Add Item</h3>
        </div>
        <div class="card-body">
            <form class='row' method='get'>
                @csrf
                
                <div class="col-md-6 mt-3">
                    <label>Item Name<span class="text-danger">*</span></label>
                    <input class="form-control" name="itemname" value="{{$item->item}}" readOnly/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Category<span class="text-danger">*</span></label>
                    <input class="form-control" name="category" value="{{$item->r_category->category}}" readOnly/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Date<span class="text-danger">*</span></label>
                    <input class="form-control" name="date" value="{{$item->date_found}}" readOnly/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Location<span class="text-danger">*</span></label>
                    <input class="form-control" name="location" value="{{$item->r_location->location}}" readOnly/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Receiver Name<span class="text-danger">*</span></label>
                    <input class="form-control" name="receiver_id" value="{{$item->r_receiver->name}}" readOnly/>

                </div>
                <div class="col-md-6 mt-3">
                    <label>Description<span class="text-danger">*</span></label>
                    <input class="form-control" name="description" value="{{$item->description}}" readOnly/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Color</label>
                    <input class="form-control" name="color" value="{{$item->color}}" readOnly/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Serial Number</label>
                    <input class="form-control" name="serial_num" value="{{$item->serial_num}}" readOnly/>
                </div>
                
                <div class="col-md-12 text-center mt-3" >
                    <a href='{{url('lostitem')}}' class="btn btn-primary">Back</a></div>
            </form>
        </div>
        <!-- /.card-body --> 
      </div>
      <!-- /.card -->
    </section>
@endsection

<!--@section('postscript')    
<script>
    $(() => {
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    });
</script>
@endsection-->








