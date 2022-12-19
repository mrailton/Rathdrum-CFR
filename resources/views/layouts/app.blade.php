<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @production
        <script async defer data-website-id="218b5f8d-d87f-43ea-922a-36accb23700c" src="https://analytics.markrailton.com/umami.js"></script>
    @endproduction

    <title>Rathdrum Community First Responders</title>
</head>
<body class="flex flex-col min-h-screen font-sans antialiased">
<x-header />

<main class="flex-grow w-full pt-12 mx-auto max-w-7xl min-w-3/4 sm:px-6 lg:px-8">
    <x-flash />

    {{ $slot }}
</main>

<x-footer />
</body>
</html>
