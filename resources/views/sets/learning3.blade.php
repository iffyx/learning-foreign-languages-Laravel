@extends('layouts.defaultquiz')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center p-3">{{$set->name}}</h2>
            </div>
            <div class="pull-left text-center">
                <a class="btn btn-primary" href="{{ url('/') }}"> Wróć</a>
            </div>
        </div>
    </div>

    <div class="container question">
        <div class="col-xs-12 col-sm-8 col-md-8 col-xs-offset-4 col-sm-offset-3 col-md-offset-3">

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
            $dane[$i]['j1'] = $array[0];
            $dane[$i]['j2'] = $array[1];
            ?>

            <?php if($i == 1){?>

            {{--{!! Form::open(array('route' => 'result', 'method'=>'POST')) !!}--}}
            <input type="hidden" name="id" value="{{ $set->id }}"/>
            <div id='question<?php echo $i;?>' class='cont bad'>

                <p class='questions' id="qname<?php echo $i;?>"> <?php echo $i?>.<?php echo $array[0];?></p>
                {{-- {!! Form::text($i, null, array('placeholder'=> $array[0],'class' => 'questions form-control', 'id' => 'qname'.$i,'disabled' => 'disabled')) !!}--}}
                {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                <button id='ans<?php echo $i;?>' class='btn btn-success spr' type='button' onclick="insert()">Spr</button>
                <button id='next<?php echo $i;?>' class='next btn btn-success active' type='button' onclick="select()">Następny</button>
            </div>

            <?php }elseif($i < 1 || $i < $rows){?>

            <div id='question<?php echo $i;?>' class='cont bad'>
                <p><span class="result">aa</span></p>
                <p class='questions' id="qname<?php echo $i;?>"><?php echo $i?>.<?php echo $array[0];?></p>
                {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                <button id='ans<?php echo $i;?>' class='btn btn-success spr' type='button' onclick="insert()">Spr</button>
                <button id='next<?php echo $i;?>' class='next btn btn-success' type='button' onclick="select()">Następny</button>
            </div>

            <?php }elseif($i == $rows){?>

            <div id='question<?php echo $i;?>' class='cont bad'>
                <p><span class="result">aa</span></p>
                <p class='questions' id="qname<?php echo $i;?>"><?php echo $i?>.<?php echo $array[0];?></p>
                {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                <button id='ans<?php echo $i;?>' class='btn btn-success spr' type='button' onclick="insert()">Spr</button>
                <button class='zak btn btn-success' type='submit'>Zakończ</button>
                {{--<button class='zak next btn btn-success' type='button'>Następny</button>--}}
            </div>

            <?php } $i++;
            } $i=0?>

            {{--</form>--}}


            <p id="demo"></p>
            <p id="demo2"></p>


        </div>
    </div>


    <script>

        var i=0;
        var data = "<?php echo $string; ?>";
        var res = data.split("\n");
        var lan='<?php echo $language; ?>';
        var len=res.length;
        const tab = [0, 0, 0, 0, 0, 0, 0];

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

                $('#question' + (i+1)).removeClass('bad');
                $('#question' + (i+1)).addClass('good');
                tab[i]=1;
                //console.log(tab);
            }
            else{
                document.getElementById("demo").innerHTML="Źle! Poprawna odpowiedź to: "+as[nr];
                document.getElementById("demo").style.color = "red";

               // $('#question' + (i+1)).addClass('bad');
                tab[i]=0;
                //console.log(tab);
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
            if($('.cont').hasClass("bad")) {
                $(".result").text("");
                element = $(this).attr('id');
                last = parseInt(element.substr(element.length - 1));
                console.log(last);
                if(last!=len){
                    nex = last + 1;
                    $('#question' + last).addClass('hide');

                    $('#question' + nex).removeClass('hide');
                }
                else{
                    console.log('tu');
                    for(var a=0; a<tab.length; a++) {
                        if(tab[a] === 0){
                            i=a;
                        }

                    }
                }



                console.log(i);
            }
            else
                document.getElementById("demo").innerHTML="ok!";
        });

        $(document).on('click', '.zak', function () {
            $('#question' + count).addClass('hide');

            if($('.cont').hasClass("bad")){
                for(var j=0; j<count;j++){
                    if($('#question'+j).hasClass('bad')){

                        $('#question' + j).removeClass('hide');
                        //i=j-1;
                       //break;
                    }

                }
                // document.getElementById("demo2").innerHTML="bad";
            }
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