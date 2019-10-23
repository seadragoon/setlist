@extends('layouts.app')

@section('title', 'イベント追加')

@section('header')

	<!-- pickadate用スタイル -->
	<link rel="stylesheet" href="{{ asset('lib/themes/default.css') }}" id="theme_base">
	<link rel="stylesheet" href="{{ asset('lib/themes/default.date.css') }}" id="theme_date">
	<link rel="stylesheet" href="{{ asset('lib/themes/default.time.css') }}" id="theme_date">

	<!-- pickadate本体 -->
	<script src="{{ asset('lib/picker.js') }}"></script>
	<script src="{{ asset('lib/picker.date.js') }}"></script>
	<script src="{{ asset('lib/picker.time.js') }}"></script>
	
	<!-- レガシーブラウザへの対応用ファイル -->
	<script src="{{ asset('lib/legacy.js') }}"></script>
	<!-- ランゲージファイルを追加 -->
	<script src="{{ asset('lib/translations/ja_JP.js') }}"></script>

@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
        	<br>
        	<h4>イベント追加</h4>
        	<hr>
            {!! Form::model($params, ['route' => 'events.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
            	<h4>イベント詳細</h4>
				<div class="form-group col-sm-6 col-12">
                	{!! Form::label('event_date_name', '日付', ['class' => 'col-sm-3 control-label']) !!}
                    {!! Form::text('event_date', old('event_date', $params['event_date']), ['id' => 'event_date', 'class' => 'datepicker']) !!}
                    @if(!empty($errors->first('event_date')))
                    	<span class="text-danger">※必須項目です</span>
                    @endif
				</div>
				<div class="form-group col-sm-6 col-12">
                	{!! Form::label('event_time_name', '開始時間', ['class' => 'col-sm-3 control-label']) !!}
                    {!! Form::text('event_time', old('event_time', $params['event_time']), ['id' => 'event_time', 'class' => 'datepicker']) !!}
                    @if(!empty($errors->first('event_time')))
                    	<span class="text-danger">※必須項目です</span>
                    @endif
				</div>
                <div class="form-group">
                    {!! Form::label('event_name', 'イベント名', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8 col-12">
                        {!! Form::text('event_name', old('event_name', $params['event_name']), ['id' => 'event_name', 'class' => 'form-control']) !!}
	                    @if(!empty($errors->first('event_name')))
	                    	<span class="text-danger">※必須項目です</span>
	                    @endif
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('event_venue', '会場名', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8 col-12">
                        {!! Form::text('event_venue', old('event_venue', $params['event_venue']), ['id' => 'event_venue', 'class' => 'form-control']) !!}
                        @if(!empty($errors->first('event_venue')))
	                    	<span class="text-danger">※必須項目です</span>
	                    @endif
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('event_summary', 'イベント概要', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8 col-12">
                        {!! Form::text('event_summary', old('event_summary', $params['event_summary']), ['id' => 'event_summary', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('event_type', 'イベントタイプ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8 col-12">
                		{!! Form::select('event_type', ['ワンマン', 'フェス', 'ミニライブ', 'ゲスト', 'その他'], old('event_type', $params['event_type']), ['id' => 'event_type', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('event_tag', 'タグ(カンマ区切りで入力してください)', ['class' => 'col-sm-6 control-label']) !!}
                    <div class="col-sm-8 col-12">
                        {!! Form::text('event_tag', old('event_tag', $params['event_tag']), ['id' => 'event_tag', 'class' => 'form-control']) !!}
                    </div>
                </div>
                
                <hr>
                <h4>セットリスト</h4>
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
				                        {!! Form::text('songs['.$index.'][name]', $oldSong['name'], ['id' => 'song_name', 'class' => 'form-control dropdown-toggle', 'autocomplete' => 'off', 'list' => 'test']) !!}
				                        <datalist id="test">
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
			                		{!! Form::select('songs['.$index.'][arrange_type]', ['通常', 'Acostic', 'Original', 'Christmas', 'その他'], $oldSong['arrange_type'], ['id' => 'song_arrange_type', 'class' => 'form-control']) !!}
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
				                        {!! Form::text('songs[0][name]', '', ['id' => 'song_name', 'class' => 'form-control dropdown-toggle', 'autocomplete' => 'off', 'list' => 'test']) !!}
				                        <datalist id="test">
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
			                		{!! Form::select('songs[0][arrange_type]', ['通常', 'Acostic', 'Original', 'Christmas', 'その他'], 0, ['id' => 'song_arrange_type', 'class' => 'form-control']) !!}
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
				                        {!! Form::text('encore_songs['.$index.'][name]', $oldSong['name'], ['id' => 'encore_song_name', 'class' => 'form-control dropdown-toggle', 'autocomplete' => 'off', 'list' => 'test']) !!}
				                        <datalist id="test">
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
			                		{!! Form::select('encore_songs['.$index.'][arrange_type]', ['通常', 'Acostic', 'Original', 'Christmas', 'その他'], $oldSong['arrange_type'], ['id' => 'encore_song_arrange_type', 'class' => 'form-control']) !!}
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
				                        {!! Form::text('encore_songs[0][name]', '', ['id' => 'encore_song_name', 'class' => 'form-control dropdown-toggle', 'autocomplete' => 'off', 'list' => 'test']) !!}
				                        <datalist id="test">
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
			                		{!! Form::select('encore_songs[0][arrange_type]', ['通常', 'Acostic', 'Original', 'Christmas', 'その他'], 0, ['id' => 'encore_song_arrange_type', 'class' => 'form-control']) !!}
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
                {{Form::hidden('event_id', $params['event_id'], ['id' => 'event_id'])}}
                {{Form::hidden('artist_id', $params['artist']['artist_id'], ['id' => 'artist_id'])}}
                
                <div class="form-group">
                    <div class="col-sm-12 col-12">
                        {!! Form::submit('送信', ['class' => 'btn btn-default']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="panel-footer">
            {{ link_to('/', '戻る') }}
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
		
		// オートコンプリート
//		$(document).on('ontouched click', '.autocomplete', function(){
//			var text = $(this).data('autocomplete');
//			var target = $(this).data('target');
//			$('input[name="' + target + '"]').val(text);
//		});
		
		$('#event_date').pickadate({
			format: 'yyyy-mm-dd'
		});
		
		$('#event_time').pickatime({
			format: 'HH:i', // 24時間表記
			interval: 30,   // 表示間隔
		});
		
//		// 日付選択
//		$('#datetimepicker1').datetimepicker({
//            dayViewHeaderFormat: 'YYYY年 M月',
//            format: 'YYYY年MM月DD日',
//            locale: moment.locale('ja', {
//                week: { dow: 0 }
//            }),
//            viewMode: 'days',
//            buttons: {
//                showClose: true
//            },
//        });
//		
//        $('#datetimepicker2').datetimepicker({
//            tooltips: {
//                close: '閉じる',
//                pickHour: '時間を取得',
//                incrementHour: '時間を増加',
//                decrementHour: '時間を減少',
//                pickMinute: '分を取得',
//                incrementMinute: '分を増加',
//                decrementMinute: '分を減少',
//                pickSecond: '秒を取得',
//                incrementSecond: '秒を増加',
//                decrementSecond: '秒を減少',
//                togglePeriod: '午前/午後切替',
//                selectTime: '時間を選択'
//            },
//            format: 'HH:mm',
//            locale: 'ja',
//            buttons: {
//                showClose: true
//            },
//            // disabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 8, 19, 20, 21, 22, 23],
//            enabledHours: [ 9,10, 11, 12, 13, 14, 15, 16, 17,18]
//
//        });
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
	    
	    .datepicker{
			border: 2px solid #ccc;
			font-size: 20px;
		}
    </style>

@endsection