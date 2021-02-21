<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | NameDayApp</title>

    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
    @include('partials.top_panel')
    <section class="main">
    @yield('main')
    </section>

    <script src="/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.js"></script>
</body>
</html>
