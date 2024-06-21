@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Xin chào {{ Auth::user()->name }}</h1>
        </div>
    </div>
@endsection