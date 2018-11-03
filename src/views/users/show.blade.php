@extends('contentmanager::master')
@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">
            {!! $user->body !!}
        </div>
    </div>
@endsection
