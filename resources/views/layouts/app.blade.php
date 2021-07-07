<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        window.routeList = {!! json_encode(\App\Helpers\GenericHelper::getNamedRoutes()) !!};
    </script>
    <title>@yield("title")</title>
</head>

<body>
<div id="app" class="app-container">
    <main>
        @yield('content')
    </main>
</div>


@stack('css')
@stack('js')
</body>
</html>
