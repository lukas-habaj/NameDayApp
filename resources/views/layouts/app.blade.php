<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | NameDayApp</title>

    <link href="/css/app.css" rel="stylesheet">
</head>
<body class="antialiased">
    @yield('header')
    @yield('main')

    <script src="/js/app.js"></script>
</body>
</html>
