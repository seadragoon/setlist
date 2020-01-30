@extends('layouts.app')

@section('title', $params['event_data']['name'])

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
			<br>
        	<h4>イベントデータ</h4>
            <div>
                イベント名: {{ $params['event_data']['name'] }}
            </div>
            <div>
                開催日: {{ $params['event_data']['datetime'] }}
            </div>
            <div>
                会場名: {{ $params['event_data']['venue_name'] }}
            </div>
            <div>
                イベント概要:
				<div class="event-summary">
					<p>
						{!! $params['event_data']['summary'] !!}
					</p>
				</div>
            </div>
            <div>
                イベントタイプ: {!! $params['event_data']['event_type_text'] !!}
            </div>
            <div>
                タグ: {{ $params['event_data']['tag_text'] }}
            </div>
            <div>
				<p class="text-muted">※最終編集者: {{ $params['eventLastEditUserName'] }} ({{ $params['eventLastEditTime'] }})</p>
			</div>
			
			@auth
			<div class="btn-toolbar">
				<div class="btn-group mr-2">
					{{ link_to_route('events.edit', '編集', $params['event_data']['event_id'], ['class' => 'btn btn-sm btn-default btn-success']) }}
				</div>
				<div class="btn-group">
					{{ Form::open(['route' => ['events.destroy', $params['event_data']['event_id']], 'method' => 'delete', 'class' => 'form_delete']) }}
						{{ Form::submit('削除', ['class' => 'btn btn-sm btn-default btn-danger']) }}
					{{ Form::close() }}
				</div>
			</div>
			@endauth
			
			<hr>

			<h4>セットリスト</h4>
			@if(!empty($params['setlistArray']))

				@if(!empty($params['event_data']['is_viewer_warning']))
				<p>
					<span class="text-danger">
						※閲覧注意に設定されています。
					</span>
					表示するには
					<a data-toggle="collapse" href="#setlist_area">ここ</a>
					を押してください。
				</p>
				<div id="setlist_area" class="collapse">
				@endif

				@foreach ($params['setlistArray'] as $setlist)
					<h5>■{{ link_to_route('artists.show', $setlist['artist']->name, $setlist['artist']->artist_id) }}</h5>
					<h6>・通常</h6>
					@foreach ($setlist['song_list'] as $key => $song)
						<div>
							{{ $song['seq'] }}.　{{ link_to_route('songs.show', $song['name'], $song['song_id']) }}
							{{ empty($song['collabo_artists']) ? "" : "(with ".$song['collabo_artists'].")" }}
							{{ empty($song['is_short']) ? "" : "(short.ver)" }}
							{{ empty($song['arrange_type_text']) ? "" : "(".$song['arrange_type_text'].")" }}
						</div>
					@endforeach

					<br>
					@if(!empty($setlist['encore_song_list']))
						<h6>・アンコール</h6>
						@foreach ($setlist['encore_song_list'] as $key => $song)
							<div>
								{{ $song['seq'] }}.　{{ link_to_route('songs.show', $song['name'], $song['song_id']) }}
								{{ empty($song['collabo_artists']) ? "" : "(with ".$song['collabo_artists'].")" }}
								{{ empty($song['is_short']) ? "" : "(short.ver)" }}
								{{ empty($song['arrange_type_text']) ? "" : "(".$song['arrange_type_text'].")" }}
							</div>
						@endforeach
						<br>
					@endif
				
					<div>
						<p class="text-muted">※最終編集者: {{ $setlist['lastEditUserName'] }} ({{ $setlist['lastEditTime'] }})</p>
					</div>

					@auth
					<div class="btn-toolbar">
						<div class="btn-group mr-2">
							{{ link_to_route('events.edit_setlist', '編集'
								, ['event_id' => $params['event_data']['event_id'], 'artist_id' => $setlist['artist']->artist_id]
								, ['class' => 'btn btn-sm btn-default btn-success']) }}
						</div>
						<div class="btn-group">
							{{ Form::open(['route' => ['events.destroy_setlist', $params['event_data']['event_id'], 'artist_id' => $setlist['artist']->artist_id], 'method' => 'delete', 'class' => 'form_setlist_delete']) }}
								{{ Form::submit('削除', ['class' => 'btn btn-sm btn-default btn-danger']) }}
							{{ Form::close() }}
						</div>
					</div>
					<br>
					@endauth
				@endforeach

				@if(!empty($params['event_data']['is_viewer_warning']))
				{{-- 折り畳み用の閉じタグ --}}
				</div>
				@endif

			@else
				※セットリストが登録されていません。
			@endif

			@auth
				@if (!empty($params['addableArtists'] && count($params['addableArtists']) > 0))
				<hr>

				<h4>セットリスト追加</h4>
				<div class="form-group">
					<label for="artist_title" class="col-sm-3 control-label">アーティスト</label>
                    <div class="dropdown col-sm-6">
                        {!! Form::text('artist_name', null, ['id' => 'artist_name', 'class' => 'form-control dropdown-toggle', 'autocomplete' => 'off', 'list' => 'artist_list']) !!}
                        <datalist id="artist_list">
                            @foreach ($params['addableArtists'] as $artist_id => $name)
                                <option value="{{ $name }}">
                            @endforeach
                        </datalist>
                    </div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 col-12">
						{{ link_to_route('events.edit_setlist', '追加'
							, ['event_id' => $params['event_data']['event_id'], 'artist_id' => 1]
							, ['id' => 'add_setlist', 'class' => 'btn btn-default btn-primary']) }}
					</div>
				</div>
				@endif
			@endauth
		</div>
		<br>
        <div class="panel-footer">
            @if (url()->previous() === url()->current())
                {{ link_to('/', '戻る') }}
            @else
                {{ link_to(url()->previous(), '戻る') }}
            @endif
        </div>
    </div>

@endsection

@section('script')]
    
    <script>
	const addableArtists = {!! $params['addableArtists'] !!};
	$(function(){
		$(".form_delete").submit(function(){
			if(!confirm('このイベントを本当に削除しますか？（不随するセットリスト情報も全て削除されます）')){
				return false;
			}
		});
		$(".form_setlist_delete").submit(function(){
			if(!confirm('指定のセットリストを本当に削除しますか？')){
				return false;
			}
		});
		$("#add_setlist").on("click", function(){
			const artistName = $('#artist_name').val();
			const index = Object.values(addableArtists).findIndex(x => x === artistName);
			const id = Object.keys(addableArtists)[index];
			
			if (id === null || id === undefined) {
				alert("入力したアーティスト名のアーティストは存在しません：" + artistName);
				return false;
			}
			
			$("#add_setlist").attr('href', '{{ url()->current() }}/setlist/' + id);
		});
	});
    </script>
    
@endsection

@section('style')
    
    <style type="text/css">
	    .event-summary {
			background-color: #ddd;
	    }
	    .dropdown-menu {
	        overflow:auto;
	        max-height: 250px;
	        min-width: 100%;
	    }
    </style>

@endsection