<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Joinventure - Log in</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Signika:400" rel="stylesheet">
    <style>
        body{
            margin-top: 50px;
            background-image: url({{asset('img/bg-01-01.jpg')}});
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Signika', sans-serif;
        }
        
        .navFont {
            font-size: 24px;
        }
        
        .buttonRounded {
            border-radius: 25px;
        }

        .cardRadius {
            border-radius: 100px;
        }
      
        .imgThumb {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            max-width: 100%;
            height: auto;
        }
        input{
            margin-bottom: 8px;
        }

        .small-input{
            height: 30px !important;
        }

        .navbar-header {
          float: left;
          padding: 5px;
          text-align: center;
          width: 100%;

        }
        .navbar-brand {float:none;}

        .title{
          padding: 24px;
          text-align: center;
          text-transform: uppercase;
          font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="fixed-top navbar navbar-expand-lg navbar-light bg-light justify-content-between" style="background-color: #fff !important; box-shadow: 0 0.5px 2px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
      <div class="navbar-header">
        <a class="navbar-brand ml-3 mr-5 navFont" href="/"><b style="color: #5c8e2f">JOINVENTURE</b></a>
      </div>
    </nav>


    <div class="container" style="margin-top:150px;"> 
      <div class="card" style="max-width:500px; margin: 0 auto; border-radius: 25px;">

        <div class="col-sm-12 title navFont">
          <h4>Reset password</h4>
        </div>
          
        <div class="col-sm-12" style="margin-bottom: 24px;">

          
            @if(session('status'))
              <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 25px !important;">
              {{session('status')}}

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
          <form action="{{ route('password.request') }}" method="post">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email Address" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="New Password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

            <input type="password" class="form-control{{ $errors->has('password_confirmation') ? '  is-invalid' : '' }}" name="password_confirmation" placeholder="Confirm Password" required>

            @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif

            <button type="submit" class="btn btn-success btn-block" style="border-radius:25px; margin-top:20px;">Reset</button>

            
          </form>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>