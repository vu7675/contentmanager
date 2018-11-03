@extends('contentmanager::master')
@section('content')
    <form action="{{route('admins.store')}}" method="post" enctype="multipart/form-data">
        @include('contentmanager::admins.partial')
        <button class="btn btn-primary" type="submit"><i class="cui-check"></i> Create</button>
    </form>
@endsection
