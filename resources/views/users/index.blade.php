@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div>
                <h2 class="text-center p-3">Użytkownicy</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <?php $i = 0;?>
    <table class="table table-bordered table-sm">
        <tr>
            <th>Nr</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Email</th>
            <th>Rola</th>
            <th></th>

        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name}}</td>
                <td>{{ $user->surname}}</td>
                <td>{{ $user->email}}</td>
                <td>{{ $user->role}}</td>

                <td>
                    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Pokaż</a>
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edytuj</a>
                    @if($user->role=='admin' ||$user->role=='user')
                        <a class="btn btn-primary disabled" href="{{ route('permissions.edit',$user->id) }}">Nadaj
                            uprawnienia</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('permissions.edit',$user->id) }}">Nadaj
                            uprawnienia</a>
                    @endif
                    @if(!($user->role=='admin'))
                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Usuń', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endif
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