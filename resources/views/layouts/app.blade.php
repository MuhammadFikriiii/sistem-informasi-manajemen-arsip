<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
   {{-- tailwind config --}}
   @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="bg-blue-700">
        @yield('content')
    </div>
</body>
</html>