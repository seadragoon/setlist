@extends('layouts.app')

@section('title', $param['song']->name)

@section('content')

    <div class="panel panel-default">
        
        <hr>
        <h4>楽曲データ</h4>
        <div class="panel-body">
            <div>
                アーティスト名: {{ $param['artist']->name }}
            </div>
            <div>
                曲名: {{ $param['song']->name }}
            </div>
        </div>
        
        <br>
        {{ link_to_route('songs.edit', '編集', $param['song']->song_id, ['class' => 'btn btn-sm btn-default']) }}
        <br>
        <br>
        <div class="panel-footer">
            {{ link_to_route('artists.show', '戻る', $param['artist']->artist_id) }}
        </div>
    </div>

@endsection