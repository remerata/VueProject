<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</body>
</html>
