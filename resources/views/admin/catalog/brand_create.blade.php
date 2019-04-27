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
            <form id="form-brand" enctype="multipart/form-data" method="POST" action="/admin/brand/create">
            <div class="col-xs-8">
                <div class="box">
                        {{csrf_field()}}
                        @if(isset($brand))
                            <input type="hidden" name="id" value="{{$brand->id}}" id="id">
                            
                            <div class="form-group name">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Brand..." name="name" id="name" value="{{$brand->name}}" />
                            </div>
                             <textarea name="description" rows="10" name="description" id="description" height="500px">
                                {{$brand->description}}
                                </textarea>
                                    <script>
                                        CKEDITOR.replace( 'description' );
                                    </script>
                        @else
                             <input type="hidden" name="id" id="id">
                            <div class="form-group name">
                                <label>Name</label><span class="required">*</span>
                                <input type="text" class="form-control" placeholder="Brand..." name="name" id="name"/>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" rows="10" name="description" id="description" height="500px">
                                </textarea>
                                    <script>
                                        CKEDITOR.replace( 'description' );
                                    </script>
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
                <div class="box image">
                    <label style="border-bottom: 1px solid #ccc; margin-bottom: 20px; padding-bottom:20px; width: 100%">Image</label></br>
                    @if(isset($brand))  <img src="{{ asset('upload/' . $brand->image)  }}" width="150px" height="150px" id="image">
                    @else <img src="http://www.kensap.org/wp-content/uploads/empty-photo.jpg" width="150px" height="150px" id="image">
                    @endif
                    <input type="file" name="image" style="margin-top: 20px" onchange="readURL(this)" id="file">
                </div>
            </div>
            </form>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

</div>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        if($("#id").val() !=''){
           $("#form-brand").attr('action', '/admin/brand/update/'+ $("#id").val()); 
        }
        
    });
       function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#image").attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#form-brand').on('submit', function(event){
        $(".loaders").show();
        var url = "";
        if($("#id").val() !=''){
            url = '/admin/brand/edit/' + $("#id").val();
        }else{
            url = '/admin/brand/create';
        }
        event.preventDefault();
         $.ajax({
            url: url,
            type: 'POST',
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
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
                    swal("Add Brand successfully!", "Add brand successfully!", "success")
                    .then((value) => {
                        window.location.href = "/admin/brand";
                    });
                }
            }
        })
        .done(function() {
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            $(".loaders").hide();
        });
    });
</script>
 
@endsection