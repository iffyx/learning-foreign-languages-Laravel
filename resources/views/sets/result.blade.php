@extends('layouts.defaultquiz')
@section('content')

    <?php

    use Illuminate\Support\Facades\Auth;
    $line = explode(PHP_EOL, $set->set);
    $number = sizeof($line);
    $rows = sizeof($line);
    $i = 0;
    $result = 0;
    if($nr==0)
        $nr2=1;
    else
        $nr2=0;
    ?>
<h2>Twoje odpowiedzi: </h2>
    @foreach($input as $in)
        <p>
        <?php $array = explode(";", $line[$i]);
            echo $array[$nr];
        ?>

       - {{$in}}
            <?php
            if ($in == $array[$nr2]){
                $result++;
                echo " Dobra odpowiedź!";
            }
            else
                echo "poprawne " . $array[$nr2];
            $i++;

            ?>
        </p>
    @endforeach


    <p>Udzieliłeś: {{$result}}/{{$number}} poprawnych odpowiedzi</p>
    <p>Twój wynik to: <?php $procenty = round(($result/$number)*100,2);
    echo $procenty."%";
        ?>
    </p>

    @if (Route::has('login'))

        <?php
        $userId = Auth::id();
        $ress = [$procenty, $userId, $set->id]?>

        <form action="{{route('results.create')}}">


            <input type="hidden" name="result" value="{{$ress[0]}}">
            <input type="hidden" name="user_id" value="{{$ress[1]}}">
            <input type="hidden" name="set_id" value="{{$ress[2]}}">

            <input type="submit" value="Zakończ">
        </form>
    @else
        <a href="{{url('/')}}">
            <button class='next btn btn-success' type='submit'>Zakończ</button>
        </a>

    @endif

    {{--
    foreach ($line as $l){
    $array = explode(";", $l);
    echo "poprawne ".$array[1];}
    ?>
    --}}


@endsection