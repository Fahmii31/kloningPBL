<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'E-TechnoCart')</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>

<body class="font-sans bg-white">
    <div class="relative">
        @include('components.pembeli.header')

        <div class="container mx-auto px-4 py-8">
            @yield('content')
        </div>

        @include('components.pembeli.footer')
    </div>

    @stack('scripts')
</body>

</html>