<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Joinventure - Log in or Sign up</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Signika:400" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/line-awesome.min.css') }}">
    <style>
        body{
            margin-top: 50px;
            background-image: url({{asset('img/bg-01-01.jpg')}});
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
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
            border-radius: 25px !important;
        }

        .small-input{
            height: 30px !important;
        }
        .sk-folding-cube {
          margin: 20px auto;
          width: 40px;
          height: 40px;
          position: relative;
          -webkit-transform: rotateZ(45deg);
                  transform: rotateZ(45deg);
        }

        .sk-folding-cube .sk-cube {
          float: left;
          width: 50%;
          height: 50%;
          position: relative;
          -webkit-transform: scale(1.1);
              -ms-transform: scale(1.1);
                  transform: scale(1.1); 
        }
        .sk-folding-cube .sk-cube:before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: #5c8e2f;
          -webkit-animation: sk-foldCubeAngle 2.4s infinite linear both;
                  animation: sk-foldCubeAngle 2.4s infinite linear both;
          -webkit-transform-origin: 100% 100%;
              -ms-transform-origin: 100% 100%;
                  transform-origin: 100% 100%;
        }
        .sk-folding-cube .sk-cube2 {
          -webkit-transform: scale(1.1) rotateZ(90deg);
                  transform: scale(1.1) rotateZ(90deg);
        }
        .sk-folding-cube .sk-cube3 {
          -webkit-transform: scale(1.1) rotateZ(180deg);
                  transform: scale(1.1) rotateZ(180deg);
        }
        .sk-folding-cube .sk-cube4 {
          -webkit-transform: scale(1.1) rotateZ(270deg);
                  transform: scale(1.1) rotateZ(270deg);
        }
        .sk-folding-cube .sk-cube2:before {
          -webkit-animation-delay: 0.3s;
                  animation-delay: 0.3s;
        }
        .sk-folding-cube .sk-cube3:before {
          -webkit-animation-delay: 0.6s;
                  animation-delay: 0.6s; 
        }
        .sk-folding-cube .sk-cube4:before {
          -webkit-animation-delay: 0.9s;
                  animation-delay: 0.9s;
        }
        @-webkit-keyframes sk-foldCubeAngle {
          0%, 10% {
            -webkit-transform: perspective(140px) rotateX(-180deg);
                    transform: perspective(140px) rotateX(-180deg);
            opacity: 0; 
          } 25%, 75% {
            -webkit-transform: perspective(140px) rotateX(0deg);
                    transform: perspective(140px) rotateX(0deg);
            opacity: 1; 
          } 90%, 100% {
            -webkit-transform: perspective(140px) rotateY(180deg);
                    transform: perspective(140px) rotateY(180deg);
            opacity: 0; 
          } 
        }

        @keyframes sk-foldCubeAngle {
          0%, 10% {
            -webkit-transform: perspective(140px) rotateX(-180deg);
                    transform: perspective(140px) rotateX(-180deg);
            opacity: 0; 
          } 25%, 75% {
            -webkit-transform: perspective(140px) rotateX(0deg);
                    transform: perspective(140px) rotateX(0deg);
            opacity: 1; 
          } 90%, 100% {
            -webkit-transform: perspective(140px) rotateY(180deg);
                    transform: perspective(140px) rotateY(180deg);
            opacity: 0; 
          }
        }

        .overlay{
            opacity:0.8;
            background-color:#000  ;
            position:fixed;
            width:100%;
            height:100%;
            top:0px;
            left:0px;
            z-index:1000;
        }
    </style>
</head>
<body>
    <div class="" id="loader">
        
    </div>

    <nav class="fixed-top navbar navbar-expand-lg navbar-light bg-light justify-content-between" style="background-color: #fff !important; box-shadow: 0 0.5px 2px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <a class="navbar-brand ml-3 mr-5 navFont" href="#"><b style="color: #5c8e2f">JOINVENTURE</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mr-3" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">    
            </ul>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                       <input name="email_log" class="form-control small-input {{ $errors->has('email_log') ? ' is-invalid' : '' }}" type="email" placeholder="E-mail" value="{{ old('email_log') }}" required autofocus> 
                    </div>
                    <div class="col">
                       <input name="password" class="form-control small-input {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Password" required autofocus> 
                    </div>
                    <button class="btn btn-success btn-sm pl-4 pr-4 buttonRounded" type="submit">Login</button>
                    <div class="w-100"></div>
                    <div class="col"> 
                       <a href="#" style="font-size: 12px">Forgot Your Password?</a>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" style="font-size: 12px;"  for="remember">Remember Me</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </nav>


    <div class="d-flex justify-content-end mx-5" style="margin-top: 100px;">

        <div style="position: relative;" id="loading">
            
        </div>
        

        <div class="card" style="width: 27rem; border-radius: 25px !important;">
            <div class="cardRadius card-body">
                <h4 class="card-title text-center"><b>JOIN FOR FREE!</b></h4>
                <br>
                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <input type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required autofocus>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <input type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" aria-describedby="emailHelp" placeholder="Email Address" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>

                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" class="form-control {{ $errors->has('birthday') ? ' is-invalid' : '' }}" name="birthday" required value="{{ old('birthday') }}" id="birthday">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <input type="radio" name="gender" value="1" required><span class="la la-male" style="font-size: 30px"></span> Male    
                        </div>
                        
                        <div class="col-md-4">
                            <input type="radio" name="gender" value="0"><span class="la la-female" style="font-size: 30px"></span> Female    
                        </div>
                        
                    </div>

                    <button class="buttonRounded btn btn-success btn-lg btn-block" type="submit" onclick="">Create Account</button>
                </form>
                
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        function loading(){
            var first_name = $('#first_name').val();
            var load = "<div class='sk-folding-cube'><div class='sk-cube1 sk-cube'></div><div class='sk-cube2 sk-cube'></div><div class='sk-cube4 sk-cube'></div><div class='sk-cube3 sk-cube'></div></div><p style='color: #fff;'>Please wait while we are sending you a verification email</p>";
            if(first_name != ""){
                $('#loader').append(load);
                $('#loader').attr('class', 'overlay');
            }
            
        }
    </script>
</body>
</html>