@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Podkategoria</h2>
            </div>
            <div class="text-center p-3">
                <a class="btn btn-success" href="{{ route('subcategories.create') }}"> Stwórz nową podkategorię</a>
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
            <th>kategoria</th>
            <th></th>
        </tr>
        @foreach ($subcategories as $subcategory)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $subcategory->name}}</td>
                <td>{{ $subcategory->description}}</td>
                <td>{{ $subcategory->catname}}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('subcategories.edit',$subcategory->id) }}">Edytuj</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['subcategories.destroy', $subcategory->id],'style'=>'display:inline']) !!}
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