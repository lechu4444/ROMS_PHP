@extends('admin.base')

@section('action-buttons')
    <a href="{{ route('admin.users.add') }}" class="btn btn-primary pull-right">
        <i class="fa fa-plus"></i> Dodaj użytkownika
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Lista użytkowników</div>
        <div class="card-body">
            <div id="app">
                <Users></Users>
            </div>
        </div>
    </div>
@endsection
