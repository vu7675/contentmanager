@extends('contentmanager::master')
@section('content')
    <table id="wdcBackendTable" class="table table-hover table-sm table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sliders as $slider)
            <tr>
                <td scope="row">{{$slider->id}}</td>
                <td>{{$slider->name}}</td>
                <td>{{$slider->email}}</td>
                <td>{{$slider->created_at}}</td>
                <td>
                    <a href="{{url('sliders/'.$slider->id.'/edit')}}">
                        <button class="btn btn-sm btn-primary">Edit</button>
                    </a>
                    <button class="btn btn-sm btn-danger delete" data-id="{{$slider->id}}">Delete</button>
                    <form id="delete-{{$slider->id}}" action="{{ route('sliders.destroy', $slider->id) }}" method="POST" style="display: none;">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#wdcBackendTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('sliderData') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush
