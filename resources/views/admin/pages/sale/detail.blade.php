@extends('admin.index')
@section('title', 'Order')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#{{$inf->id}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Order #{{$inf->id}}
            <small class="pull-right">Date: 2/10/2014</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        
        <!-- /.col -->
        <div class="col-sm-8 invoice-col">
          To
          <address>
            <strong>{{$inf->fullname }}</strong><br>
            Address: {{$inf->address }} </br>
            Phone: {{$inf->phone}} </br>
            Email: {{$inf->email}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #{{$id}}</b><br>
          <br>
          <b>Order ID:</b>{{$inf->id}}<br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bill as $key => $value)
            <tr>
              <td>{{$value->qty}}</td>
              <td>{{$value->name}}</td>
              <td>{{$value->price + $value->qty}} đ</td>
            </tr>
           @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Date of time {{$inf->created_at}}</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Total:</th>
                <td>{{$inf->total}} đ<td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"> <a href="/admin/order/shipping/<?php echo $id ?>" style="color: #fff;"><i class="fa fa-credit-card"></i> Shipping</a>
          </button>
          
          <button type="button" class="btn btn-primary pull-right order-invoice" style="margin-right: 5px;">
            <a href="/admin/order/invoice/<?php echo $id ?>" style="color: #fff;"><i class="fa fa-download"></i> Invoice   
          </a></button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
@endsection

<!-- <script type="text/javascript">
  function Invoice(event, id){
      event.preventDefault();
      $.ajax({
        url: 'admin/order/invoice/' + <?php echo $id ?>,
        dataType: 'json'
      })
      .done(function() {
        window.location.href = "admin/order";
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
      
  };
</script> -->