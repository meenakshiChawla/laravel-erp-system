<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ config('app.name', 'ERP') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  @include('layouts.navbar')

  <main class="container">
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
