@extends('admin.index')
@section('title', 'Product | Admin')
@section('content')
  

<script>
    CKEDITOR.replace( 'summary-ckeditor' );
</script>
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
            <form id="form-product" enctype="multipart/form-data" method="POST" action="/admin/product/update/{{$product->id}}">
            <div class="col-xs-9">
                <div class="box">
                        {{csrf_field()}}
                       
                            <input type="hidden" name="id" id="id">
                            <div class="form-group name">
                                <label>Name</label><span class="required">*</span>
                                <input required type="text" class="form-control" placeholder="Name product..." name="name" id="name" value="{{$product->name}}"/>
                            </div>
                            <div class="form-group price">
                                <label>Price</label><span class="required">*</span>
                                <input required type="text" name="price" id="price" class="form-control" value="{{$product->price}}"}>
                            </div>
                            <div class="form-group quantity">
                                <label>Quantity</label><span class="required">*</span>
                                <input required type="text" name="quantity" id="quantity" class="form-control" value="{{$product->quantity}}">
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select name="id_cat" class="form-control">
                                        <option></option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" <?php echo $product->id_cat == $category->id ? "selected" : null ?> >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Brand</label>
                                <select name="id_brand" class="form-control">
                                        <option></option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" <?php echo $product->id_brand == $brand->id ? "selected" : null ?>>{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                
                                <textarea name="description" rows="10" id="description" height="500px">
                                    {{$product->description}}
                                </textarea>
                                    <script>
                                        CKEDITOR.replace( 'description' );
                                    </script>
                            </div>    
                </div>

            </div>
            <div class="col-xs-3">
                <div class="box">
                    <label style="border-bottom: 1px solid #ccc; margin-bottom: 20px; padding-bottom:20px; width: 100%">Publish</label></br>
                    <button class="btn btn-primary" id="save" type="submit"><i class="fa fa-save" style="margin-right: 10px"></i> Save</button>
                    <!-- <button class="btn btn-success"><i class="fa fa-check-circle" style="margin-right: 10px"></i>Save & Edit</button> -->
                </div>
                <div class="box image">
                    <label style="border-bottom: 1px solid #ccc; margin-bottom: 20px; padding-bottom:20px; width: 100%">Image</label></br>
                    <?php if(isset($product->image)): ?>
                    <img src="{{asset('/upload/' . $product->image)}}" width="150px" height="150px" id="image">
                    <?php else: ?>
                    <img src="http://www.kensap.org/wp-content/uploads/empty-photo.jpg" width="150px" height="150px" id="image">
                    <?php endif?>
                    <input type="file" name="image" style="margin-top: 20px" onchange="readURL(this)">
                </div>
                <div class="box">
                    <label style="border-bottom: 1px solid #ccc; margin-bottom: 20px; padding-bottom:20px; width: 100%">Status</label></br>
                    <select class="form-control" name="status">
                        <option value="1">Publish</option>
                        <option value="0">Draf</option>
                    </select>
                    </br>
                    <select class="form-control" name="is_feature">
                        <option value="1">Feature</option>
                        <option value="0">Simple</option>
                    </select>
                </div>
            </div>
            </form>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

</div>

   


@endsection