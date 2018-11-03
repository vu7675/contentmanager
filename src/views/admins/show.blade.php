@extends('contentmanager::master')
@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            Admins
        </div>
        <div class="card-body">
            {!! $admin->body !!}
        </div>
    </div>
@endsection
