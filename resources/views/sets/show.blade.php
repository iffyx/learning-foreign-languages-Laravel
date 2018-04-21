@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{$set->name}}</h2>
            </div>

            {{$set->language1}}
            {{$set->language2}}
            {{--            {{$set->set}}--}}

            <?php
            $string = $set->set;
            $line = explode(PHP_EOL, $string);
            shuffle($line);
            foreach ($line as $l) {
                $array = explode(";", $l);
                foreach ($array as $a)
                    echo $a . " ";
                echo "<br//>";
            }

            ?>


        </div>
    </div>

@endsection