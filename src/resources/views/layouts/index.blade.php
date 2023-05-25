<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header-top">
            <div class="header-left">
                <h1 class="header-ttl">Atte</h1>
            </div>
            @yield('nav')
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <p class="end">Atte,inc.</p>
    </footer>
</body>

</html>