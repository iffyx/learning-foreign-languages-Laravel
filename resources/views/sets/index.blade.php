@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Zestaw</h2>
            </div>
            <div class="text-center p-3">
                <a class="btn btn-success" href="{{ route('sets.create') }}"> Stwórz nowy zestaw</a>
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
            <th>jezyk1</th>
            <th>jezyk2</th>
            <th>zestaw</th>
            <th>podkategoria</th>
            <th></th>
        </tr>

        @if(Auth::user()->hasRole('admin'))
            @foreach ($sets as $set)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $set->name}}</td>
                    <td>{{ $set->language1}}</td>
                    <td>{{ $set->language2}}</td>
                    <td>{{ $set->set}}</td>
                    <td>{{ $set->subcategory}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('sets.edit',$set->id) }}">Edytuj</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['sets.destroy', $set->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Usuń', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @elseif(Auth::user()->hasRole('superredaktor'))
            @foreach($permission as $perm)
                @foreach ($sets as $set)
                    @if($perm->subcategory_id==$set->subid)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $set->name}}</td>
                            <td>{{ $set->language1}}</td>
                            <td>{{ $set->language2}}</td>
                            <td>{{ $set->set}}</td>
                            <td>{{ $set->subcategory}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('sets.edit',$set->id) }}">Edytuj</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['sets.destroy', $set->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Usuń', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        @elseif(Auth::user()->hasRole('redaktor'))
            @foreach($permission as $perm)
                @foreach ($sets as $set)
                    @if($perm->subcategory_id==$set->subid and $set->user_id==Auth::id())
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $set->name}}</td>
                            <td>{{ $set->language1}}</td>
                            <td>{{ $set->language2}}</td>
                            <td>{{ $set->set}}</td>
                            <td>{{ $set->subcategory}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('sets.edit',$set->id) }}">Edytuj</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['sets.destroy', $set->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Usuń', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        @endif
    </table>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <a class="btn btn-primary" href="{{ route('home') }}"> Wróć</a>
        </div>
    </div>


@endsection