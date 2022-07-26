<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="night">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ config('app.name') }}</title>
    @vite('resources/css/dashemr.css')
</head>

<body class="container mx-auto antialiased">
    @yield('content')

    @vite('resources/js/dashemr.js')
    @stack('scripts')
</body>

</html>
