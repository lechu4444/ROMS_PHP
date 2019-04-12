@extends('admin.base')

@section('content')
    {{ $dataTable->table() }}
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush
