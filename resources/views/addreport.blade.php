@extends('layout')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Report</li>
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
          <h3 class="card-title">Add Report</h3>
        </div>
        <div class="card-body">
            <form class='row' action='{{url('clientreport/add')}}' method='post' enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 mt-3">
                    <label>Item Name<span class="text-danger">*</span></label>
                    <input class="form-control" name="itemname" />
                </div>
                <div class="col-md-6 mt-3">
                    <label>Category<span class="text-danger">*</span></label>
                    <select class="form-control" name="category">
                        @foreach($category as $c)
                        <option value="{{ $c->id }}">{{ $c->category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Date</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="date"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Location<span class="text-danger">*</span></label>
                    <select class="form-control" name="location">
                        @foreach($location as $l)
                        <option value="{{ $l->id }}">{{ $l->location }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Receiver Name<span class="text-danger">*</span></label>
                    <select class="form-control" name="receiver_id">
                        @foreach($admins as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Description<span class="text-danger">*</span></label>
                    <input class="form-control" name="description"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Color</label>
                    <input class="form-control" name="color"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Serial Number</label>
                    <input class="form-control" name="serialnum"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Attachment<span class="text-danger">*</span></label>
                    <input class="form-control" name="attachment" type="file"/>
                </div>
                <div class="col-md-12 text-center mt-3" ><button class="btn btn-success" type="submit">Submit</button></div>
            </form>
        </div>
        <!-- /.card-body --> 
      </div>
      <!-- /.card -->
    </section>
@endsection

@section('postscript')    
<script>
    $(() => {
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    });
</script>
@endsection









