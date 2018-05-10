@extends('layouts.defaultquiz')
@section('content')

    <?php
    //use Illuminate\Support\Facades\Auth;
    $line = explode(PHP_EOL, $set->set);
    $number = sizeof($line);
    $rows = sizeof($line);
    $i = 0;
    $result = 0;
    if ($nr == 0)
        $nr2 = 1;
    else
        $nr2 = 0;
    ?>
    <h2>Twoje odpowiedzi: </h2><br/>
    @foreach($input as $in)
        <p>
            <?php $array = explode(";", $line[$i]);?>
            {{$array[$nr]}} - {{$in}}
            <?php
            if ($in == $array[$nr2]) {
                $result++;
                echo " Dobra odpowiedź!";
            } else
                echo "Źle! Poprawnie: " . $array[$nr2];
            $i++;

            ?>
        </p>
    @endforeach

    <p class="font-weight-bold">Udzieliłeś: {{$result}}/{{$number}} poprawnych odpowiedzi</p>
    <p class="font-weight-bold">Twój wynik to:
        <?php $procenty = round(($result / $number) * 100, 2);?>
        {{$procenty}}%
    </p>

    @if (Route::has('login'))
        <?php $ress = [$procenty, Auth::id(), $set->id]?>

        <form action="{{route('results.create')}}">
            <input type="hidden" name="result" value="{{$ress[0]}}">
            <input type="hidden" name="user_id" value="{{$ress[1]}}">
            <input type="hidden" name="set_id" value="{{$ress[2]}}">
            <button class='next btn btn-success m-1' type='submit'>Zakończ</button>
        </form>
    @else
        <a href="{{url('/')}}">
            <button class='next btn btn-success' type='submit'>Zakończ</button>
        </a>
    @endif

@endsection