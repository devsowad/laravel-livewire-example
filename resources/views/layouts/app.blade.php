<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Livewire</title>

    <link rel="stylesheet" href="{{ asset('asset/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/font-face.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">

    @livewireStyles
    @livewireScripts

    <script src="{{ asset('asset/js/mdb.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    <script>
        document.addEventListener('turbolinks:load', () => {
            window.livewire.rescan()
        })

    </script>
</head>

<body>

    <header class="bg-gray shadow-3">
        <div class="container">
            <div class="py-4 d-flex justify-content-between align-items-center">
                <h3 class="bigger-font text-dark m-0">Livewire</h3>
                <div>
                    <a href="{{ route('home') }}" class="btn btn-secondary @yield('home') mr-2">Home</a>
                    <a href="{{ route('image') }}" class="btn btn-secondary @yield('image') mr-2">Image</a>
                    @auth
                        @livewire('logout')
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-secondary @yield('login') mr-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-secondary @yield('register')">Register</a>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        {{ $slot }}
    </div>

</body>

</html>
