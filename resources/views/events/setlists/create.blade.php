@extends('layouts.app')

@if($params['isEdit'])
@section('title', 'セットリスト編集')
@else
@section('title', 'セットリスト追加')
@endif

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
			<br>
			@if($params['isEdit'])
			<h4>セットリスト編集</h4>
			<p>既存セットリストの編集を行えます。</p>
			@else
			<h4>セットリスト追加</h4>
			<p>新規セットリストの追加を行えます。</p>
            @endif
            <div>
                イベント名: {{ $params['event']->name }}
            </div>
            <div>
                アーティスト名: {{ link_to_route('artists.show', $params['artist']->name, $params['artist']->artist_id) }}
            </div>

        	<hr>
            <h4>セットリスト</h4>
            {!! Form::model($params, ['route' => ['events.store_setlist', $params['event']->event_id, $params['artist']->artist_id], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <h5>・通常</h5>
                <button type="button" id="addButton">追加</button>
                <button type="button" id="removeButton">削除</button>
				<div class="d-none d-sm-flex">
					<div class="row col-sm-12 px-0">
	                	<div class="col-sm-1">楽曲番号</div>
	                	<div class="col-sm-6">楽曲名</div>
	                	<div class="col-sm-1">ショートVerか</div>
	                	<div class="col-sm-2">アレンジタイプ</div>
	                	<div class="col-sm-2">コラボアーティスト</div>
					</div>
				</div>
                <div id="songListArea">
                	@if(!empty(old('songs', $params['songs'])))
	                	@foreach (old('songs', $params['songs']) as $index => $oldSong)
						<div class="form-group" id="song_{{$index + 1}}">
		                	<div class="row col-sm-12 col-12">
			                    <div class="col-sm-1 px-0">
			                        {!! Form::label('song_seq', ($index + 1), ['id' => 'song_seq_label', 'class' => 'control-label']) !!}.
			                    </div>
			                    <div class="d-sm-none col-2 px-0">楽曲名</div>
			                    <div class="col-sm-6 col-10 px-0">
			                    	<div class="dropdown">
				                        {!! Form::text('songs['.$index.'][name]', $oldSong['name'], ['id' => 'song_name', 'class' => 'form-control dropdown-toggle', 'autocomplete' => 'off', 'list' => 'song_list']) !!}
				                        <datalist id="song_list">
					                        @foreach ($params['songMasters'] as $song)
												<option value="{{ $song->name }}">
											@endforeach
										</datalist>
								    </div>
			                    </div>
			                    <div class="d-sm-none col-6 px-0">ショートVerか</div>
			                	<div class="col-sm-1 col-6 px-0">
			                		{!! Form::checkbox('songs['.$index.'][is_short]', true, !empty($oldSong['is_short']), ['id' => 'song_is_short', 'class' => 'form-control']) !!}
			                    </div>
			                    <div class="d-sm-none col-6 px-0">アレンジタイプ</div>
			                	<div class="col-sm-2 col-6 px-0">
			                		{!! Form::select('songs['.$index.'][arrange_type]', $params['arrangeTypeStrings'], $oldSong['arrange_type'], ['id' => 'song_arrange_type', 'class' => 'form-control']) !!}
			                    </div>
			                    <div class="d-sm-none col-6 px-0">コラボアーティスト</div>
			                	<div class="col-sm-2 col-6 px-0">
			                        {!! Form::text('songs['.$index.'][collabo_artists]', $oldSong['collabo_artists'], ['id' => 'collabo_artists', 'class' => 'form-control']) !!}
			                    </div>
		                    </div>
		                    @if(!empty($errors->first('songs.'.$index.'.name')))
		                    	<span class="text-danger">{{ $errors->first('songs.'.$index.'.name') }}</span>
		                    @endif
		                    @if(!empty($errors->first('songs.'.$index.'.collabo_artists')))
		                    	<span class="text-danger">{{ $errors->first('songs.'.$index.'.collabo_artists') }}</span>
		                    @endif
		                </div>
		                @endforeach
		            @else
		                <div class="form-group" id="song_1">
		                	<div class="row col-sm-12 col-12">
			                    <div class="col-sm-1 px-0">
			                        {!! Form::label('song_seq', 1, ['id' => 'song_seq_label', 'class' => 'control-label']) !!}.
			                    </div>
			                    <div class="d-sm-none col-2 px-0">楽曲名</div>
			                    <div class="col-sm-6 col-10 px-0">
			                    	<div class="dropdown">
				                        {!! Form::text('songs[0][name]', '', ['id' => 'song_name', 'class' => 'form-control dropdown-toggle', 'autocomplete' => 'off', 'list' => 'song_list']) !!}
				                        <datalist id="song_list">
					                        @foreach ($params['songMasters'] as $song)
												<option value="{{ $song->name }}">
											@endforeach
										</datalist>
								    </div>
			                    </div>
			                    <div class="d-sm-none col-6 px-0">ショートVerか</div>
			                	<div class="col-sm-1 col-6 px-0">
			                		{!! Form::checkbox('songs[0][is_short]', true, null, ['id' => 'song_is_short', 'class' => 'form-control']) !!}
			                    </div>
			                    <div class="d-sm-none col-6 px-0">アレンジタイプ</div>
			                	<div class="col-sm-2 col-6 px-0">
			                		{!! Form::select('songs[0][arrange_type]', $params['arrangeTypeStrings'], 0, ['id' => 'song_arrange_type', 'class' => 'form-control']) !!}
			                    </div>
			                    <div class="d-sm-none col-6 px-0">コラボアーティスト</div>
			                	<div class="col-sm-2 col-6 px-0">
			                        {!! Form::text('songs[0][collabo_artists]', null, ['id' => 'collabo_artists', 'class' => 'form-control']) !!}
			                    </div>
		                    </div>
		                </div>
		            @endif
                </div>
                <hr>
                <h5>・アンコール</h5>
                <button type="button" id="addButtonEncore">追加</button>
                <button type="button" id="removeButtonEncore">削除</button>
				<div class="d-none d-sm-flex">
					<div class="row col-sm-12 px-0">
	                	<div class="col-sm-1">楽曲番号</div>
	                	<div class="col-sm-6">楽曲名</div>
	                	<div class="col-sm-1">ショートVerか</div>
	                	<div class="col-sm-2">アレンジタイプ</div>
	                	<div class="col-sm-2">コラボアーティスト</div>
					</div>
				</div>
                <div id="encoreSongListArea">
                	@if(!empty(old('encore_songs', $params['encore_songs'])))
	                	@foreach (old('encore_songs', $params['encore_songs']) as $index => $oldSong)
						<div class="form-group" id="encore_song_{{$index + 1}}">
		                	<div class="row col-sm-12 col-12">
			                    <div class="col-sm-1 px-0">
			                        {!! Form::label('encore_song_seq', ($index + 1), ['id' => 'encore_song_seq_label', 'class' => 'control-label']) !!}.
			                    </div>
			                    <div class="d-sm-none col-2 px-0">楽曲名</div>
			                    <div class="col-sm-6 col-10 px-0">
			                    	<div class="dropdown">
				                        {!! Form::text('encore_songs['.$index.'][name]', $oldSong['name'], ['id' => 'encore_song_name', 'class' => 'form-control dropdown-toggle', 'autocomplete' => 'off', 'list' => 'song_list']) !!}
				                        <datalist id="song_list">
					                        @foreach ($params['songMasters'] as $song)
												<option value="{{ $song->name }}">
											@endforeach
										</datalist>
								    </div>
			                    </div>
			                    <div class="d-sm-none col-6 px-0">ショートVerか</div>
			                	<div class="col-sm-1 col-6 px-0">
			                		{!! Form::checkbox('encore_songs['.$index.'][is_short]', true, !empty($oldSong['is_short']), ['id' => 'encore_song_is_short', 'class' => 'form-control']) !!}
			                    </div>
			                    <div class="d-sm-none col-6 px-0">アレンジタイプ</div>
			                	<div class="col-sm-2 col-6 px-0">
			                		{!! Form::select('encore_songs['.$index.'][arrange_type]', $params['arrangeTypeStrings'], $oldSong['arrange_type'], ['id' => 'encore_song_arrange_type', 'class' => 'form-control']) !!}
			                    </div>
			                    <div class="d-sm-none col-6 px-0">コラボアーティスト</div>
			                	<div class="col-sm-2 col-6 px-0">
			                        {!! Form::text('encore_songs['.$index.'][collabo_artists]', $oldSong['collabo_artists'], ['id' => 'collabo_artists', 'class' => 'form-control']) !!}
			                    </div>
		                    </div>
		                    @if(!empty($errors->first('encore_songs.'.$index.'.name')))
		                    	<span class="text-danger">{{ $errors->first('encore_songs.'.$index.'.name') }}</span>
		                    @endif
		                    @if(!empty($errors->first('encore_songs.'.$index.'.collabo_artists')))
		                    	<span class="text-danger">{{ $errors->first('encore_songs.'.$index.'.collabo_artists') }}</span>
		                    @endif
		                </div>
		                @endforeach
		            @else
		                <div class="form-group" id="encore_song_1">
		                	<div class="row col-sm-12 col-12">
			                    <div class="col-sm-1 px-0">
			                        {!! Form::label('encore_song_seq', 1, ['id' => 'encore_song_seq_label', 'class' => 'control-label']) !!}.
			                    </div>
			                    <div class="d-sm-none col-2 px-0">楽曲名</div>
			                    <div class="col-sm-6 col-10 px-0">
			                    	<div class="dropdown">
				                        {!! Form::text('encore_songs[0][name]', '', ['id' => 'encore_song_name', 'class' => 'form-control dropdown-toggle', 'autocomplete' => 'off', 'list' => 'song_list']) !!}
				                        <datalist id="song_list">
					                        @foreach ($params['songMasters'] as $song)
												<option value="{{ $song->name }}">
											@endforeach
										</datalist>
								    </div>
			                    </div>
			                    <div class="d-sm-none col-6 px-0">ショートVerか</div>
			                	<div class="col-sm-1 col-6 px-0">
			                		{!! Form::checkbox('encore_songs[0][is_short]', true, null, ['id' => 'encore_song_is_short', 'class' => 'form-control']) !!}
			                    </div>
			                    <div class="d-sm-none col-6 px-0">アレンジタイプ</div>
			                	<div class="col-sm-2 col-6 px-0">
			                		{!! Form::select('encore_songs[0][arrange_type]', $params['arrangeTypeStrings'], 0, ['id' => 'encore_song_arrange_type', 'class' => 'form-control']) !!}
			                    </div>
			                    <div class="d-sm-none col-6 px-0">コラボアーティスト</div>
			                	<div class="col-sm-2 col-6 px-0">
			                        {!! Form::text('encore_songs[0][collabo_artists]', null, ['id' => 'collabo_artists', 'class' => 'form-control']) !!}
			                    </div>
		                    </div>
		                </div>
		            @endif
                </div>
                <hr>
                <!-- hidden parameter -->
                {{Form::hidden('event_id', $params['event']->event_id, ['id' => 'event_id'])}}
                
                <div class="form-group">
                    <div class="col-sm-12 col-12">
                        {!! Form::submit('送信', ['class' => 'btn btn-default']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="panel-footer">
			@if (url()->previous() === url()->current())
				{{ link_to_route('events.show', '戻る', $params['event']->event_id) }}
            @else
                {{ link_to(url()->previous(), '戻る') }}
            @endif
        </div>
    </div>
    
@endsection

@section('script')
    
    <script>
	$(function(){
		// --- 通常セットリスト --- //
		@if(!empty(old('songs', $params['songs'])))
		var index = {{count(old('songs', $params['songs']))}};
		@else
		var index = 1;
		@endif
		// 追加ボタン押下時のイベント
		$('button#addButton').on('click', function(){
			
			// インデックス加算
			index++;
			
			// テンプレート複製
			$('div#song_1')
				// コピー処理
				.clone(true)
				// IDを付ける
				.removeAttr("id")
				.attr("id", "song_" + index)
				// 楽曲番号の変更
				.find("#song_seq_label")
				.text(index)
				.end()
				// テキストボックスのID変更
				.find("#song_name")
				.attr("name", "songs[" + (index - 1) + "][name]")
				// -> テキストを空に
				.val("")
				.end()
				// ショートフラグのID変更
				.find("#song_is_short")
				.attr("name", "songs[" + (index - 1) + "][is_short]")
				.prop("checked", false)
				.end()
				// アレンジタイプのID変更
				.find("#song_arrange_type")
				.attr("name", "songs[" + (index - 1) + "][arrange_type]")
				.val(0)
				.end()
				// コラボアーティストのID変更
				.find("#collabo_artists")
				.attr("name", "songs[" + (index - 1) + "][collabo_artists]")
				.val("")
				.end()
				// 追加処理
				.appendTo("div#songListArea");
			
		});
		// 削除ボタン押下時イベント
		$('button#removeButton').on('click',function(){
			// 最初の一つは削除させない
			if (index == 1) {
				return;
			}
			// 存在する場合のみ削除する
			if($('div#song_' + index).length) {
				$('div#song_' + index).remove();
				index--;
			}
		});
		
		// --- アンコールセットリスト --- //
		@if(!empty(old('encore_songs', $params['encore_songs'])))
		var encoreIndex = {{count(old('encore_songs', $params['encore_songs']))}};
		@else
		var encoreIndex = 1;
		@endif
		// 追加ボタン押下時のイベント
		$('button#addButtonEncore').on('click', function(){
			
			// インデックス加算
			encoreIndex++;
			
			// テンプレート複製
			$('div#encore_song_1')
				// コピー処理
				.clone(true)
				// IDを付ける
				.removeAttr("id")
				.attr("id", "encore_song_" + encoreIndex)
				// 楽曲番号の変更
				.find("#encore_song_seq_label")
				.text(encoreIndex)
				.end()
				// テキストボックスのID変更
				.find("#encore_song_name")
				.attr("name", "encore_songs[" + (encoreIndex - 1) + "][name]")
				// -> テキストを空に
				.val("")
				.end()
				// ショートフラグのID変更
				.find("#encore_song_is_short")
				.attr("name", "encore_songs[" + (encoreIndex - 1) + "][is_short]")
				.prop("checked", false)
				.end()
				// アレンジタイプのID変更
				.find("#encore_song_arrange_type")
				.attr("name", "encore_songs[" + (encoreIndex - 1) + "][arrange_type]")
				.val(0)
				.end()
				// コラボアーティストのID変更
				.find("#collabo_artists")
				.attr("name", "encore_songs[" + (encoreIndex - 1) + "][collabo_artists]")
				.val("")
				.end()
				// 追加処理
				.appendTo("div#encoreSongListArea");
			
		});
		// 削除ボタン押下時イベント
		$('button#removeButtonEncore').on('click',function(){
			// 最初の一つは削除させない
			if (encoreIndex == 1) {
				return;
			}
			// 存在する場合のみ削除する
			if($('div#encore_song_' + encoreIndex).length) {
				$('div#encore_song_' + encoreIndex).remove();
				encoreIndex--;
			}
		});
	});
    </script>
    
@endsection

@section('style')
    
    <style type="text/css">
	    .dropdown-menu {
	        overflow:auto;
	        max-height: 250px;
	        min-width: 100%;
	    }
    </style>

@endsection