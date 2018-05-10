@extends('layouts.defaultquiz')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3 class="text-center p-2">{{$set->subcategory}}</h3>
                <h4 class="text-center p-2">{{$set->name}}</h4>
            </div>

        </div>
    </div>

    <div class="container question">
        <div class="col-md-8 offset-2">

            <?php
            $i = 1;
            //$str = $set->set;

            $str = implode('\n', $line);
            $rows = sizeof($line);
            $string = trim(preg_replace('/\s\s+/', '\n', $str));?>

            @foreach ($line as $l)
                <?php $array = explode(";", $l); ?>

                @if($language == $set->language1_id)
                    <?php $nr = 0;
                    $nr2 = 1;
                    $dane[$i]['j1'] = $array[0];
                    $dane[$i]['j2'] = $array[1]; ?>
                @else
                    <?php $nr = 1;
                    $nr2 = 0;
                    $dane[$i]['j1'] = $array[1];
                    $dane[$i]['j2'] = $array[0]; ?>
                @endif



                @if($i == 1)

                <div id='question{{$i}}' class='cont'>
                    <div class="card text-center w-50 offset-md-3 my-3 font-weight-bold text-white bg-info"
                         style="line-height: 200px; font-size: 26px;">
                        <p class='questions'>{{$array[$nr]}}</p>
                    </div>
                    <div class="text-center p-1">
                    <button id='ans{{$i}}' class='btn btn-danger spr m-1' type='button'>
                        Odwróć
                    </button><br/>
                    <button id='pre' class='previous btn btn-success m-1' type='button' disabled>
                        Poprzedni
                    </button>
                    <button id='next{{$i}}' class='next btn btn-success m-1' type='button'>
                        Następny
                    </button></div>
                </div>

                <div id='answer{{$i}}' class='cont'>
                    <div class="card text-center w-50 offset-md-3 my-3 font-weight-bold text-white bg-dark"
                         style="line-height: 200px; font-size: 26px;">
                        <p class='answers'>{{$array[$nr2]}}</p>
                    </div>
                    <div class="text-center p-1">
                    <button id='ans{{$i}}' class='btn btn-danger spr m-1' type='button'>
                        Odwróć
                    </button><br/>
                    <button id='pre' class='previous btn btn-success m-1' type='button' disabled>
                        Poprzedni
                    </button>
                    <button id='next{{$i}}' class='next btn btn-success m-1' type='button'>
                        Następny
                    </button>
                    </div>
                </div>

                @elseif($i < 1 || $i < $rows)

                <div id='question{{$i}}' class='cont'>
                    <div class="card text-center w-50 offset-md-3 my-3 font-weight-bold text-white bg-info"
                         style="line-height: 200px; font-size: 26px;">
                        <p class='questions'>{{$array[$nr]}}</p>
                    </div>
                    <div class="text-center p-1">
                    <button id='ans{{$i}}' class='btn btn-danger spr m-1' type='button'>
                        Odwróć
                    </button><br/>
                    <button id='pre{{$i}}' class='previous btn btn-success m-1' type='button'>
                        Poprzedni
                    </button>
                    <button id='next{{$i}}' class='next btn btn-success m-1' type='button'>
                        Następny
                    </button>
                    </div>
                </div>

                <div id='answer{{$i}}' class='cont'>
                    <div class="card text-center w-50 offset-md-3 my-3 font-weight-bold text-white bg-dark"
                         style="line-height: 200px; font-size: 26px;">
                        <p class='answers'>{{$array[$nr2]}}</p>
                    </div>
                    <div class="text-center p-1">
                    <button id='ans{{$i}}' class='btn btn-danger spr m-1' type='button'>
                        Odwróć
                    </button><br/>
                    <button id='pre{{$i}}' class='previous btn btn-success m-1' type='button'>
                        Poprzedni
                    </button>
                    <button id='next{{$i}}' class='next btn btn-success m-1' type='button'>
                        Następny
                    </button>
                    </div>
                </div>

                @elseif($i == $rows)

                <div id='question{{$i}}' class='cont'>
                    <div class="card text-center w-50 offset-md-3 my-3 font-weight-bold text-white bg-info"
                         style="line-height: 200px; font-size: 26px;">
                        <p class='questions'>{{$array[$nr]}}</p>
                    </div>
                    <div class="text-center p-1">
                    <button id='ans{{$i}}' class='btn btn-danger spr m-1' type='button'>
                        Odwróć
                    </button><br/>
                    <button id='pre{{$i}}' class='previous btn btn-success m-1' type='button'>
                        Poprzedni
                    </button>

                    <a href="{{url('/')}}">
                        <button class='next btn btn-success m-1' type='submit'>Zakończ</button>
                    </a></div>
                </div>

                <div id='answer{{$i}}' class='cont'>
                    <div class="card text-center w-50 offset-md-3 my-3 font-weight-bold text-white bg-dark"
                         style="line-height: 200px; font-size: 26px;">
                        <p class='answers'>{{$array[$nr2]}}</p>
                    </div>
                    <div class="text-center p-1">
                    <button id='ans{{$i}}' class='btn btn-danger spr m-1' type='button'>
                        Odwróć
                    </button><br/>
                    <button id='pre{{$i}}' class='previous btn btn-success m-1' type='button'>
                        Poprzedni
                    </button>
                    <a href="{{url('/')}}">
                        <button class='next btn btn-success m-1' type='submit'>Zakończ</button>
                    </a>
                    </div>
                </div>
                    @endif

                <?php  $i++;?>
            @endforeach


        </div>
    </div>

    <div class="pull-left text-center p-3">
        <a class="btn btn-primary" href="{{ url('/') }}"> Wróć</a>
    </div>


    <script>

        var i = 0;
        var data = "<?php echo $string; ?>";
        var lan = '<?php echo $language; ?>';

        var nr = 0;
        if (lan === '1')
            nr = 1;
        else
            nr = 0;

        $('.cont').addClass('hide');
        count = $('.questions').length;
        $('#question' + 1).removeClass('hide');

        $(document).on('click', '.next', function () {
            element = $(this).attr('id');
            last = parseInt(element.substr(element.length - 1));
            nex = last + 1;
            $('#question' + last).addClass('hide');
            $('#answer' + last).addClass('hide');

            $('#question' + nex).removeClass('hide');
        });

        $(document).on('click', '.previous', function () {
            element = $(this).attr('id');
            last = parseInt(element.substr(element.length - 1));
            pre = last - 1;
            $('#question' + last).addClass('hide');
            $('#answer' + last).addClass('hide');

            $('#question' + pre).removeClass('hide');
        });

        $(document).on('click', '.spr', function () {
            element = $(this).attr('id');
            last = parseInt(element.substr(element.length - 1));
            pre = last - 1;
            //$('#answer'+last).addClass('hide');
            //$('#question' + last).addClass('hide');
            if ($('#answer' + last).hasClass('hide')) {
                $('#question' + last).addClass('hide');
                $('#answer' + last).removeClass('hide');
            }
            else {
                $('#question' + last).removeClass('hide');
                $('#answer' + last).addClass('hide');
            }
        });


    </script>

@endsection