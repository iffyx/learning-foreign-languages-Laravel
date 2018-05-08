@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center p-3">{{$set->subcategory}} ({{$set->name}})</h2>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <?php if ($language == $set->language1) {
                echo "<th>" . $set->language1 . "</th>";
                echo "<th>" . $set->language2 . "</th>";
            } else {
                echo "<th>" . $set->language2 . "</th>";
                echo "<th>" . $set->language1 . "</th>";
            }
            ?>
        </tr>

        <?php
        $string = $set->set;
        $line = explode(PHP_EOL, $string);
        shuffle($line);
        foreach ($line as $l) {
            echo " <tr>";
            $array = explode(";", $l);
            if ($language == $set->language1) {
                echo "<td>" . $array[0] . "</td>";
                echo "<td>" . $array[1] . "</td>";
            } else {
                echo "<td>" . $array[1] . "</td>";
                echo "<td>" . $array[0] . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <div class="pull-left">
        <a class="btn btn-primary" href="{{ url('/') }}"> Wróć</a>
    </div>

@endsection