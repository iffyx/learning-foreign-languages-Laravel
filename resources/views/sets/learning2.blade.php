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

        if($rows == 0){?>
        <p>Ten zestaw nie zawiera zadnych slowek</p>

        <?php
        }elseif($rows == 1){
        $array = explode(";", $line[0]);
        ?>
        {!! Form::open(array('route' => 'result', 'method'=>'POST')) !!}
        <input type="hidden" name="id" value="{{ $set->id }}"/>
        <div id='question1' class='cont'>
            <p class='questions' id="qname1"> <?php echo $i?>.<?php echo $array[0];?></p>
            {{-- {!! Form::text($i, null, array('placeholder'=> $array[0],'class' => 'questions form-control', 'id' => 'qname'.$i,'disabled' => 'disabled')) !!}--}}
            {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
            <button class='next btn btn-success' type='submit'>Zakończ</button>
        </div>

        <?php
        }else{
        foreach ($line as $l){
        $array = explode(";", $l); ?>

        <?php if($i == 1){?>
        {!! Form::open(array('route' => 'result', 'method'=>'POST')) !!}
        <input type="hidden" name="id" value="{{ $set->id }}"/>
        <div id='question<?php echo $i;?>' class='cont'>
            <p class='questions' id="qname<?php echo $i;?>"> <?php echo $i?>.<?php echo $array[0];?></p>
            {{-- {!! Form::text($i, null, array('placeholder'=> $array[0],'class' => 'questions form-control', 'id' => 'qname'.$i,'disabled' => 'disabled')) !!}--}}
            {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
            <button class='previous btn btn-success disabled' type='button' name='answ<?php echo $i;?>'>Poprzedni
            </button>
            <button id='next<?php echo $i;?>' class='next btn btn-success active' type='button'>Następny</button>
        </div>

        <?php }elseif($i < 1 || $i < $rows){?>

        <div id='question<?php echo $i;?>' class='cont'>
            <p class='questions' id="qname<?php echo $i;?>"><?php echo $i?>.<?php echo $array[0];?></p>
            {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
            <button id='pre<?php echo $i;?>' class='previous btn btn-success' type='button'>Poprzedni</button>
            <button id='next<?php echo $i;?>' class='next btn btn-success' type='button'>Następny</button>
        </div>

        <?php }elseif($i == $rows){?>
        <div id='question<?php echo $i;?>' class='cont'>
            <p class='questions' id="qname<?php echo $i;?>"><?php echo $i?>.<?php echo $array[0];?></p>
            {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
            <button id='pre<?php echo $i;?>' class='previous btn btn-success' type='button'>Poprzedni</button>
            <button class='next btn btn-success' type='submit'>Zakończ</button>
        </div>

        <?php } $i++; }
        } ?>
        {!! Form::close() !!}
        {{--</form>--}}

    </div>
</div>


<script>
    $('.cont').addClass('hide');
    count = $('.questions').length;
    $('#question' + 1).removeClass('hide');

    $(document).on('click', '.next', function () {
        element = $(this).attr('id');
        last = parseInt(element.substr(element.length - 1));
        nex = last + 1;
        $('#question' + last).addClass('hide');

        $('#question' + nex).removeClass('hide');
    });

    $(document).on('click', '.previous', function () {
        element = $(this).attr('id');
        last = parseInt(element.substr(element.length - 1));
        pre = last - 1;
        $('#question' + last).addClass('hide');

        $('#question' + pre).removeClass('hide');
    });

</script>

@endsection