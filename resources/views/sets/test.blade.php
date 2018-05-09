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
            $str = $set->set;
            $line = explode(PHP_EOL, $str);
            $rows = sizeof($line);?>

            @if($rows == 0)
                <p>Ten zestaw nie zawiera zadnych slowek</p>

            @elseif($rows == 1)
                <?php $array = explode(";", $line[0]); ?>
                {!! Form::open(array('route' => 'result', 'method'=>'POST')) !!}
                <input type="hidden" name="id" value="{{ $set->id }}"/>
                <div id='question1' class='cont'>
                    <p class='questions' id="qname1"> {{$i}}. {{$array[0]}}</p>
                    {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                    <button class='next btn btn-success my-3' type='submit'>Zakończ</button>
                </div>

            @else
                @foreach ($line as $l)
                    <?php $array = explode(";", $l); ?>
                    @if ($language == $set->language1_id)
                        <?php $nr = 0; ?>
                    @else
                        <?php $nr = 1; ?>
                    @endif

                    @if($i == 1)
                        {!! Form::open(array('route' => 'result', 'method'=>'POST')) !!}
                        <input type="hidden" name="id" value="{{ $set->id }}"/>
                        <input type="hidden" name="nr" value="{{ $nr }}"/>
                        <div id='question{{$i}}' class='cont'>
                            <p class='questions' id="qname{{$i}}"> {{$i}}. {{$array[$nr]}}</p>
                            {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                            <button id='next{{$i}}' class='next btn btn-success my-3' type='button'>Następny
                            </button>
                        </div>

                    @elseif($i < 1 || $i < $rows)
                        <div id='question{{$i}}' class='cont'>
                            <p class='questions' id="qname{{$i}}">{{$i}}. {{$array[$nr]}}</p>
                            {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                            <button id='next{{$i}}' class='next btn btn-success my-3' type='button'>Następny
                            </button>
                        </div>

                    @elseif($i == $rows)
                        <div id='question{{$i}}' class='cont'>
                            <p class='questions' id="qname{{$i}}">{{$i}}. {{$array[$nr]}}</p>
                            {!! Form::text('odp'.$i, null, array('class' => 'form-control', 'id' => 'ans'.$i)) !!}
                            <button class='next btn btn-success my-3' type='submit'>Zakończ</button>
                        </div>
                    @endif
                    <?php  $i++; ?>
                @endforeach
            @endif
            {!! Form::close() !!}
            <a class="btn btn-primary" href="{{ url('/') }}"> Wróć</a>
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