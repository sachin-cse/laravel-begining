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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>





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
        {{-- <input type="email"  class="form-control" id="email" name="email" value="{{old('email')}}"> --}}
        <select class="form-control select2" id="email" name="email">
          <option value="">Select an email</option>
          @foreach($emails as $email)
          <option value="{{$email}}">{{$email}}</option>
          @endforeach
          <option value="other">Choose Other Email</option>
        </select>
        <input type="email" class="form-control mt-2" id="other_email" name="other_email" placeholder="Enter a new email address" style="display: none;">

        
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
    @error('msg')
    <script>
    toastr.error("{{$message}}", "Error", {"closeButton" : true, "timeOut": "5000"})
    </script> 
    @enderror
</span>
    </div>

    {{-- captcha --}}

    <div class="form-group">
      <div class="captcha">
      <span>{!! captcha_img('math') !!}</span>
      <button type="button" class="btn btn-danger reload" id="reload">
        &#x21bb;
      </button>
      {{-- <label for="message">Message:</label>
      <textarea class="form-control" id="msg" name="msg" rows="4" cols="50">{{old('msg')}}</textarea>
<span class="text-danger">
  @error('attachment')
  <script>
  toastr.error("{{$message}}", "Error", {"closeButton" : true, "timeOut": "5000"})
  </script> 
  @enderror
</span> --}}
</div>
</div>

<div class="form-group">
  <input type="text" class="form-control" placeholder="enter captcha" name="captcha">
  <span class="text-danger">
    @error('captcha')
    <script>
    toastr.error("Inavalid captcha", "Error", {"closeButton" : true, "timeOut": "5000"})
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
    </script>

    <script>
      $('#reload').click(function(){
        $.ajax({
          type:'GET',
          url:'reload-captcha',
          success:function(data){
            $(".captcha span").html(data.captcha)
          }
        });
      });


    function toggleOtherEmailInput() {
        var selectedOption = $('#email option:selected').val();
        if (selectedOption === 'other') {
            $('#other_email').show();
            $('#other_email').prop('disabled', false); // Enable the input field
        } else {
            $('#other_email').hide();
            $('#other_email').prop('disabled', true); // Disable the input field
        }
    }

    $(document).ready(function () {
        toggleOtherEmailInput(); // Initial setup
        $('#email').change(function () {
            toggleOtherEmailInput(); // Handle changes
        });
    });
      </script>



<script>
  // Function to show/hide the input field based on the selected option
  function toggleOtherEmailInput() {
    var selectedOption = $('#email option:selected');
    if (selectedOption.val() === 'other') {
      $('#other_email').show();
      $('#other_email').attr('name', 'other_email'); // Change the input field name
    } else {
      $('#other_email').hide();
      $('#other_email').removeAttr('name'); // Remove the input field name
    }
  }

  // Execute the function when the page loads and when the select field changes
  $(document).ready(function () {
    toggleOtherEmailInput(); // Initial setup
    $('#email').change(function () {
      toggleOtherEmailInput(); // Handle changes
    });
  });
</script>

  </body>
</html>