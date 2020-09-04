<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Laravel + Vue</title>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <base href="<?php echo url('/');?>">
</head>
<body>
  <div id="app">
    <v-app>
      <v-container>
        <router-view></router-view>
      </v-container>
    </v-app>
  </div>
  <script src="{{mix('js/app.js')}}"></script>
</body>
</html>