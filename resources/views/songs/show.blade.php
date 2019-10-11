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
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>日付</th>
                    <th>イベント名</th>
                    <th>会場名</th>
                </thead>
                <tbody>
                    @foreach ($param['eventDataList'] as $event)
                        <tr>
                            <td class="table-text">
                                {{ date('Y年m月d日',  strtotime($event->datetime)) }}
                            </td>
                            <td class="table-text">
                                {{ link_to_route('events.show', $event->name, $event->event_id, ['class' => 'btn btn-sm btn-default']) }}
                            </td>
                            <td class="table-text">
                                {{ $event->venue_name }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <div class="panel-footer">
            {{ link_to(url()->previous(), '戻る') }}
            <!--{{ link_to_route('artists.show', '戻る', $param['artist']->artist_id) }}-->
        </div>
    </div>

@endsection