@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Edytuj podkategorię</h2>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Ups!</strong> Wystąpiły problemy.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($subcategory, ['method' => 'PATCH','route' => ['subcategories.update', $subcategory->id]]) !!}
    @include('subcategories.form')
    {!! Form::close() !!}
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <a class="btn btn-primary" href="{{ route('subcategories.index') }}"> Wróć</a>
        </div>
    </div>
@endsection