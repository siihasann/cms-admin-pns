<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin - Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center mb-8">
            <h1 class="text-5xl font-bold text-gray-800 mb-4">Welcome to Admin Dashboard</h1>
            <p class="text-xl text-gray-600 mb-8">Please login to access the administration panel</p>

            <div class="space-y-4">
                <a href="{{ route('login') }}"
                    class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1">
                    Login to Dashboard
                </a>
            </div>
        </div>

        <div class="mt-8 text-center text-gray-500">
            <p>Powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }}</p>
            <p>PHP v{{ PHP_VERSION }}</p>
        </div>

        @if (Route::has('register'))
        <div class="mt-4 text-gray-600">
            <p>New Admin?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a>
            </p>
        </div>
        @endif
    </div>

    <div class="absolute bottom-4 right-4">
        <div class="flex items-center space-x-2 text-gray-600">
            <a href="https://laravel.com/docs" class="hover:text-gray-900">Docs</a>
            <span>|</span>
            <a href="https://github.com/laravel/laravel" class="hover:text-gray-900">GitHub</a>
        </div>
    </div>
</body>

</html>