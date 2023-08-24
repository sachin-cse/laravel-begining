<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Registration form</title>
  </head>
  <body>
    @if(session('status'))
<div class="alert alert-success" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('status') }}
</div>
@elseif(session('failed'))
<div class="alert alert-success" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('failed') }}
</div>
@endif


    <form action="{{url('/')}}/register" method="post">
        @csrf

        <!-- <pre>
        @php
          print_r($errors->all());
        @endphp
       </pre> -->
    <div class="container">
        <h1 class="text-center">
            Registration
        </h1>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
        <span class="text-danger">
            @error('name')
            {{$message}}
            @enderror
        </span>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
<span class="text-danger">
    @error('email')
    {{$message}}
    @enderror
</span>
    </div>

    <div class="form-group">
        <label for="pass">Password:</label>
        <input type="password" class="form-control" id="pass" name="pass">
<span class="text-danger">
    @error('pass')
    {{$message}} 
    @enderror
</span>
    </div>

    <button class="btn btn-primary">Submit</button>
    </div>
</form>
  </body>
</html>