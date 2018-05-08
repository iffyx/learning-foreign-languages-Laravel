@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Dodaj nowy zestaw</h2>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            {{--<strong>Ups!</strong> There were some problems with your input.<br><br>--}}
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open(array('route' => 'sets.store','method'=>'POST')) !!}
    @include('sets.form')
    {!! Form::close() !!}
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <a class="btn btn-primary" href="{{ route('sets.index') }}"> Anuluj</a>
        </div>
    </div>



@endsection