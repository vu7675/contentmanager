@extends('contentmanager::master')
@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            Sliders
        </div>
        <div class="card-body">
            {!! $slider->body !!}
        </div>
    </div>
@endsection
