@extends('layouts.defaultquiz')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center p-3">{{$set->name}}</h2>
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

            @foreach ($line as $l)
                <?php $array = explode(";", $l); ?>
                @if ($language == $set->language1_id)
                    <?php $nr = 0;
                    $nra = 1; ?>
                @else
                    <?php $nr = 1;
                    $nra = 0; ?>
                @endif

                <input type="hidden" name="id" value="{{ $set->id }}"/>
                <div id='question{{$i}}' class='cont p'>
                    <span class='questions' id="qname{{$i}}"> {{$i}} {{$array[$nr]}}</span>
                    <span class='answers' id="aname{{$i}}">{{$array[$nra]}}</span>
                    {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                </div>

                <?php  $i++;?>
            @endforeach
            <button class='zak btn btn-success' type='submit' onclick="spr()">Sprawdź</button>
            <button class='btn btn-success ok' type='submit' onclick="ok()">Ok!</button>
            <p id="demo"></p>

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <a class="btn btn-primary" href="{{ url('/') }}"> Wróć</a>
                </div>
            </div>

        </div>
    </div>

    <script>

        var i = 0;
        var data = "<?php echo $string; ?>";
        var res = data.split("\n");
        var lan = '<?php echo $language; ?>';
        var len = res.length;

        var nr = 0;
        if (lan === '1')
            nr = 1;
        else
            nr = 0;

        function spr() {
            for (var i = 0; i < len; i++) {
                var as = res[i].split(";");
                if (document.getElementsByClassName('form-control')[i].value == as[nr]) {
                    $('#aname' + (i + 1)).removeClass('hide');
                    document.getElementById("aname" + (i + 1)).innerHTML = 'Dobrze';
                }
                else {
                    $('#aname' + (i + 1)).removeClass('hide');
                }
                document.getElementById("ans" + (i + 1)).disabled = true;

            }
            $('.ok').removeClass('hide');
        }

        function ok() {

            for (var i = 0; i < len; i++) {
                var as = res[i].split(";");
                if (document.getElementsByClassName('form-control')[i].value == as[nr]) {
                    $('#aname' + (i + 1)).addClass('hide');
                    $('#question' + (i + 1)).addClass('hide');
                    $('#question' + (i + 1)).removeClass('p');
                }
                else {
                    $('#aname' + (i + 1)).addClass('hide');
                }
                document.getElementById("ans" + (i + 1)).value = '';
                document.getElementById("ans" + (i + 1)).disabled = false;
            }
            $('.ok').addClass('hide');

            if (!($('.cont').hasClass("p"))) {
                $('.zak').addClass('hide');
                document.getElementById("demo").innerHTML = 'Wszystkie odpowiedzi poprawne!';
            }
        }

        // $('.cont').addClass('hide');
        $('.answers').addClass('hide');
        $('.ok').addClass('hide');
    </script>

@endsection