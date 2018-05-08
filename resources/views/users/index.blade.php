@extends('layouts.default')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Role</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('roles.create') }}"> Stwórz nową rolę</a>
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
            <th>rola</th>
            <th>opis</th>
            <th></th>

        </tr>
        @foreach ($roles as $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name}}</td>
                <td>{{ $role->description}}</td>

               {{-- <td>
                    --}}{{--<a class="btn btn-info" href="{{ route('members.show',$member->id) }}">Show</a>--}}{{--
                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edytuj</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>--}}


            </tr>
        @endforeach
    </table>
    {!! $roles->render() !!}
@endsection