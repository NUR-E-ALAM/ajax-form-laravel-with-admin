<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <!-- <link rel="shortcut icon" href="https://toll.rthdgovbd.com/images/bd.png"> -->
  <link rel="shortcut icon" href="{{ asset('images/bd.png') }}">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
@include('frontend.layouts.menubar')
@yield('contant')
@include('sweetalert::alert')
<div class="container mt-6">
<div class="f">
        <p>2022 © Md.Nur-E-Alam Tanzir .
            <span style="float: right;">Developed By
                    <a href="#" target="__blank">Nur-E-Alam Tanzir</a>
                </span>
        </p>
    </div>
</div>
</body>
</html>
