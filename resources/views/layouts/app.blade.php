<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Koin Kene')</title>
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>
<body class="antialiased">
  @yield('content')
</body>
</html>
