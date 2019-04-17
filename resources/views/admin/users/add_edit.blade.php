@extends('admin.base')

@section('action-buttons')
@endsection

@section('content')
    <div id="app" class="card">
        <div class="card-header">Formularz użytkownika</div>
        <div class="card-body forms">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{ Form::model($user, ['route' => $routeAction,  'enctype' => 'multipart/form-data']) }}
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
                <date-picker field-name="birthday" label="Data urodzenia" value="{{ $user->birthday->format('Y-m-d') }}" max-year="{{ $maxYear }}"></date-picker>
                <div class="line"></div>
                <div class="form-group row">
                    {{ Form::label('email', 'Email', ['class' => 'col-sm-2 form-control-label']) }}
                    <div class="col-sm-10">
                        {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="line"></div>
                <div class="form-group row">
                    {{ Form::label('password', 'Hasło', ['class' => 'col-sm-2 form-control-label']) }}
                    <div class="col-sm-10">
                        {{ Form::password('password', ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('password_confirmation', 'Powtórz hasło', ['class' => 'col-sm-2 form-control-label']) }}
                    <div class="col-sm-10">
                        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="line"></div>
                <div class="form-group row">
                    {{ Form::label('avatar', 'Avatar', ['class' => 'col-sm-2 form-control-label']) }}
                    <div class="col-sm-10">
                        {{ Form::file('avatar', ['class' => 'form-control-file']) }}
                    </div>
                </div>
                <div class="line"></div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        {{ Form::submit('Zapisz', ['class' => 'btn btn-primary']) }}
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Anuluj</a>
                    </div>
                </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
