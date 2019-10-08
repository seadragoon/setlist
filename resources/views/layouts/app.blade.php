<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
        
        @yield('header')
        
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <a class="navbar-brand" href="{{ url('/index') }}">
                    ホーム
                </a>
                <a class="navbar-brand" href="{{ url('/artists') }}">
                    アーティスト一覧
                </a>
                <a class="navbar-brand" href="{{ url('/events/create') }}">
                    新規イベント追加
                </a>
            </nav>
        </div>

        @yield('content')
    </body>
</html>