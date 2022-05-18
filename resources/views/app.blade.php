<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>Nexd testwork</title>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="app">
        <div class="main-div">
            <h2 class="main-title">Nexd testwork developed by Oleg Grasman</h2>
            <campaign-component></campaign-component>
            {{--<creative-component></creative-component>--}}
            {{--<example-component></example-component>--}}
        </div>

    </div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>