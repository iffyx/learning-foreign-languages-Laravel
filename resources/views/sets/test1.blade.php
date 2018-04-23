@extends('layouts.defaultquiz')
@section('content')

    <div class="container question">
        <div class="col-xs-12 col-sm-8 col-md-8 col-xs-offset-4 col-sm-offset-3 col-md-offset-3">

            {{--<form method="post" class="form-horizontal">--}}

            <?php
            $i = 1;
            $str = $set->set;

            $line = explode(PHP_EOL, $str);
            $rows = sizeof($line);
            $string = trim(preg_replace('/\s\s+/', '\n', $str));

            foreach ($line as $l){
            $array = explode(";", $l);
            $dane[$i]['j1'] = $array[0];
            $dane[$i]['j2'] = $array[1];
            ?>

            <?php if($i == 1){?>

            {!! Form::open(array('route' => 'result', 'method'=>'POST')) !!}
            <input type="hidden" name="id" value="{{ $set->id }}"/>
            <div id='question<?php echo $i;?>' class='cont'>

                <p class='questions' id="qname<?php echo $i;?>"> <?php echo $i?>.<?php echo $array[0];?></p>
                {{-- {!! Form::text($i, null, array('placeholder'=> $array[0],'class' => 'questions form-control', 'id' => 'qname'.$i,'disabled' => 'disabled')) !!}--}}
                {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                <button id='ans<?php echo $i;?>' class='btn btn-success spr' type='button' onclick="insert()">Spr</button>
                <button id='next<?php echo $i;?>' class='next btn btn-success active' type='button' onclick="select()">Następny</button>
            </div>

            <?php }elseif($i < 1 || $i < $rows){?>

            <div id='question<?php echo $i;?>' class='cont'>
                <p><span class="result">aa</span></p>
                <p class='questions' id="qname<?php echo $i;?>"><?php echo $i?>.<?php echo $array[0];?></p>
                {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                <button id='ans<?php echo $i;?>' class='btn btn-success spr' type='button' onclick="insert()">Spr</button>
                <button id='next<?php echo $i;?>' class='next btn btn-success' type='button' onclick="select()">Następny</button>
            </div>

            <?php }elseif($i == $rows){?>

            <div id='question<?php echo $i;?>' class='cont'>
                <p><span class="result">aa</span></p>
                <p class='questions' id="qname<?php echo $i;?>"><?php echo $i?>.<?php echo $array[0];?></p>
                {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                <button id='ans<?php echo $i;?>' class='btn btn-success spr' type='button' onclick="insert()">Spr</button>
                <button class='next btn btn-success' type='submit'>Zakończ</button>
            </div>

            <?php } $i++;
            } $i=0?>
            {!! Form::close() !!}
            {{--</form>--}}


            <p id="demo"></p>
            <p id="result">0</p>


        </div>
    </div>


    <script>

        var i=0;
        var data = "<?php echo $string; ?>";
        var res = data.split("\n");
        var result=0;

        function insert()
        {

            var as = res[i].split(";");
            document.getElementById("demo").innerHTML=as[1];
                // document.getElementsByClassName('form-control')[i].value;
            if(document.getElementsByClassName('form-control')[i].value==as[1]){
                document.getElementById("demo").innerHTML="correct!";
                document.getElementById("demo").style.color = "green";
                result++;
                document.getElementById("result").innerHTML=result;

            }
            else{
                document.getElementById("demo").innerHTML="incorrect!";
                document.getElementById("demo").style.color = "red";
            }
        }
        function select()
        {
            i++;
            document.getElementById("demo").innerHTML="";
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

       /* $(document).on('click', '.spr', function () {
            element = $(this).attr('id');
            last = parseInt(element.substr(element.length - 1));
            pre = last - 1;
            $('#question' + last).addClass('hide');

            $('#question' + pre).removeClass('hide');
        });*/

    </script>

@endsection