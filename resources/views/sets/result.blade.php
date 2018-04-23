@extends('layouts.defaultquiz')
@section('content')

    <?php
$line = explode(PHP_EOL, $set->set);
$rows = sizeof($line);
$i = 0;
?>

@foreach($input as $in)
<?php $array = explode(";", $line[$i]);
echo "pl ". $array[0];
?>

    <p>Twoja odp: {{$in}}
<?php
    echo "poprawne ". $array[1];
    $i++;
    ?>
    </p>
@endforeach


{{--
foreach ($line as $l){
$array = explode(";", $l);
echo "poprawne ".$array[1];}
?>
--}}


@endsection