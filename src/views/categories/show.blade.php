@extends('contentmanager::master')
@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            Categorys
        </div>
        <div class="card-body">
            {!! $category->body !!}
        </div>
    </div>
@endsection
