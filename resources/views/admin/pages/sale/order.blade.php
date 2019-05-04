@extends('admin.index')
@section('title', 'Order')
@section('content')
<div class="content-wrapper">
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Orders</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Purchase Date</th>
                  <th>Bill-to Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Total</th>
                  <th>Method</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bills as $key => $value)
                <tr>
                  
                  <td>{{$key + 1}}</td>
                  <td>{{$value->created_at}}</td>
                  <td>{{$value->fullname}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->address}}</td>
                  <td>{{$value->total}} đ</td>
                  <td>
                    @if($value->method == 1)
                        <span>Paypal</span>
                    @else
                        <span>Payment on delivery</span>
                    @endif   
                  
                  </td>
                  <td>
                    @if($value->status == 0) 
                    <span>Process</span></td>
                    @elseif($value->status ==2 )
                    <i class="fa fa-truck"></i></td>
                    @else
                    <i class="fa fa-check-circle"></i></td>
                    @endif
                  <td>
                    <a href="{{route('detail_order', $value->id)}}"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>
@endsection    