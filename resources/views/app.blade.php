<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @if (app()->environment('production'))
            <!-- Start cookieyes banner -->
            <script id="cookieyes" type="text/javascript" src="https://cdn-cookieyes.com/client_data/8d2c3099b065c4b1f020732641d233c0/script.js"></script>
            <!-- End cookieyes banner -->
        @endif
        
        <title inertia>{{ config('app.name', 'MoKumbu') }}</title>

        <meta charset="utf-8">

		<meta name="author" content="Dorivaldo Valentim" />
		<meta name="keywords" content="MoKumbu, finanças" />
		<meta name="description" content="MoKumbu é uma app criada com o objectivo de ajudar as pessoas com a gestão das suas finanças." />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>

    <body>
        @inertia
    </body>
</html>
