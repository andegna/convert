<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="assets/images/logo-128x100-62.png" type="image/x-icon">

    <title>ECTS to Modular BDU</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        body {
          padding-top: 40px;
          padding-bottom: 40px;
          background-color: #eee;
        }
        .form-signin {
          max-width: 330px;
          padding: 15px;
          margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
          margin-bottom: 10px;
        }
        .form-signin .checkbox {
          font-weight: normal;
        }
        .form-signin .form-control {
          position: relative;
          height: auto;
          -webkit-box-sizing: border-box;
                  box-sizing: border-box;
          padding: 10px;
          font-size: 16px;
        }
        .form-signin .form-control:focus {
          z-index: 2;
        }
        .form-signin input[type="text"] {
          margin-bottom: -1px;
          border-bottom-right-radius: 0;
          border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
          margin-bottom: 10px;
          border-top-left-radius: 0;
          border-top-right-radius: 0;
        }
    </style>
  </head>

  <body>

    <?php

      //dd(get_defined_vars());

    ?>

    <div class="container">
      {!! Form::open(['url'=>'crawler', 'method'=>'POST', 'class'=>'form-signin']) !!}
        <h2 class='form-signin-heading'>Please Login</h2>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label for='username' class='sr-only'>Username</label>
        {!! Form::text('username', null, ['class'=>'form-control', 'placeholder'=>'Username (eg. BDU04*****UR)', 'required'=>'required', 'autofocus'=>'autofocus']) !!}

        <label for='inputPassword' class='sr-only'>Password</label>
        {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password from SIMS', 'required'=>'required']) !!}

        {!! app('captcha')->display(); !!}

        <br />
        <button class='btn btn-lg btn-primary btn-block' type='submit'>Sign in</button>
      {!! Form::close() !!}
    </div>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>
</body>
</html>
