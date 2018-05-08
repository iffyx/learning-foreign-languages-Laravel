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

            {{--<form method="post" class="form-horizontal">--}}

            <?php
            $i = 1;
            //$str = $set->set;

            $line = explode(PHP_EOL, $set->set);
            shuffle($line);
            $str=implode('\n', $line);
            $rows = sizeof($line);
            $string = trim(preg_replace('/\s\s+/', '\n', $str));

            foreach ($line as $l){
            $array = explode(";", $l);

            if($language == $set->language1_id){
                $nr = 0;
                $nr2 = 1;
                $dane[$i]['j1'] = $array[0];
                $dane[$i]['j2'] = $array[1];
            }
            else{
                $nr = 1;
                $nr2 = 0;
                $dane[$i]['j1'] = $array[1];
                $dane[$i]['j2'] = $array[0];
            }
            ?>


            <?php if($i == 1){?>

            <div id='question<?php echo $i;?>' class='cont'>
                <div class="card text-center w-50 offset-md-3 my-3 font-weight-bold" style="line-height: 200px; font-size: 26px;">
                    <p class='questions'><?php echo $array[$nr];?></p>
                </div>
                <button id='ans<?php echo $i;?>' class='btn btn-success spr' type='button' onclick="insert()">Odwróć</button>
                <button id='next<?php echo $i;?>' class='next btn btn-success active' type='button' onclick="select()">Następny</button>
            </div>

            <div id='answer<?php echo $i;?>' class='cont'>
                <div class="card text-center w-50 offset-md-3 my-3 font-weight-bold" style="line-height: 200px; font-size: 26px;">
                    <p class='answers'><?php echo $array[$nr2];?></p>
                </div>
                <button id='ans<?php echo $i;?>' class='btn btn-success spr' type='button' onclick="insert()">Odwróć</button>
                <button id='next<?php echo $i;?>' class='next btn btn-success active' type='button' onclick="select()">Następny</button>
            </div>

            <?php }elseif($i < 1 || $i < $rows){?>

            <div id='question<?php echo $i;?>' class='cont'>
                <div class="card text-center w-50 offset-md-3 my-3 font-weight-bold" style="line-height: 200px; font-size: 26px;">
                    <p class='questions'><?php echo $array[$nr];?></p>
                </div>
                <button id='ans<?php echo $i;?>' class='btn btn-success spr' type='button' onclick="insert()">Odwróć</button>
                <button id='pre<?php echo $i;?>' class='previous btn btn-success' type='button' onclick="select2()">Poprzedni</button>
                <button id='next<?php echo $i;?>' class='next btn btn-success' type='button' onclick="select()">Następny</button>
            </div>

            <div id='answer<?php echo $i;?>' class='cont'>
                <div class="card text-center w-50 offset-md-3 my-3 font-weight-bold" style="line-height: 200px; font-size: 26px;">
                    <p class='answers'><?php echo $array[$nr2];?></p>
                </div>
                <button id='ans<?php echo $i;?>' class='btn btn-success spr' type='button' onclick="insert()">Odwróć</button>
                <button id='pre<?php echo $i;?>' class='previous btn btn-success' type='button' onclick="select2()">Poprzedni</button>
                <button id='next<?php echo $i;?>' class='next btn btn-success' type='button' onclick="select()">Następny</button>
            </div>

            <?php }elseif($i == $rows){?>

            <div id='question<?php echo $i;?>' class='cont'>
                <div class="card text-center w-50 offset-md-3 my-3 font-weight-bold" style="line-height: 200px; font-size: 26px;">
                    <p class='questions'><?php echo $array[$nr];?></p>
                </div>
                <button id='ans<?php echo $i;?>' class='btn btn-success spr' type='button' onclick="insert()">Odwróć</button>
                <button id='pre<?php echo $i;?>' class='previous btn btn-success' type='button' onclick="select2()">Poprzedni</button>
                <a href="{{url('/')}}"><button class='next btn btn-success' type='submit'>Zakończ</button></a>
            </div>

            <div id='answer<?php echo $i;?>' class='cont'>
                <div class="card text-center w-50 offset-md-3 my-3 font-weight-bold" style="line-height: 200px; font-size: 26px;">
                    <p class='answers'><?php echo $array[$nr2];?></p>
                </div>
                <button id='ans<?php echo $i;?>' class='btn btn-success spr' type='button' onclick="insert()">Odwróć</button>
                <button id='pre<?php echo $i;?>' class='previous btn btn-success' type='button' onclick="select2()">Poprzedni</button>
                <a href="{{url('/')}}"><button class='next btn btn-success' type='submit'>Zakończ</button></a>
            </div>

            <?php } $i++;
            } $i=0?>





        </div>
    </div>

    <div class="pull-left text-center p-3">
        <a class="btn btn-primary" href="{{ url('/') }}"> Wróć</a>
    </div>


    <script>

        var i=0;
        var data = "<?php echo $string; ?>";
        var lan='<?php echo $language; ?>';

        var nr =0;
        if(lan==='1')
            nr=1;
        else
            nr=0;

        function insert()
        {
            /*var as = res[i].split(";");
            document.getElementById("demo").innerHTML=as[nr];
            if(document.getElementsByClassName('form-control')[i].value==as[nr]){
                document.getElementById("demo").innerHTML="Dobrze!";
                document.getElementById("demo").style.color = "green";
            }
            else{
                document.getElementById("demo").innerHTML="Źle! Poprawna odpowiedź to: "+as[nr];
                document.getElementById("demo").style.color = "red";
            }*/
        }
        function select()
        {
            i++;
        }
        function select2()
        {
            i--;
        }


        $('.cont').addClass('hide');
        count = $('.questions').length;
        $('#question' + 1).removeClass('hide');

        $(document).on('click', '.next', function () {
            element = $(this).attr('id');
            last = parseInt(element.substr(element.length - 1));
            nex = last + 1;
            $('#question' + last).addClass('hide');
            $('#answer'+last).addClass('hide');

            $('#question' + nex).removeClass('hide');
        });

        $(document).on('click','.previous',function(){
            element=$(this).attr('id');
            last = parseInt(element.substr(element.length - 1));
            pre=last-1;
            $('#question'+last).addClass('hide');
            $('#answer'+last).addClass('hide');

            $('#question'+pre).removeClass('hide');
        });

        $(document).on('click','.spr',function(){
            element=$(this).attr('id');
            last = parseInt(element.substr(element.length - 1));
            pre=last-1;
            //$('#answer'+last).addClass('hide');
            //$('#question' + last).addClass('hide');
            if($('#answer'+last).hasClass('hide')){
                $('#question' + last).addClass('hide');
                $('#answer'+last).removeClass('hide');
            }
            else{
                $('#question' + last).removeClass('hide');
                $('#answer'+last).addClass('hide');
            }
        });


    </script>

@endsection