@extends('admin.layout.main')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4 border-left-primary">
            <div class="card-body">
                Xin chào, {{ auth()->user()->name }}.
            </div>
        </div>
    </div>
@endsection
