@extends('layouts.app')

@section('title', $param['event_data']['name'])

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
			<br>
        	<h4>イベントデータ</h4>
            <div>
                イベント名: {{ $param['event_data']['name'] }}
            </div>
            <div>
                開催日: {{ $param['event_data']['datetime'] }}
            </div>
            <div>
                会場名: {{ $param['event_data']['venue_name'] }}
            </div>
            <div>
                イベント概要: {{ $param['event_data']['summary'] }}
            </div>
            <div>
                イベントタイプ: {{ $param['event_data']['event_type_text'] }}
            </div>
            <div>
                タグ: {{ $param['event_data']['tag_text'] }}
            </div>
            <div>
                アーティスト名: {{ link_to_route('artists.show', $param['artist']->name, $param['artist']->artist_id) }}
            </div>
            <div>
				<p class="text-muted">※最終編集者: {{ $param['eventLastEditUserName'] }} ({{ $param['eventLastEditTime'] }})</p>
            </div>
			
			<hr>
			<h4>セットリスト</h4>
			@if(!empty($param['song_list']))
			<h5>・通常</h5>
				@foreach ($param['song_list'] as $key => $song)
					<div>
						{{ $song['seq'] }}.　{{ link_to_route('songs.show', $song['name'], $song['song_id']) }}
						{{ empty($song['collabo_artists']) ? "" : "(with ".$song['collabo_artists'].")" }}
						{{ empty($song['is_short']) ? "" : "(short.ver)" }}
						{{ empty($song['arrange_type_text']) ? "" : "(".$song['arrange_type_text'].")" }}
					</div>
				@endforeach
			@else
			※セットリストが登録されていません。
			@endif
			<br>
			@if(!empty($param['encore_song_list']))
				<h5>・アンコール</h5>
				@foreach ($param['encore_song_list'] as $key => $song)
					<div>
						{{ $song['seq'] }}.　{{ link_to_route('songs.show', $song['name'], $song['song_id']) }}
						{{ empty($song['collabo_artists']) ? "" : "(with ".$song['collabo_artists'].")" }}
						{{ empty($song['is_short']) ? "" : "(short.ver)" }}
						{{ empty($song['arrange_type_text']) ? "" : "(".$song['arrange_type_text'].")" }}
					</div>
				@endforeach
				<br>
			@endif
			
			@auth
			{{ link_to_route('events.edit', '編集', $param['event_data']['event_id'], ['class' => 'btn btn-sm btn-default btn-success']) }}
			<br>
			<br>
			@endauth
            <div>
				<p class="text-muted">※最終編集者: {{ $param['songLastEditUserName'] }} ({{ $param['songLastEditTime'] }})</p>
            </div>
		</div>
        <div class="panel-footer">
            {{ link_to(url()->previous(), '戻る') }}
        </div>
    </div>

@endsection