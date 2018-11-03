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
        @foreach($admins as $admin)
            <tr>
                <td scope="row">{{$admin->id}}</td>
                <td>{{$admin->title}}</td>
                <td>{{$admin->slug}}</td>
                <td>{{$admin->created_at}}</td>
                <td>
                    <a href="{{url('admins/'.$admin->id.'/edit')}}">
                        <button class="btn btn-sm btn-primary">Edit</button>
                    </a>
                    <button class="btn btn-sm btn-danger delete" data-id="{{$admin->id}}">Delete</button>
                    <form id="delete-{{$admin->id}}" action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display: none;">
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
                ajax: '{!! route('adminData') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'slug', name: 'slug' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush
