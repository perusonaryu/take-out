<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Laravel + Vue</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <base href="<?php echo url('/');?>">
</head>
<body>
  <div id="app">
    <router-view></router-view>
  </div>
<script src="{{ asset('js/app.js') }}" ></script>
</body>
</html>