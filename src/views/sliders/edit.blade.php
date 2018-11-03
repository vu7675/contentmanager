@extends('contentmanager::master')
@section('content')
    <form action="{{route('sliders.update',$slider->id)}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @include('contentmanager::sliders.partial')
        <button class="btn btn-primary" type="submit"><i class="cui-pencil"></i> Save</button>
    </form>
@endsection
