@extends('contentmanager::master')
@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            Pages
        </div>
        <div class="card-body">
            {!! $page->body !!}
        </div>
    </div>
@endsection
