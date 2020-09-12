<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 
<head>
    <meta charset="UTF-8">
    <title>SPA sample</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
 
<body>
 
    <div id="app">
        <storeitem-component></storeitem-component>
    </div>
 
    <script src="{{ mix('js/app.js') }}"></script>
</body>
 
</html>