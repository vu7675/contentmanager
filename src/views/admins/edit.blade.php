@extends('contentmanager::master')
@section('content')
    <form action="{{route('admins.update',$admin->id)}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @include('contentmanager::admins.partial')
        <button class="btn btn-primary" type="submit"><i class="cui-pencil"></i> Save</button>
    </form>
@endsection
