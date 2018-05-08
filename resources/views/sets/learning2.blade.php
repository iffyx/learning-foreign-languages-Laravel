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
            //$str = $set->set;

            $line = explode(PHP_EOL, $set->set);
            shuffle($line);
            $str=implode('\n', $line);
            $rows = sizeof($line);
            $string = trim(preg_replace('/\s\s+/', '\n', $str));

            foreach ($line as $l){
                $array = explode(";", $l);

                if($language == $set->language1_id)
                    $nr = 0;
                else
                    $nr = 1;
            ?>

            <?php if( $i < $rows){?>

            <div id='question<?php echo $i;?>' class='cont'>
                <p class='questions' id="qname<?php echo $i;?>"><?php echo $i. ". ". $array[$nr];?></p>
                {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                <button id='ans<?php echo $i;?>' class='btn btn-success spr my-3' type='button' onclick="insert()">Sprawdź</button>
                <button id='next<?php echo $i;?>' class='next btn btn-success my-3' type='button' onclick="select()">Następny</button>
            </div>

            <?php }elseif($i == $rows){?>

            <div id='question<?php echo $i;?>' class='cont'>
                <p class='questions' id="qname<?php echo $i;?>"><?php echo $i. ". ". $array[$nr];?></p>
                {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                <button id='ans<?php echo $i;?>' class='btn btn-success spr my-3' type='button' onclick="insert()">Sprawdź</button>
                <a href="{{url('/')}}"><button class='next btn btn-success my-3' type='submit'>Zakończ</button></a>
            </div>

            <?php } $i++;
            } $i=0?>


            <p id="demo">&nbsp;</p>
            <a class="btn btn-primary" href="{{ url('/') }}"> Wróć</a>

        </div>
    </div>


    <script>

        var i=0;
        var data = "<?php echo $string; ?>";
        var res = data.split("\n");
        var lan='<?php echo $language; ?>';

        var nr =0;
        if(lan==='1')
            nr=1;
        else
            nr=0;

        function insert()
        {

            var as = res[i].split(";");
            document.getElementById("demo").innerHTML=as[nr];
            // document.getElementsByClassName('form-control')[i].value;
            if(document.getElementsByClassName('form-control')[i].value==as[nr]){
                document.getElementById("demo").innerHTML="Dobrze!";
                document.getElementById("demo").style.color = "green";
                //result++;
                //document.getElementById("result").innerHTML=result;

            }
            else{
                document.getElementById("demo").innerHTML="Źle! Poprawna odpowiedź to: "+as[nr];
                document.getElementById("demo").style.color = "red";
            }
        }
        function select()
        {
            i++;
            document.getElementById("demo").innerHTML="&nbsp;";
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