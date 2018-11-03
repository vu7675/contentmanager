@extends('contentmanager::master')
@section('content')
    <table id="wdcBackendTable" class="table table-hover table-sm table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
    </table>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#wdcBackendTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('categoryData') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush
