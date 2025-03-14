<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #272780;
            height: 100vh;
        }

        .left-panel {
            height: 100%;
        }

        .login-container {  
            height: 80vh; 
            width: 80%; 
            max-width: 2000px;
        }  

        .form-control {
            padding: 0.75rem 1.5rem;
        }

        .btn-custom-primary:hover {
            background-color: #272780 !important;
            border-color: #272780 !important;
        }

        .btn-custom-primary {
            background-color: #272780 !important;
            border-color: #272780 !important;
            color: #fff !important;
            font-size: 20px;
        }

        ::placeholder {
            color: #89A1D0 !important;
            font-size: 14px;
        }

        .form-header-container {
            margin-bottom: 3rem;
            margin-top: -3rem;
        }

        .bottomtext a {
            color: #272780;
            text-decoration: none;
        }

        .bottomtext {
            color: #272780;
            text-decoration: none;
        }

        .left-shadow {
            box-shadow: -5px 0 5px rgba(0, 0, 0, 0.2);
        }

        .alert-text {
            font-size: 14px;
            color: red;
            padding: 1px;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
