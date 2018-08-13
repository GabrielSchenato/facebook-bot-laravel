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
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
