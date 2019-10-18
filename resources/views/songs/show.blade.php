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
        <h5>歌唱したイベントリスト</h5>
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
        <div class="panel-footer">
            {{ link_to(url()->previous(), '戻る') }}
            <!--{{ link_to_route('artists.show', '戻る', $param['artist']->artist_id) }}-->
        </div>
    </div>

@endsection