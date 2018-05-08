@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Dodaj nową podkategorię</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('subcategories.index') }}"> Anuluj</a>
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
    {!! Form::open(array('route' => 'subcategories.store','method'=>'POST')) !!}
    @include('subcategories.form')
    {!! Form::close() !!}
@endsection