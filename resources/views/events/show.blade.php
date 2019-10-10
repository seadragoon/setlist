@extends('layouts.app')

@section('title', $param['event_data']->name)

@section('content')

    <div class="panel panel-default">
        
        <hr>
        <h4>イベントデータ</h4>
        <div class="panel-body">
            <div>
                イベント名: {{ $param['event_data']->name }}
            </div>
            <div>
                会場名: {{ $param['event_data']->venue_name }}
            </div>
            <div>
                イベント概要: {{ $param['event_data']->event_summary }}
            </div>
        </div>
        
        <hr>
        <h4>セットリスト</h4>
        <h5>・通常</h5>
        @foreach ($param['song_list'] as $key => $song)
        	<div>
        		{{ $song['seq'] }}.　{{ $song['name'] }}
        	</div>
        @endforeach
        <br>
		@if(!empty($param['encore_song_list']))
	        <h5>・アンコール</h5>
	        @foreach ($param['encore_song_list'] as $key => $song)
	        	<div>
	        		{{ $song['seq'] }}.　{{ $song['name'] }}
	        	</div>
	        @endforeach
        	<br>
        @endif
        {{ link_to_route('events.edit', '編集', $param['event_data']->event_id, ['class' => 'btn btn-sm btn-default']) }}
        <br>
        <div class="panel-footer">
            {{ link_to('/', '戻る') }}
        </div>
    </div>

@endsection