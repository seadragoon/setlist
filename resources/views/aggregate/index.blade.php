@extends('layouts.app')

@section('title', '集計機能')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <br>
            <h4>集計機能</h4>
            <h5>アーティストリスト</h5>
            <ul>
                @foreach ($params['artists'] as $artist)
                    <li>
                        {{ link_to_action('AggregateController@show', $artist->name, $artist->artist_id) }}
                    </li>
                @endforeach
            </ul>
            <br>
        </div>
        <div class="panel-footer">
            @if (url()->previous() === url()->current())
                {{ link_to('/', '戻る') }}
            @else
                {{ link_to(url()->previous(), '戻る') }}
            @endif
        </div>
    </div>

@endsection