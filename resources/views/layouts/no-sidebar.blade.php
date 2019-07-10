<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Goobooru</title>

        <!-- Fonts -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>

        @include('partials.header')

        <div class="wrapper">

            @yield('content')

        </div>

    </body>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</html>
