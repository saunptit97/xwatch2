@extends('frontend.index');

@section('content')
<style>
    .title{
        margin-bottom: 40px;
    }
    .recent-order{
        margin-bottom: 40px;
    }
    .block-dashboard-info, .block-dashboard-addresses{
        margin-bottom: 40px;
    }
    .modal-body input{
        border: 1px solid #ccc !important;
        margin-bottom: 5px;
    }
</style>    

<?php $user = Session::get('user'); ?>
<div class="container">
    <h2 class="title">My Dashboard</h2>
    <div class="recent-order">
        <table class="data table table-order-items recent" id="my-orders-table">
                <strong class="table-caption">Recent Orders</strong>
                <thead>
                    <tr>
                        <th scope="col" class="col id">Order #</th>
                        <th scope="col" class="col date">Date</th>
                        <th scope="col" class="col shipping">Ship To</th>
                        <th scope="col" class="col total">Order Total</th>
                        <th scope="col" class="col total">Method</th>
                    
                        <th scope="col" class="col status">Status</th>
                        <th scope="col" class="col actions">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bills as $bill) :?>
                        <tr>
                            <td data-th="Order #" class="col id">{{$bill->id}}</td>
                            <td data-th="Date" class="col date">{{$bill->created_at}}</td>
                            <td data-th="Ship To" class="col shipping">{{$bill->address}}</td>
                            <td data-th="Order Total" class="col total"><span class="price">{{$bill->total}}</span></td>
                            <td data-th="Order Total" class="col total">
                                @if($bill->method == 1)
                                    <span>Paypal</span>
                                @else
                                    <span>Payment on delivery</span>
                                @endif    
                            </td>
                            <td data-th="Status" class="col status">
                                @if($bill->status == 0) 
                                <span>Process</span></td>
                                @elseif($bill->status ==2 )
                                <i class="fa fa-truck"></i></td>
                                @else
                                <i class="fa fa-check-circle"></i></td>
                                @endif
                                        </td>
                            <td data-th="Actions" class="col actions">
                                <a href="http://lnulti.demo.mageplaza.com/sales/order/view/order_id/2/" class="action view">
                                    <span>View Order</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                     
                </tbody>
            </table>
    </div>
    

<!-- Modal -->
<div id="edit-contact" class="modal fade" role="dialog" style="z-index: 9999;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contact Information</h4>
      </div>
      <div class="modal-body" >
        <form>
            <label>Full name:</label>
            <input class="form-control" value="{{$user->fullname}}"/>
            <label>Email: </label>
            <input class="form-control" value="{{$user->email}}"/>
            <label>Address: </label>
            <input class="form-control" value="{{$user->address}}"/>
            <label>Phone: </label>
            <input class="form-control" value="{{$user->phone}}"/>
            <button class="btn btn-primary">Update</button>
        </form>
      </div>
      
    </div>

  </div>
</div>
    <div class="block block-dashboard-info">
        <div class="block-title"><strong>Account Information</strong></div>
        <div class="block-content row">
            <div class="box box-information col-md-6">
                <strong class="box-title">
                    <span>Contact Information</span>
                </strong>
                <div class="box-content">
                    <p><span style="font-weight: bold">Name: </span>{{$user->fullname}}</p>
                    <p><span style="font-weight: bold">Email: </span>{{$user->email}}</p>
                    <p><span style="font-weight: bold">Address: </span>{{$user->address}}</p>
                    <p><span style="font-weight: bold">Phone: </span>{{$user->phone}}</p>

                </div>
                <div class="box-actions">
                    <span data-toggle="modal" data-target="#edit-contact">Edit</span>
                </div>
            </div>
            <div class="box box-newsletter col-md-6">
                <strong class="box-title">
                    <span>Newsletters</span>
                </strong>
                <div class="box-content">
                    <p>You don't subscribe to our newsletter.                                            </p>
                </div>
                <div class="box-actions">
                    <a class="action edit" href="http://lnulti.demo.mageplaza.com/newsletter/manage/"><span>Edit</span></a>
                </div>
            </div>
            </div>
    </div>
    
</div>

@endsection