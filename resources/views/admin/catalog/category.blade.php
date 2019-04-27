@extends('admin.index')
@section('title', 'Category | Admin')
@section('content')
    <style>
        .success{
            color: #0d3625;
        }
      /*  input[type=checkbox]{
            margin: 0 10px;
        }*/
        tr td{
            padding: 10px 18px !important;
        }
    </style>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

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
                        <h3 class="box-title">Category Data Table</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="/admin/category/create"><button class="btn btn-primary" style="margin-bottom: 20px"  id="add-form">Add Category</button></a>
                        <table id="category-table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key => $category)
                            <tr>
                                <td>
                                    <input type="checkbox" name="id[]" value=" {{$category->id}}">
                                    {{$key + 1}}
                                </td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>
                                    <a href="/admin/category/edit/{{$category->id}}"><i class="fa fa-edit"></i></a>
                                    <a href="/admin/category/delete/{{$category->id}}" onclick="return confirm('Are you sure delete this category?')" ><i class="fa fa-window-close"></i></a>
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


    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Category</h4>
                </div>
                <div class="modal-body">
                    <form id="form-category" >
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="" id="id">
                    <div class="form-group name">
                        <label>Category</label>
                        <input type="text" class="form-control" placeholder="Category..." name="name" id="name"/>
                    </div>
                    <div class="form-group slug">
                        <label>Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug"/>
                    </div>
                    <button class="btn btn-primary" id="submit" typle="submit">Add Category</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>
    <script>
        $(document).ready( function () {
            $('#category-table').DataTable({
            })
        } );
        // $("#add-form").click(function () {
        //     $("#myModal").modal('show');
        //     $("#submit").html("Add Category");
        //     $("#id").val("");
        //     removeDataPopup();
        // });

        // $("#submit").click(function (event) {
        //     var url;
        //     var content = '';
        //     if($("#id").val() != ""){
        //         url = '/admin/category/update/' + $("#id").val();
        //         content = 'Update category successfully!';
        //     }else{
        //         url =  '/admin/category/create';
        //         content = 'Add category successfully!';
        //     }
        //     event.preventDefault();
        //     $.ajax({
        //         url : url,
        //         method: 'POST',
        //         type: 'json',
        //         data: $("#form-category").serialize(),
        //         success: function(response){
        //             if(response['errors']){
        //                 $.each(response['errors'] , function(key, value){
        //                     $("." + key).addClass('has-error');
        //                 });
        //             }
        //             else{
        //                 $("#form-category").before("<span class='success'>" + content + "</span>");
        //                 window.setTimeout(function(){location.reload()},4000);
        //             }
        //         }
        //     });
        // });

        // function removeDataPopup(){
        //     $("#form-category").trigger("reset");
        //     $("#form-category div").removeClass('has-error');
        // }

        // $(document).on('click','.open_modal',function(){
        //    removeDataPopup();
        //    $("#myModal").modal("show");
        // });

        // function updateFunction(id){
        //     $("#id").val(id);
        //     var url = '/admin/category/show/' + id;
        //     $.ajax({
        //        url: url,
        //        method: 'GET',
        //        success: function(response){
        //            if(response['user']){
        //                $("#name").val(response['user']['name']);
        //                $("#slug").val(response['user']['slug']);
        //                $("#submit").html("Update Category");
        //                $("#id").val(response['user']['id']);
        //            }
        //        }
        //     });
        // }
    </script>
@endsection