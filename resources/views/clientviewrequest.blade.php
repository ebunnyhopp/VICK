@extends('layout')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Item Request</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Item Request</li>
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
          <h3 class="card-title">Add Request</h3>
        </div>
        <div class="card-body">
            <form class='row' action='{{url('request/'.$req->id.'/viewrequest')}}' method='POST'>
                @csrf
                <div class="col-md-6 mt-3">
                    <label>Item Name</label>
                    <input class="form-control" name="itemname" value="{{$req->r_item->item}}" readOnly />
                </div>
                <div class="col-md-6 mt-3">
                    <label>Category</label>
                    <input class="form-control" name="category" value="{{$req->r_item->r_category->category}}" readOnly></input>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Location</label>
                    <input class="form-control" name="location" value="{{$req->r_item->r_location->location}}" readOnly/>
                </div>
                <div class="col-md-6 mt-3">
                    <label>Date</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="date" value="{{date('d/m/Y',strtotime($req->r_item->date_found))}}" readOnly/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mt-3">
                    <label>Color</label>
                    <input class="form-control" name="color" value="{{$req->r_item->color}}" readOnly/>
                </div>
                
                <div class="col-md-6 mt-3">
                    <label>Serial Number</label>
                    <input class="form-control" name="serialnum" value="{{$req->r_item->serial_num}}" readOnly/>
                </div>
                <div class="col-md-12 mt-3">
                    <label>Description</label>
                    <textarea class="form-control" rows="4" name="description">{{$req->description}}</textarea>
                </div>
                <div class="col-md-12 text-center mt-3" >
                    <a href="{{url('clientrequest')}}" class='btn btn-primary'>
                        Back    
                    </a>
                    <button type="submit" onClick="submit()" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
        <!-- /.card-body --> 
      </div>
      <!-- /.card -->
    </section>
@endsection

@section('postscript')    

@endsection









