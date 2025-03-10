<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Patient Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

         <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="{{asset('css/main.css')}}" rel="stylesheet">
    </head>

    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        @include('livewire.includes.navBar')
        <livewire:patient-dashboard>
    </body>

</html>
