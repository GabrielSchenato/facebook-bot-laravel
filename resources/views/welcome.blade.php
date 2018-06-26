<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <link rel="stylesheet" href="{{mix('/css/app.css')}}">

    </head>
    <body class="blue-grey lighten-5">
        <nav id="main-nav">
            <div class="nav-wrapper container-fluid grey darken-4">
                <div class="row">
                    <div class="col s12">
                        <a href="#/" class="brand-logo"><i class="material-icons">chat</i> ChatBot</a>

                        <ul class="right hide-on-med-and-down">
                            <li>
                                <a id="nav-mobile" href="#" data-activates="slide-out" class="menu">
                                    <i class="material-icons">menu</i>
                                </a> 
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        
        <ul id="slide-out" class="side-nav">
            <li>
                <div class="userView">
                    <div class="background">
                        <img src="img/leaf_background.jpg" alt="">
                    </div>
                    <a><img class="circle" src="https://secure.gravatar.com/avatar/4b0f5245bbffa6fde78b6d62b80923f7" alt=""></a>
                    <a><span class="white-text name">Gabriel Schenato</span></a>
                    <a href="https://github.com/schenato"><span class="white-text email">@schenato</span></a>
                </div>
            </li>
        </ul>
        
        <div id="app">
            <div class="preloader-container">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script type="text/javascript">
            $('#nav-mobile').sideNav();
        </script>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
