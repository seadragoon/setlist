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
            イベント追加
        </div>
        <div class="panel-body">
        	<hr>
            {!! Form::model($params, ['route' => 'events.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
            	<h4>イベント詳細</h4>
				<div class="form-group">
					<div class="table-responsive">
						<table class="table table-borderless table-condensed">
							<thead>
								<td>日付</td>
								<td>開始時間</td>
							</thead>
							<tbody>
								<tr>
									<td>
										{!! Form::text('event_date', old('event_date', $params['event_date']), ['id' => 'event_date', 'class' => 'datepicker']) !!}
									</td>
									<td>
										{!! Form::text('event_time', old('event_time', $params['event_time']), ['id' => 'event_time', 'class' => 'datepicker']) !!}
									</td>
								</tr>
								@if(!empty($errors->first('event_date')) || !empty($errors->first('event_time')))
								<tr>
									<td>
										@if(!empty($errors->first('event_date')))
											<span class="text-danger">※必須項目です</span>
										@endif
									</td>
									<td>
										@if(!empty($errors->first('event_time')))
											<span class="text-danger">※必須項目です</span>
										@endif
									</td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
                <div class="form-group">
                    {!! Form::label('event_name', 'イベント名', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8 col-xs-12">
                        {!! Form::text('event_name', old('event_name', $params['event_name']), ['id' => 'event_name', 'class' => 'form-control']) !!}
	                    @if(!empty($errors->first('event_name')))
	                    	<span class="text-danger">※必須項目です</span>
	                    @endif
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('event_venue', '会場名', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8 col-xs-12">
                        {!! Form::text('event_venue', old('event_venue', $params['event_venue']), ['id' => 'event_venue', 'class' => 'form-control']) !!}
                        @if(!empty($errors->first('event_venue')))
	                    	<span class="text-danger">※必須項目です</span>
	                    @endif
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('event_summary', 'イベント概要', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8 col-xs-12">
                        {!! Form::text('event_summary', old('event_summary', $params['event_summary']), ['id' => 'event_summary', 'class' => 'form-control']) !!}
                    </div>
                </div>
                
                <hr>
                <h4>セットリスト</h4>
                <button type="button" id="addButton">追加</button>
                <button type="button" id="removeButton">削除</button>
                <div id="songListArea">
                	@if(!empty(old('song_names', $params['song_names'])))
	                	@foreach (old('song_names', $params['song_names']) as $index => $old_name)
						<div class="form-group" id="song_{{$index + 1}}">
		                	<div class="row col-sm-8 col-xs-12">
			                	<div class="col-sm-3">
				                    {!! Form::label('song_seq_title', '楽曲番号', ['class' => 'control-label']) !!}
			                    </div>
			                    <div class="col-sm-1">
			                        {!! Form::label('song_seq', ($index + 1), ['id' => 'song_seq_label', 'class' => 'control-label']) !!}
			                    </div>
			                	<div class="col-sm-2">
			                    	{!! Form::label('song_name', '楽曲名', ['class' => 'control-label']) !!}
			                    </div>
			                    <div class="col-sm-6">
			                    	<div class="dropdown">
				                        {!! Form::text('song_names['.$index.']', $old_name, ['id' => 'song_'.($index + 1), 'class' => 'form-control dropdown-toggle', 'autocomplete' => 'off', 'list' => 'test']) !!}
				                        <datalist id="test">
					                        @foreach ($params['songs'] as $song)
												<option value="{{ $song->name }}">
											@endforeach
										</datalist>
								    </div>
			                    </div>
		                    </div>
		                    @if(!empty($errors->first('song_names.'.$index)))
		                    	<span class="text-danger">※曲名が入力されていないか、正しくありません</span>
		                    @endif
		                </div>
		                @endforeach
		            @else
		                <div class="form-group" id="song_1">
		                	<div class="row col-sm-8 col-xs-12">
			                	<div class="col-sm-3">
				                    {!! Form::label('song_seq_title', '楽曲番号', ['class' => 'control-label']) !!}
			                    </div>
			                    <div class="col-sm-1">
			                        {!! Form::label('song_seq', 1, ['id' => 'song_seq_label', 'class' => 'control-label']) !!}
			                    </div>
			                	<div class="col-sm-2">
			                    	{!! Form::label('song_name', '楽曲名', ['class' => 'control-label']) !!}
			                    </div>
			                    <div class="col-sm-6">
			                    	<div class="dropdown">
				                        {!! Form::text('song_names[0]', '', ['id' => 'song_1', 'class' => 'form-control dropdown-toggle', 'autocomplete' => 'off', 'list' => 'test']) !!}
				                        <datalist id="test">
					                        @foreach ($params['songs'] as $song)
												<option value="{{ $song->name }}">
											@endforeach
										</datalist>
								    </div>
			                    </div>
		                    </div>
		                </div>
		            @endif
                </div>
                <!-- hidden parameter -->
                {{Form::hidden('event_id', $params['event_id'], ['id' => 'event_id'])}}
                {{Form::hidden('artist_id', $params['artist']['artist_id'], ['id' => 'artist_id'])}}
                {{Form::hidden('setlist_group_type', 0, ['id' => 'setlist_group_type'])}}
                
                <hr>
                <div class="form-group">
                	<div class="row justify-content-end">
	                    <div class="col-sm-6">
	                        {!! Form::submit('送信', ['class' => 'btn btn-default']) !!}
	                    </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="panel-footer">
            {{ link_to('/', '戻る') }}
        </div>
    </div>
    
    
    <script>
	$(function(){
		@if(!empty(old('song_names')))
		var index = {{count(old('song_names'))}};
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
				.find("#song_1")
				.attr("id", "song_" + index)
				.attr("name", "song_names[" + (index - 1) + "]")
				// テキストを空に
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