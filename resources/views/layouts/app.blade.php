<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<header>
    @include('layouts.menu')
</header>
<body >
    
    <main class="py-4">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
                @yield('login')
            </div>
            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="profile-tab">
                @include('auth.register')
            </div>
        </div>

        @yield('content')
    </main>
   
</body>
    @yield('js')

</html>
