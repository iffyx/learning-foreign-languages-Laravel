<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nazwa:</strong>
            {!! Form::text('name', null, array('placeholder' => '','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Zestaw:</strong>
            <div class="alert alert-warning" role="alert">Proszę wpisywać słówka w formacie:<br/>
            słówko1;słówko przetłumaczone1<br/>
            słówko2;słówko przetłumaczone2</div>
            {!! Form::textarea('set', null,   ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Język1:</strong>
            {{ Form::select('language1_id', $languages,null,  ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Język2:</strong>
            {{ Form::select('language2_id', $languages,null,  ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Podkategoria:</strong>
            {{ Form::select('subcategory_id', $subcategory,null,  ['class' => 'form-control']) }}
        </div>
    </div>

    @if(!Auth::user()->hasRole('user'))
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Czy prywatny?:</strong>
                {{ Form::checkbox('private', true) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Czy widoczny?:</strong>
                {{ Form::checkbox('visible', true) }}
            </div>
        </div>
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Zapisz</button>
    </div>


</div>