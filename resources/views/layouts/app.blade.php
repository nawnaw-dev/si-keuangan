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

  <!-- Panggil Alpine.js di sini -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
