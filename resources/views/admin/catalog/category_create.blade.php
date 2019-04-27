@extends('admin.index')
@section('title', 'Category | Admin')
@section('content')
  

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
            <form id="form-category" >
            <div class="col-xs-8">
                <div class="box">
                        {{csrf_field()}}
                        @if(isset($category))
                            <input type="hidden" name="id" value="{{$category->id}}" id="id">
                            <div class="form-group name">
                                <label>Category</label> <span class="required">*</span>
                                <input type="text" class="form-control" placeholder="Name category" name="name" id="name"  value="{{$category->name}}" />
                            </div>
                            <div class="form-group slug">
                                <label>Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug"/ placeholder="Slug" value="{{$category->slug}}">
                                <small>[ If you do not fill slug It will automatically fill in ]</small>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" cols="5" rows="5" placeholder="Description" name="description">{{$category->description}}</textarea>
                            </div>
                        @else
                            <div class="form-group name">
                                <input type="hidden" name="id"  id="id">
                                <label>Category</label> <span class="required">*</span>
                                <input type="text" class="form-control" placeholder="Name category" name="name" id="name"/>
                            </div>
                            <div class="form-group slug">
                                <label>Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug"/ placeholder="Slug">
                                <small>[ If you do not fill slug It will automatically fill in ]</small>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" cols="5" rows="5" placeholder="Description" name="description"></textarea>
                            </div>
                        @endif
                </div>
            </div>
            <div class="col-xs-4">
                <div class="box">
                    <label style="border-bottom: 1px solid #ccc; margin-bottom: 20px; padding-bottom:20px; width: 100%">Publish</label></br>
                    <button class="btn btn-primary" id="save"><i class="fa fa-save" style="margin-right: 10px"></i> Save</button>
                    <button class="btn btn-success"><i class="fa fa-check-circle" style="margin-right: 10px"></i>Save & Edit</button>
                </div>
            </div>
            </form>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

</div>
    <script>
        $("#save").click(function(event) {
            $(".loaders").show();
            event.preventDefault();
            var url;
            var content = '';
            if($("#id").val() != ""){
                url = '/admin/category/update/' + $("#id").val();
                content = 'Update category successfully!';
            }else{
                url =  '/admin/category/create';
                content = 'Add category successfully!';
            }
            event.preventDefault();
            $.ajax({
                url : url,
                method: 'POST',
                type: 'json',
                data: $("#form-category").serialize(),
                success: function(response){
                    if(response['errors']){
                        var error = "";
                      
                        $.each(response['errors'] , function(key, value){
                            $("." + key).addClass('has-error');
                            error += response['errors'][key];
                        });
                        sweetAlert(error, "Something went wrong!", "error");
                    }
                    else{
                        swal(content, content, "success")
                        .then((value) => {
                            window.location.href = "/admin/category";
                        });
                        
                    }
                }
            }).always(function(){
                  $(".loaders").hide();
            });
        });
    </script>
@endsection