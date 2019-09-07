<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Vue Donation</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark mb-3">
        <a class="navbar-brand" href="/">Laravel Vue Donation</a>
    </nav>
    <div id="app">
        {{-- <donation-type route={{ route('donations.store') }}></donation-type> --}}
        <app route={{ route('donations.store') }}></app>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
