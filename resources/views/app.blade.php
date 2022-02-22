<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Journal</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/vue-range-component@1.0.3/dist/vue-range-slider.min.css">
    <script src="https://unpkg.com/vue-range-component@1.0.3/dist/vue-range-slider.min.js"></script>
</head>
<body class="antialiased">
<div id="app"></div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
