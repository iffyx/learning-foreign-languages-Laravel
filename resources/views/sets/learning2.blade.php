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
            $str = implode('\n', $line);
            $rows = sizeof($line);
            $string = trim(preg_replace('/\s\s+/', '\n', $str));?>

            @foreach($line as $l)
                <?php $array = explode(";", $l);?>
                @if ($language == $set->language1_id)
                    <?php $nr = 0?>
                @else
                    <?php $nr = 1?>
                @endif

                @if($i < $rows)
                    <div id='question{{$i}}' class='cont'>
                        <p class='questions' id="qname{{$i}}">{{$i}}. {{$array[$nr]}}</p>
                        {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                        <button id='ans{{$i}}' class='btn btn-success spr my-3' type='button'
                                onclick="insert()">
                            Sprawdź
                        </button>
                        <button id='next{{$i}}' class='next btn btn-success my-3' type='button'
                                onclick="select()">
                            Następny
                        </button>
                    </div>

                @elseif($i == $rows)
                    <div id='question{{$i}}' class='cont'>
                        <p class='questions' id="qname{{$i}}">{{$i}}. {{$array[$nr]}}</p>
                        {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                        <button id='ans{{$i}}' class='btn btn-success spr my-3' type='button'
                                onclick="insert()">
                            Sprawdź
                        </button>
                        <a href="{{url('/')}}">
                            <button class='next btn btn-success my-3' type='submit'>Zakończ</button>
                        </a>
                    </div>
                @endif
                <?php  $i++;?>
            @endforeach

            <p id="demo">&nbsp;</p>
            <a class="btn btn-primary" href="{{ url('/') }}"> Wróć</a>

        </div>
    </div>

    <script>

        var i = 0;
        var data = "<?php echo $string; ?>";
        var res = data.split("\n");
        var lan = '<?php echo $language; ?>';

        var nr = 0;
        if (lan === '1')
            nr = 1;
        else
            nr = 0;

        function insert() {
            var as = res[i].split(";");
            document.getElementById("demo").innerHTML = as[nr];
            if (document.getElementsByClassName('form-control')[i].value == as[nr]) {
                document.getElementById("demo").innerHTML = "Dobrze!";
                document.getElementById("demo").style.color = "green";
            }
            else {
                document.getElementById("demo").innerHTML = "Źle! Poprawna odpowiedź to: " + as[nr];
                document.getElementById("demo").style.color = "red";
                document.getElementById("ans" + (i + 1)).disabled = true;
            }
        }

        function select() {
            i++;
            document.getElementById("demo").innerHTML = "&nbsp;";
        }

        $('.cont').addClass('hide');
        count = $('.questions').length;
        $('#question' + 1).removeClass('hide');

        $(document).on('click', '.next', function () {
            $(".result").text("");
            element = $(this).attr('id');
            last = parseInt(element.substr(element.length - 1));
            nex = last + 1;
            $('#question' + last).addClass('hide');

            $('#question' + nex).removeClass('hide');
        });

    </script>

@endsection