<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="" />

    <title>@yield('title') | {{ config('app.name') }}</title>

    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    @vite('resources/css/dashemr.scss')
</head>

<body class="font-sans leading-normal tracking-normal bg-gray-200">
    <div class="flex">
        {{-- SIDEBAR --}}
        <aside class="sticky top-0 left-0 w-4/12 h-screen p-10 bg-purple-900 lg:w-2/12">
            {{-- Hide btn --}}
            <div
                class="absolute p-2 text-purple-900 bg-gray-300 border border-purple-900 rounded-full cursor-pointer top-10 -right-4">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>

            {{-- Logo --}}
            <div class="relative flex">
                <div class="p-1 rotate-45 bg-yellow-400 rounded-lg">
                    <svg class="w-8 h-8 -rotate-45" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h2 class="absolute text-3xl text-yellow-400 top-1 left-16">{{ config('app.name') }}</h2>
            </div>


            {{-- Menu --}}
        </aside>

        {{-- CONTENT --}}
        <main class="w-8/12 p-11 lg:w-10/12">
            <h1 class="pb-5 mb-5 text-2xl font-semibold border-b-2 border-purple-900">@yield('title')</h1>
            @yield('content')
        </main>
    </div>

    @vite('resources/js/dashemr.js')
    @stack('scripts')
</body>

</html>
