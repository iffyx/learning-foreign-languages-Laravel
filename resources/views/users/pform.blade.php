<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Uprawnienia:</strong><br/>

            Nadaj:<br/>
            @foreach($permissions as $permission)
                @if($permission->user_id!=$user)
                    <a href="{{ route('perm',['t',$user, $permission->id]) }}">{{$permission->name}}</a>
                @endif
            @endforeach
            <br/>
            Usun:<br/>
            @foreach($permissions as $permission)
                @if($permission->user_id==$user)
                    <a href="{{ route('perm',['n',$user, $permission->id]) }}">{{$permission->name}}</a>
                @endif
            @endforeach

        </div>
    </div>

</div>