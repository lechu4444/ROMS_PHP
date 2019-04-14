@extends('admin.base')

@section('action-buttons')
@endsection

@section('content')
    <div id="app" class="card">
        <div class="card-header">Nowy użytkownik</div>
        <div class="card-body">
            {{ Form::model($user, ['route' => $routeAction]) }}
                <div class="form-group row">
                    {{ Form::label('name', 'Imię', ['class' => 'col-sm-2 form-control-label']) }}
                    <div class="col-sm-10">
                        {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('surname', 'Nazwisko', ['class' => 'col-sm-2 form-control-label']) }}
                    <div class="col-sm-10">
                        {{ Form::text('surname', $user->surname, ['class' => 'form-control']) }}
                    </div>
                </div>
                <date-picker></date-picker>
            {{ Form::close() }}
        </div>
    </div>
@endsection
