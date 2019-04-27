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
</style>
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
                        <th scope="col" class="col status">Status</th>
                        <th scope="col" class="col actions">Action</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td data-th="Order #" class="col id">000000002</td>
                            <td data-th="Date" class="col date">3/9/17</td>
                            <td data-th="Ship To" class="col shipping">Veronica Costello</td>
                            <td data-th="Order Total" class="col total"><span class="price">$39.64</span></td>
                            <td data-th="Status" class="col status">Complete</td>
                            <td data-th="Actions" class="col actions">
                                <a href="http://lnulti.demo.mageplaza.com/sales/order/view/order_id/2/" class="action view">
                                    <span>View Order</span>
                                </a>
                                <a href="#" data-post="{&quot;action&quot;:&quot;http:\/\/lnulti.demo.mageplaza.com\/sales\/order\/reorder\/order_id\/2\/&quot;,&quot;data&quot;:{&quot;uenc&quot;:&quot;aHR0cDovL2xudWx0aS5kZW1vLm1hZ2VwbGF6YS5jb20vY3VzdG9tZXIvYWNjb3VudC8,&quot;}}" class="action order">
                                    <span>Reorder</span>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td data-th="Order #" class="col id">000000001</td>
                            <td data-th="Date" class="col date">3/9/17</td>
                            <td data-th="Ship To" class="col shipping">Veronica Costello</td>
                            <td data-th="Order Total" class="col total"><span class="price">$36.39</span></td>
                            <td data-th="Status" class="col status">Processing</td>
                            <td data-th="Actions" class="col actions">
                                <a href="http://lnulti.demo.mageplaza.com/sales/order/view/order_id/1/" class="action view">
                                    <span>View Order</span>
                                </a>
                                <a href="#" data-post="{&quot;action&quot;:&quot;http:\/\/lnulti.demo.mageplaza.com\/sales\/order\/reorder\/order_id\/1\/&quot;,&quot;data&quot;:{&quot;uenc&quot;:&quot;aHR0cDovL2xudWx0aS5kZW1vLm1hZ2VwbGF6YS5jb20vY3VzdG9tZXIvYWNjb3VudC8,&quot;}}" class="action order">
                                    <span>Reorder</span>
                                </a>
                            </td>
                        </tr>
                </tbody>
            </table>
    </div>
    <div class="block block-dashboard-info">
        <div class="block-title"><strong>Account Information</strong></div>
        <div class="block-content row">
            <div class="box box-information col-md-6">
                <strong class="box-title">
                    <span>Contact Information</span>
                </strong>
                <div class="box-content">
                    <p>
                        Veronica Costello<br>
                        roni_cost@example.com<br>
                    </p>
                </div>
                <div class="box-actions">
                    <a class="action edit" href="http://lnulti.demo.mageplaza.com/customer/account/edit/">
                        <span>Edit</span>
                    </a>
                    <a href="http://lnulti.demo.mageplaza.com/customer/account/edit/changepass/1/" class="action change-password">
                        Change Password                </a>
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
    <div class="block block-dashboard-addresses">
        <div class="block-title">
            <strong>Address Book</strong>
            <a class="action edit" href="http://lnulti.demo.mageplaza.com/customer/address/"><span>Manage Addresses</span></a>
        </div>
        <div class="block-content row">
            <div class="box box-billing-address col-md-6">
                <strong class="box-title">
                    <span>Default Billing Address</span>
                </strong>
                <div class="box-content">
                    <address>
                        Veronica Costello<br>
                        6146 Honey Bluff Parkway<br>
                        Calder,  Michigan, 49628-7978<br>
                        United States<br>
                        T: (555) 229-3326
                    </address>
                </div>
                <div class="box-actions">
                    <a class="action edit" href="http://lnulti.demo.mageplaza.com/customer/address/edit/id/1/" data-ui-id="default-billing-edit-link"><span>Edit Address</span></a>
                </div>
            </div>
            <div class="box box-shipping-address col-md-6">
                <strong class="box-title">
                    <span>Default Shipping Address</span>
                </strong>
                <div class="box-content">
                    <address>
                        Veronica Costello<br>
                        6146 Honey Bluff Parkway<br>
                        Calder,  Michigan, 49628-7978<br>
                        United States<br>
                        T: (555) 229-3326
                    </address>
                </div>
                <div class="box-actions">
                    <a class="action edit" href="http://lnulti.demo.mageplaza.com/customer/address/edit/id/1/" data-ui-id="default-shipping-edit-link"><span>Edit Address</span></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection