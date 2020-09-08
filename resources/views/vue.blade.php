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
    <div class=" bg-gray-100 border-b border-gray-300 py-4">
      <div class="container mx-auto d-flex justify-between">
        <div class=" mx-auto">
          <router-link class="mr-4" to="/">Home</router-link>
          <router-link to="/about">about</router-link>
        </div>
        <div class=" mx-auto">
          <router-link class="mr-4" to="/login">Login</router-link>
          <router-link to="/register">Register</router-link>
        </div>
      </div>
    </div>
    <v-app>
      <v-container>
        <router-view></router-view>
      </v-container>
    </v-app>
  </div>
  <script src="{{mix('js/app.js')}}"></script>
</body>
</html>