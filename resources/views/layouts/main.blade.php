<!DOCTYPE html>
<html>
<head>
    <title>FaceClone - The Social Network</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css"/>
    <link rel="stylesheet" href="assets/css/admin.css"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .box{
            background: rgba(255,255,255,1);
            padding: 10px 20px;
            border-radius: 2px;
            box-shadow: 0px 0px 15px 5px rgba(0,0,0,0.4);
        }
    </style>
</head>
<body>
    @include('layouts.header')
    <div class="main">
        <div class="container-fluid">
            @include('layouts.left')
                @yield('center')
            @include('layouts.right')
        </div>
    </div>
    @include('layouts.footer')
    @stack('scripts')


</body>
</html>
