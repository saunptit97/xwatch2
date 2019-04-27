<!DOCTYPE html>
<html>
 <head>
  <title>Upload Image in Laravel using Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Upload Image in Laravel using Ajax</h3>
   <br />
   <div class="alert" id="message" style="display: none"></div>
   {!! Form::open(['route' => 'postAddProject', 'id' => 'addProjectForm', 'files' => true]) !!}

    <div class="form-group">
            {!! Form::label('name', 'Name') !!}

            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) !!}
            </div>

            <p class="text-danger" id="name-error"></p>
        </div>

        <div class="form-group">
            {!! Form::label('link', 'Link') !!}

            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-external-link"></i></span>
                {!! Form::text('link', old('link'), ['class' => 'form-control', 'id' => 'link', 'placeholder' => 'Link']) !!}
            </div>

            <p class="text-danger" id="link-error"></p>
        </div>

        <div class="form-group">
            {!! Form::label('image', 'Image') !!}

            {!! Form::file('image', ['id' => 'image']) !!}

            <p class="text-danger" id="image-error"></p>
        </div>

        <div class="form-group">
            <button class="btn btn-success" id="project-button">Add</button>
        </div>

{!! Form::close() !!}
   <br />
   <span id="uploaded_image"></span>
  </div>
 </body>
</html>

<script>
var form = $('#postAddProject');
var button = $('#project-button');
var name = $('#name');
var link = $('#link');
var image = $('#image');
var token = $('input[name=_token]');
var message = $('#message');

var name_error = $('#name-error');
var link_error = $('#link-error');
var image_error = $('#image-error');

button.click(function (event){

event.preventDefault();

var formData = new FormData();
formData.append('name', name.val());
formData.append('link', link.val());
formData.append('image', image[0].files[0]); 

$.ajax({
url: form.attr('action'),
method: 'post',
dataType: 'json',
contentType: false,
processData: false,

headers: {
    'X-CSRF-TOKEN': token.val()
},

data: formData,

error: function (data) {

    if (data.status === 422) {

         name_error.html(data.responseJSON.name);
         link_error.html(data.responseJSON.link);
         image_error.html(data.responseJSON.image);

    } else {

         alert('success');
    }
}
</script>