<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        {{-- CSRF トークン --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@yield('title')</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
        
        @yield('header')
        
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/index') }}">
                    {{ __('ホーム') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- Navbarの左側 --}}
                    <ul class="navbar-nav mr-auto">
                        {{-- 各ページへのリンク --}}
	                    <li class="nav-item"><a class="nav-link" href="{{ url('/events/search') }}">{{ __('イベント検索') }}</a></li>
	                    <li class="nav-item"><a class="nav-link" href="{{ url('/artists') }}">{{ __('アーティスト情報') }}</a></li>
	                    <li class="nav-item"><a class="nav-link" href="{{ url('/songs/search') }}">{{ __('楽曲検索') }}</a></li>
	                    <li class="nav-item"><a class="nav-link" href="{{ url('/aggregate') }}">{{ __('集計機能') }}</a></li>
	                    
                        {{-- 検索 --}}
                        <li class="nav-item">
                            {!! Form::open(['action' => 'EventsController@search', 'method' => 'get', 'class' => 'form-inline my-2 my-lg-0']) !!}
                                <div class="form-group">
                                    {{ Form::text('keyword', null, ['class' => 'form-control mr-sm-2', 'placeholder' => '検索...', 'aria-label' => '検索...']) }}
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('検索', ['class' => 'btn btn-outline-success my-2 my-sm-0']) !!}
                                </div>
                            {!! Form::close() !!}
                        </li>
                    </ul>

                    {{-- Navbarの右側 --}}
                    <ul class="navbar-nav ml-auto">
                        {{-- 追加ボタン --}}
                        <li class="nav-item">
                            <a href="{{ url('events/create') }}" id="new-post" class="btn btn-success">
                                {{ __('新規イベント追加') }}
                            </a>
                        </li>

                        {{-- 認証関連のリンク --}}
                        @guest
                            {{-- 「ログイン」へのリンク --}}
                            <li class="nav-item">
                                <a class="nav-link" href="/">{{ __('ログイン') }}</a>
                            </li>
                        @else
                            {{-- 「プロフィール」と「ログアウト」のドロップダウンメニュー --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                    <a class="dropdown-item" href="{{ url('users/'.auth()->user()->id) }}">
                                        {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="/"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="/" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container">
            @yield('content')
        </div>

        @yield('script')
        @yield('style')
    </body>
</html>