@extends('layout')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <!--<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>-->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
        <div class="card-header">
          <!--<h3 class="card-title">Dashboard</h3>-->

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <!--<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>-->
          </div>
        </div>
        <div class="card-body">
            <table class='table table-bordered'>
                <tr style="background-color:#F2F3F4">
                    <th colspan="4" class='text-center'>Reporting</th>
                </tr>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                </tr>
                <tr>
                    <td>Item Reported</td>
                    <td>{{$items->count()}}</td>
                </tr>
                <tr>
                    <td>Item Claimed</td>
                    <td>{{$req->count()}}</td>
                </tr>
            </table>
        </div>
        <!-- /.card-body -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <!--<h3 class="card-title">Dashboard</h3>-->

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <!--<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>-->
          </div>
        </div>
        <div class="card-body">
            <table class='table table-bordered'>
                <tr style="background-color:#F2F3F4">
                    <th colspan="4" class='text-center'>List of Categories</th>
                </tr>
                <tr>
                    <th>Categories</th>
                    <th>Subcategories</th>
                    <th>Label</th>
                    <th>Time Span</th>
                </tr>
                <tr>
                    <td rowspan="7">Common Items</td>
                    <td>Bags</td>
                    <td>BG</td>
                    <td rowspan="7">1 Month</td>
                </tr>
                <tr>
                    <td>Clothings</td>
                    <td>CL</td>
                </tr>
                <tr>
                    <td>Containers / Bottles</td>
                    <td>CB</td>
                </tr>
                <tr>
                    <td>Electronics, Computers, Phones</td>
                    <td>ES</td>
                </tr>
                <tr>
                    <td>Stationary</td>
                    <td>ST</td>
                </tr>
                <tr>
                    <td>Accessories, Watches, Glasses</td>
                    <td>AS</td>
                </tr>
                <tr>
                    <td>Books</td>
                    <td>BK</td>
                </tr>
                <tr>
                    <td>Protected Items</td>
                    <td>ID Card, Student/Staff Card, Security Card, Bank Card</td>
                    <td>CD</td>
                    <td>1 Week</td>
                </tr>
                <tr>
                    <td>Valuable Items</td>
                    <td>Valuable Stuff, Money, Jewelry</td>
                    <td>JV</td>
                    <td>1 Week</td>
                </tr>
            </table>
        </div>
        <!-- /.card-body -->
        <!-- /.card-footer-->
      </div>
      

    </section>

@endsection