@extends('layouts.app')

@section('title', '楽曲検索')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <br>
            <h4>楽曲検索</h4>
            {!! Form::open(['action' => 'SongsController@search', 'method' => 'get', 'class' => 'form-inline']) !!}
                {{ Form::label('keyword_label', '検索ワード：', ['id' => 'keyword_label', 'class' => 'control-label']) }}
                {{ Form::text('keyword', $params['keyword'], ['class' => 'form-control', 'placeholder' => '検索...', 'aria-label' => '検索...']) }}
                {!! Form::submit('検索', ['class' => 'btn']) !!}
            {!! Form::close() !!}
            <br>
            @if(!empty($params['keyword']))
                <h4>楽曲検索結果</h4>
                検索ワード「{{ $params['keyword'] }}」での検索結果<br>
                @if(count($params['result']) > 0)
                    {{ count($params['result']) }}件の楽曲が見付かりました。
                @else
                    楽曲が見付かりませんでした。
                @endif
                <br>
                <div class="d-none d-sm-flex">
                    <div class="col-sm-5">アーティスト名</div>
                    <div class="col-sm-7">楽曲名</div>
                </div>
                <div class="mx-2">
                    @foreach ($params['result'] as $song)
                        @if($loop->iteration == 1)
                        <div class="row border-top border-bottom py-2">
                        @else
                        <div class="row border-bottom py-2">
                        @endif
                            <div class="col-sm-5 col-5">
                                {{ link_to_route('artists.show', $song['artist_name'], $song['artist_id']) }}
                            </div>
                            <div class="col-sm-7 col-7">
                                {{ link_to_route('songs.show', $song['name'], $song['song_id']) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <br>
        <div class="panel-footer">
            {{ link_to(url()->previous(), '戻る') }}
        </div>
    </div>

@endsection