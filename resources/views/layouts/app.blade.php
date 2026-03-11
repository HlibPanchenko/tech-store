<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tech Store')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

{{-- Header --}}
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="/" class="text-2xl font-bold text-gray-900">Tech Store</a>
        <nav class="flex items-center gap-6">
            <a href="/catalog" class="text-gray-600 hover:text-gray-900">Каталог</a>
            <a href="/cart" class="text-gray-600 hover:text-gray-900">Кошик</a>
        </nav>
    </div>
</header>

{{-- Content --}}
<main class="flex-1 max-w-7xl mx-auto px-4 py-8 w-full">
    @yield('content')
</main>

{{-- Footer --}}
<footer class="bg-gray-900 text-gray-400 mt-auto">
    <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm">
        &copy; {{ date('Y') }} Tech Store. Всі права захищені.
    </div>
</footer>

</body>
</html>
