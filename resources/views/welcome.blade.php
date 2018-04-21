<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <title>Nauka słówek</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
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
            /*text-align: center;*/
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            color: black;
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
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Moje konto</a>
            @else
                <a href="{{ route('login') }}">Zaloguj</a>
                <a href="{{ route('register') }}">Zarejestruj</a>
            @endauth
        </div>
    @endif


    <div class="container">
        <div id="accordion">
            <div class="panel-group">
                <div class="panel panel-default">

                    @foreach ($category as $cat)

                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a class="badge badge-info" data-toggle="collapse"
                                   href="#c{{ $cat->id}}">{{ $cat->name}}  {{ $cat->description}}</a>
                            </h3>
                        </div>
                        <div id="c{{ $cat->id}}" class="panel-collapse collapse" data-parent="#accordion">
                            <ul class="list-group">
                                @foreach ($subcategory as $scat)
                                    @if($scat->category_id == $cat->id)
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="badge badge-success" data-toggle="collapse"
                                                   href="#s{{ $scat->id}}">{{ $scat->name}} {{ $scat->description}} {{ $scat->category_id}}</a>
                                            </h4>
                                        </div>
                                        <div id="s{{ $scat->id}}" class="panel-collapse collapse">
                                            <ul class="list-group">
                                                @foreach ($sets as $se)
                                                    @if($scat->id == $se->subcategory_id)
                                                        <h5>
                                                            <a href="{{ route('sets.show',$se->id) }}"
                                                               class="badge badge-warning">{{ $se->name}} {{ $se->subcategory_id}}</a>
                                                        </h5>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        {{--</li>--}}
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
