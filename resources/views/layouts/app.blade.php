<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Affiliate btags') }}</title>
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- CSS-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset("/images/background-img.png") }}');
            background-color: #000;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
            width: 100%;
            min-height: 100vh;
        }
        @media screen and (max-width: 1200px) {
            body {
                background-image: url('{{ asset('/images/background.png') }}');
                background-size: auto;
                background-position: center 48px;
            }
        }
    </style>
</head>
<body>
    <div id="app" class="content-inner">
        <nav class="navbar navbar-expand-md">
            <div class="navbar-container">
                <a href="{{ url('/') }}" class="logo-img">
                    <img src="{{asset('/images/logo.png')}}" alt="almabet logo">
                </a>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
        <footer class="footer">
            <div class="container d-flex justify-content-center align-items-center flex-column">
                <img class="payment-methods" alt="payment methods" src="{{ asset('/images/payment.svg') }}">
                <div class="text-center text-white license-text">
                    <p>almabet.com is owned and operated by Alma Solutions ltd. registration number: 15701, registered
                        address: Hamchako, Mutsamudu, Autonomous Island of Anjouan, Union of Comoros. Contact</p>
                    <p>us. <u>Contact@almabet.partners</u>. almabet.com is licensed and regulated by the Government of the
                        Autonomous Island of Anjouan, Union of Comoros and operates under License No.</p>
                    <p>ALSI-112405014-FII. almabet.com has passed all regulatory compliance and is legally authorized to
                        conduct gaming operations for any and all games of chance and wagering.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
