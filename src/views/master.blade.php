<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons/css/coreui-icons.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
@include('contentmanager::nav')
<div class="app-body">
    @include('contentmanager::sidebar')
    <main class="main">
        @include('contentmanager::breadcrumb')
        <div class="container-fluid">
            @if(isset($errors))
                @include('contentmanager::alert')
            @endif
            <div class="card col-md-12">
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
@stack('scripts')
<script type="text/javascript">
    @if(strpos(\Request::route()->getName(), 'index') !== false)
    function deleteObject(id) {
        if (confirm('Are you sure you want to delete?')) {
            $.ajax({
                type: "DELETE",
                url: '{{ \Request::segment(2) }}' + '/' + id,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (result) {
                    if (result == 1) {
                        alert('Deleted.');
                        $('#wdcBackendTable').DataTable().ajax.reload();
                    } else {
                        alert('Error.')
                    }
                }
            });
        }
    }

    @endif
    $(document).ready(function () {
        $('.select2').select2();
        $('#summernote').summernote();
        $('.alert').alert();
    });
</script>
</html>
