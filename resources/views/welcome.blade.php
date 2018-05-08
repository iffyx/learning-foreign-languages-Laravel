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
            /*color: #636b6f;*/
            color: #000000;
            /*font-family: 'Raleway', sans-serif;*/
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
        .container{
            color:#000000;
            width: 700px;
        }

        .links  a {
            /*color: #636b6f;*/
            color: black !important;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        a{
            color:black;
            text-decoration: none;
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


    <div class="container col-6">
        <div id="accordion">
            <div class="panel-group">
                <div class="panel panel-default">
                    <ul class="list-group list-group-flush">
                    @foreach ($category as $cat)
<li class="list-group-item">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="" style="text-decoration: none;" data-toggle="collapse"
                                   href="#c{{ $cat->id}}">{{ $cat->name}} </a>
                            </h4>
                        </div>
                        <div id="c{{ $cat->id}}" class="panel-collapse collapse" data-parent="#accordion">
                            <ul class="list-group list-group-flush">
                                @foreach ($subcategory as $scat)
                                    @if($scat->category_id == $cat->id)
                                        <li class="" style="list-style-type: square" >
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                <a class="list-group-item" data-toggle="collapse"
                                                   href="#s{{ $scat->id}}">{{ $scat->name}}</a>
                                            </h5>
                                        </div>
                                        <div id="s{{ $scat->id}}" class="panel-collapse collapse">
                                            <ul>
                                                @foreach ($sets as $set)
                                                    @if($scat->id == $set->subcategory_id)
                                                        <h6>
                                                            <strong>{{ $set->name}}</strong><br>
                                                            {{$set->language1}} -> {{$set->language2}}

                                                            <strong><a href="{{ route('learning1',[$set->id, $set->language1_id]) }}">nauka 1&nbsp;</a></strong>
                                                            <strong><a href="{{ route('learning2',[$set->id, $set->language1_id]) }}">nauka 2&nbsp;</a></strong>
                                                            <strong><a href="{{ route('learning3',[$set->id, $set->language1_id]) }}">nauka 3&nbsp;</a></strong>
                                                            <strong><a href="{{ route('learning4',[$set->id, $set->language1_id]) }}">nauka 4&nbsp;</a></strong>
                                                            <strong><a href="{{ route('test',[$set->id, $set->language1_id]) }}">test</a></strong>
                                                            <br>
                                                            {{$set->language2}} -> {{$set->language1}}
                                                            <strong><a href="{{ route('learning1',[$set->id, $set->language2_id]) }}">nauka 1&nbsp;</a></strong>
                                                            <strong><a href="{{ route('learning2',[$set->id, $set->language2_id]) }}">nauka 2&nbsp;</a></strong>
                                                            <strong><a href="{{ route('learning3',[$set->id, $set->language2_id]) }}">nauka 3&nbsp;</a></strong>
                                                            <strong><a href="{{ route('learning4',[$set->id, $set->language2_id]) }}">nauka 4&nbsp;</a></strong>
                                                            <strong><a href="{{ route('test',[$set->id, $set->language2_id]) }}">test</a></strong>
                                                        </h6>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        </li>
                                        {{--</li>--}}
                                    @endif
                                @endforeach
                            </ul>
                        </div>
</li>
                    @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>

        <div class="col-4 font-weight-normal">
            <p>Dostępne tryby nauki:</p>
            <ul>
                <li>nauka 1 - wyświetlenie wszystkich słówek</li>
                <li>nauka 2 - odpytywanie (raz na słówko)</li>
                <li>nauka 3 - odpytywanie (do poprawnej odpowiedzi)</li>
                <li>nauka 4 - fiszki</li>
            </ul>
        </div>


</div>

</body>
</html>
