@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Edytuj kategorię</h2>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Ups!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($category, ['method' => 'PATCH','route' => ['categories.update', $category->id]]) !!}
    @include('categories.form')
    {!! Form::close() !!}
    <div class="row">
        <div class="col-lg-12 margin-tb">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Wróć</a>

        </div>
    </div>
@endsection