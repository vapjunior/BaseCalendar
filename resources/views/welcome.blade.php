<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calendário</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Ultra&display=swap" rel="stylesheet">

        <!-- Styles -->

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            html, body {
                /* background-color: #3b3935; */
                background-image: url(img/quadronegro.jpg);
                background-size: 100%;
                background-repeat: no-repeat;
                color: #eba134;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                font-family: 'Ultra', normal;
                font-weight: 90;
            }

            .user {
                font-size: 20px;
                font-family: 'Ultra', normal;
                font-weight: 90;
                color: #000;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .thumbnail{
                background-color: #fff;
                font-weight: 90;
                height: 300px;
                color: #000;
            }

            .btn-login{
                border-color: #eba134;
                background-color: #eba134;
                color: #000;
            }

            .btn-login:hover{
                border-color: #eba134;
                background-color: #a67605;
                color: #000;
            }

            .btn-login:active{
                border-color: #eba134;
                background-color: #a67605;
                color: #000;
            }

            .btn-new{
                border-color: #eba134;
                background-color: #adacaa;
                color: #000;
            }

            .btn-new:hover{
                border-color: #eba134;
                background-color: #4a4740;
                color: #000;
            }

            .btn-new:active{
                border-color: #eba134;
                background-color: #4a4740;
                color: #000;
            }


            .welcome-img{
                width: 300px; /* width of container */
                max-height: 150px; /* height of container */
                
            }
        </style>



    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
            <div class="content">

                <div class="row">
                  <div class="col-sm-6 col-md-5 col-md-offset-1">
                    <div class="thumbnail">
                      <img class="welcome-img" src="{{ asset('img/barb2.png') }}" id="barb">
                      <div class="caption">
                        <h3 class="user">Cliente</h3>
                        <!-- <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> -->
                        <p>
                            <a href="{{ route('login') }}" class="btn btn-login" role="button">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-new" role="button">Cadastre-se</a>
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-5">
                    <div class="thumbnail">
                      <!-- <img src="..." alt="..."> -->
                      <img class="welcome-img" src="{{ asset('img/barber3.jpg') }}" id="barber">
                      <div class="caption">
                        <h3 class="user">Barbeiro</h3>
                        <!-- <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> -->
                        <p>
                            <a href="{{ route('barber.login')}}" class="btn btn-login" role="button">Login</a>
                            <!-- <a href="{{ route('barber.register.form')}}" class="btn btn-new" role="button">Cadastre-se</a> -->
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </body>
</html>
