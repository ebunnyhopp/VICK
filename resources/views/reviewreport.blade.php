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
          <h3 class="card-title">View Report</h3>
        </div>
        <div class="card-body">
            <form action='{{ url('clientreport/add') }}' method="POST" class='row'>
                @csrf
                <div class="col-md-6 mt-3">
                    <label>Item Name<span class="text-danger">*</span></label>
                    <input class="form-control" name="itemname" value="{{$item->item}}"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Category<span class="text-danger">*</span></label>
                    <select class="form-control" name="category">
                        @foreach($category as $c)
                        <option value="{{ $c->id }}" {{$item->category_id ==$c->id ? 'selected' : NULL}}>{{ $c->category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Date<span class="text-danger">*</span></label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="date" value='{{$item->date_found}}'/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Location<span class="text-danger">*</span></label>
                    <select class="form-control" name="location">
                        @foreach($location as $l)
                        <option value="{{ $l->id }}" {{$item->location_id ==$l->id ? 'selected' : NULL}}>{{ $l->location }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Receiver Name<span class="text-danger">*</span></label>
                    <select class="form-control" name="receiver_id">
                        @foreach($admins as $a)
                        <option value="{{ $a->id }}" {{$item->receiver_id ==$a->id ? 'selected' : NULL}}>{{ $a->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Description<span class="text-danger">*</span></label>
                    <input class="form-control" name="description" value="{{$item->description}}"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Color</label>
                    <input class="form-control" name="color" value="{{$item->color}}"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Serial Number</label>
                    <input class="form-control" name="serial_num" value="{{$item->serial_num}}"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Attachment</label>
                    @if($item->attachment)
                    <a href="{{url('uploads/'.$item->attachment)}}" class="badge bg-primary">View Attachment</a>
                    @else
                    <a href="#" class="badge bg-dark">No Attachment</a>
                    @endif
                </div>
                <input type='hidden' name='id' value='{{$item->id}}'>
                <div class="col-md-12 text-center mt-3" >
                    <a href="{{url('clientreport')}}" class="btn btn-primary">Back</a>
                    <button type="submit" onClick="submit()" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
        <!-- /.card-body --> 
      </div>
      <!-- /.card -->
    </section>
@endsection

<!--@section('postscript')
@endsection-->
@section('postscript')    
<script>
    $(() => {
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    });
</script>
@endsection








