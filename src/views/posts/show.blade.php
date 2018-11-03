@extends('contentmanager::master')
@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            Posts
        </div>
        <div class="card-body">
            {!! $post->body !!}
        </div>
    </div>
@endsection
