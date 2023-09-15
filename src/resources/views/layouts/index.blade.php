<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @yield('css')
    <link href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="header-left">
            @if(Auth::check())
            <a href="/member" class="header-logo"><i class="fa-solid fa-bars bar-menu"></i></a>
            @else
            <a href="/guest" class="header-logo"><i class="fa-solid fa-bars bar-menu"></i></a>
            @endif
            <h1 class="header-ttl"><a href="/" class="header-ttl__top">Rese</a></h1>
        </div>
        <div class="header-right">
            @yield('search')
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>
</body>

</html>