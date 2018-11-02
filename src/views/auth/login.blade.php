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
</head>
<body class="app header-fixed">
<div class="app-body">
    <main class="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card-group">
                        <div class="card p-4">
                            <div class="card-body">
                                <h1>Login</h1>
                                <p class="text-muted">Sign In to your account</p>
                                <form action="{{route('admin.login.submit')}}" method="post">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="icon-user"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" name="email" type="text" placeholder="Email">
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="icon-lock"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" name="password" type="password" placeholder="Password">
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary px-4">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
