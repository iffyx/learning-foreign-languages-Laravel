@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Kategoria</h2>
            </div>
            <div class="text-center p-3">
                <a class="btn btn-success" href="{{ route('categories.create') }}"> Stwórz nową kategorię</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Nr</th>
            <th>nazwa</th>
            <th>opis</th>
            <th></th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $category->name}}</td>
                <td>{{ $category->description}}</td>

                <td>
                    <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Edytuj</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $category->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Usuń', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <a class="btn btn-primary" href="{{ route('home') }}"> Wróć</a>
        </div>
    </div>

@endsection