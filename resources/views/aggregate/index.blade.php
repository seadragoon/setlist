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
                        {{ link_to('aggregate/show/'.$artist->artist_id, $artist->name) }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection