<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    {{-- bootstrap --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body class="bg-gray-200">
    <header class="bg-secondary text-center text-white p-3 fs-3 fw-bold">Welcome Admin</header>
    <div class="d-flex">
        <!-- Sidebar -->
        @include('sidebar')

        <!-- Main Content -->
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

    <footer class="footer bg-secondary  p-4 ">
        <div class="container text-center">
            <span class="text-muted">@copyright {{ date('Y') }}</span>
        </div>
    </footer>
</body>
</html>