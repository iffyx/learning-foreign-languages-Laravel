<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Imię:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Imię','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nazwisko:</strong>
            {!! Form::text('surname', null, array('placeholder' => 'Nazwisko','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'email','class' => 'form-control')) !!}
        </div>
    </div>
    @if($user->id!=1)
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Rola:</strong>
            {{ Form::select('role_id', $roles, null,  ['class' => 'form-control']) }}
        </div>
    </div>
    @endif


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Zapisz</button>
    </div>
</div>