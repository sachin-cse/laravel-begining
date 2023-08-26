<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css" rel="stylesheet">
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



    <title>Registration form</title>
  </head>
  <body>
<!--   
    @if(session('status'))
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('status') }}
</div>
@elseif(session('failed'))
<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('failed') }}
</div>
@endif -->



    <form action="{{url('/')}}/register" method="post" enctype="multipart/form-data">
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
        <label for="name">Sender Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
        <span class="text-danger">
        @error('name')
          <script>
            toastr.error("{{ $message }}", "Error", {"closeButton" : true, "timeOut": "5000"});
          </script>
        @enderror
        </span>
    </div>

    <div class="form-group">
        <label for="email"> Receipent Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
<span class="text-danger">
    @error('email')
    <script>
    toastr.error("{{$message}}", "Error", {"closeButton" : true, "timeOut": "5000"});
    </script>
    @enderror
</span>
    </div>

    <!-- file attachment -->
    <div class="form-group">
        <label for="attachment">Attachment:</label>
        <input type="file" class="form-control-file" id="attachment" name="attachment">
<span class="text-danger">
    @error('attachment')
    <script>
    toastr.error("{{$message}}", "Error", {"closeButton" : true, "timeOut": "5000"})
    </script> 
    @enderror
</span>
    </div>

    <div class="form-group">
        <label for="message">Message:</label>
        <textarea class="form-control" id="msg" name="msg" rows="4" cols="50">{{old('msg')}}</textarea>
<span class="text-danger">
    @error('attachment')
    <script>
    toastr.error("{{$message}}", "Error", {"closeButton" : true, "timeOut": "5000"})
    </script> 
    @enderror
</span>
    </div>


    <button class="btn btn-primary">Submit</button>
    </div>
</form>

<script>
    @if(Session::has('status'))
    toastr.options =
  {
  	"closeButton" : true,
    "timeOut": "5000"

  }
    toastr.success("{{session('status')}}");
    @elseif(Session::has('falied'))
    toastr.options =
  {
  	"closeButton" : true
    "timeOut": "5000"

  }
  toastr.error("{{session('failed')}}");
  @endif
    </>

  </body>
</html>