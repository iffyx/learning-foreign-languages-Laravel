@extends('layouts.defaultquiz')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3 class="text-center p-2">{{$set->subcategory}}</h3>
                <h4 class="text-center p-2">{{$set->name}}</h4>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            @if ($language == $set->lan1)
                <th> {{$set->language1}}</th>
                <th>{{$set->language2}}</th>
            @else
                <th>{{$set->language2 }}</th>
                <th> {{ $set->language1}}</th>
            @endif
        </tr>

        @foreach($lines as $l)
            <tr>
                <?php $array = explode(";", $l);?>
                @if ($language == $set->lan1)
                    <td>  {{$array[0]}} </td>
                    <td>  {{$array[1]}} </td>
                @else
                    <td>  {{$array[1]}} </td>
                    <td>  {{$array[0]}} </td>
                @endif
            </tr>
        @endforeach
    </table>

    <div class="pull-left">
        <a class="btn btn-primary" href="{{ url('/') }}"> Wróć</a>
    </div>

@endsection