<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Pick Up</title>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
  <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <base href="<?php echo url('/');?>">
</head>
<body>
  <div id="app">
    
    <v-app>
      <router-view></router-view>
    </v-app>
  </div>
  
  <script src="https://js.stripe.com/v3/"></script>
  <!-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script> -->
  <script src="{{mix('js/app.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
</body>
</html>