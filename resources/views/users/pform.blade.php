<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Uprawnienia:</strong><br/>
            Nadaj:
            @foreach($subcategories as $sub)

                <a href="{{ route('perm',['t',$user, $sub->id]) }}">{{$sub->name}}</a>

                {{--{!! Form::open(['method' => 'PATCH','route' => ['permissions.update', $user->id, $sub->id]]) !!}
                {!! Form::submit('Nadaj', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}--}}
                @endforeach<br/>
            Usuń:

            @foreach($subcategories as $sub)

                <a href="{{ route('perm',['n',$user, $sub->id]) }}">{{$sub->name}}</a>

                {{--{!! Form::open(['method' => 'PATCH','route' => ['permissions.update', $user->id, $sub->id]]) !!}
                {!! Form::submit('Nadaj', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}--}}
            @endforeach
        </div>
    </div>

</div>