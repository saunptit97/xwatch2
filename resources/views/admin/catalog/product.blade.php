@extends('admin.index')
@section('title', 'Product | Admin')
@section('content')
    <style>
        .success{
            color: #0d3625;
            padding-left: 10px;
        }
        .error{
            color: red;
            padding-left: 10px;
        }
    </style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product Data Table</h3>
                    </div>
                    @if(session('errors'))
                        <span class="error">Add Product failed!!!</span>
                    @endif
                    @if(session('success'))
                        <span class="success">{{session('success')}}</span>
                    @endif
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="/admin/product/create"><button class="btn btn-primary" style="margin-bottom: 20px"  id="add-form"><i class="fa fa-plus"></i> Add Product</button></a>
                        <table id="product-table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Name</th>
                
                                <th>Price</th>
                                <th>Status</th>
                                <th>Publish</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                               @foreach($products as $key => $product)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><img src="{{ asset('upload/' . $product->image .'') }}" width="50px" height="50px"></td>
                                    <td>{{$product->name}}</td>
                                    
                                    <td>{{$product->price}}</td>
                                    <td>@if($product->quantity >0)
                                        <span>Stock</span>
                                        @else <span>Out Stock</span>
                                        @endif
                                    </td>
                                    <td>{{$product->status}}</td>
                                    <td>
                                        <a href="/admin/product/update/{{$product->id}}" class="open open_modal" onclick="updateFunction({{$product->id}})"><i class="fa fa-edit"></i></a>
                                        <a href="/admin/product/delete/{{$product->id}}" onclick="return confirm('Are you sure delete this product?')" ><i class="fa fa-window-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>


    
    <script type="text/javascript">
        $(document).ready( function () {
            $('#product-table').DataTable({
            })
        } );
        $("#add-form").click(function(event) {
            $("#myModal").modal("show");
            $("#myModal h4,#submit").html("Add Product");
        });
        $(".open_modal").click(function(){
            $("#myModal").modal("show");
            $("#myModal h4,#submit").html("Update Product");
            
        });
        function updateFunction(id){
            $("#id").val(id);
            $.ajax({
                url: '/admin/product/show/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    var product = response.product;
                    $("#name").val(product.name);
                    $("#price").val(product.price);
                    $("#quantity").val(product.quantity);
                    $("#id_cat").val(product.id_cat);
                    $("#id_brand").val(product.id_brand);
                    $("#description").val(product.description);
                }
            });
        }
    </script>
</div>
@endsection