@extends('admin.index')
@section('title', 'Category | Admin')
@section('content')
    <style>
        .success{
            color: #0d3625;
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
                        <h3 class="box-title">Brand Data Table</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="/admin/brand/create"><button class="btn btn-primary" style="margin-bottom: 20px"  id="add-form"><i class="fa fa-plus"></i> Add Brand</button></a>
                        <table id="brand-table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Brand</th>
                                <th>Name</th>
                                <th>Discription</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $key => $brand)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td><img src="{{asset('/upload/' . $brand->image)}}" width="100px" height="50px"></td>
                                        <td>{{$brand->name}}</td>
                                        <td>{{$brand->description}}</td>
                                        <td>
                                            <a href="/admin/brand/edit/{{$brand->id}}"><i class="fa fa-edit"></i></a>
                                    <a href="#" onclick="return deleteBrand({{$brand->id}})" ><i class="fa fa-window-close"></i></a>
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


    
</div>
    <script>
        $(document).ready( function () {
            $('#brand-table').DataTable({
            })
        } );
        function deleteBrand(id){
            var url = '/admin/brand/delete/' + id;
            swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    type: 'json',
                    success: function(response){
                        if(response['success']){
                          swal("Delete successfully!", "Delete successfully!", "success")
                            .then((value) => {
                                window.location.href = "/admin/brand";
                            });   
                        }
                    }
                });    
              }
            });
        }
     </script>
@endsection