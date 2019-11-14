@extends('layouts.app')

@section('title', $param['artist']->name.' | '.$param['song']->name)

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <br>
            <h4>楽曲データ</h4>
            <div>
                アーティスト名: {{ link_to_route('artists.show', $param['artist']->name, $param['artist']->artist_id) }}
            </div>
            <div>
                曲名: {{ $param['song']->name }}
            </div>
            @auth
            {{ link_to_route('songs.edit', '編集', $param['song']->song_id, ['class' => 'btn btn-sm btn-default btn-success']) }}
            <br>
            @endauth
            <br>

            <h4>歌唱したイベントリスト</h4>
            @if(empty($param['eventDataList']))
                <div>
                    ※この楽曲は演奏されたことがありません
                </div>
            @else
                <div class="d-none d-sm-flex">
                    <div class="col-sm-5">イベント名</div>
                    <div class="col-sm-3">日付</div>
                    <div class="col-sm-4">会場名</div>
                </div>
                <div class="mx-2">
                    @foreach ($param['eventDataList'] as $event)
                        @if($loop->iteration == 1)
                        <div class="row border-top border-bottom py-2">
                        @else
                        <div class="row border-bottom py-2">
                        @endif
                            <div class="col-sm-5 col-12">
                                {{ link_to_route('events.show', $event->name, $event->event_id, ['class' => 'btn-default']) }}
                            </div>
                            <div class="col-sm-3 col-12">
                                {{ date('Y年m月d日',  strtotime($event->datetime)) }}
                            </div>
                            <div class="col-sm-4 col-12">
                                {{ $event->venue_name }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <br>
        </div>
        <div class="panel-footer">
            {{ link_to(url()->previous(), '戻る') }}
            <!--{{ link_to_route('artists.show', '戻る', $param['artist']->artist_id) }}-->
        </div>
    </div>

@endsection