@extends('layouts.app')

@if($params['isEdit'])
@section('title', 'イベント編集')
@else
@section('title', 'イベント追加')
@endif

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
			@if($params['isEdit'])
			<h4>イベント編集</h4>
			<p>既存イベントの編集を行えます。</p>
			@else
			<h4>イベント追加</h4>
			<p>新規イベントの追加を行えます。</p>
			@endif

        	<hr>
            {!! Form::model($params, ['route' => 'events.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
            	<h4>イベント詳細</h4>
				<div class="form-group">
					{!! Form::label('event_date_name', '日付', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-8 col-12">
						{!! Form::text('event_date', old('event_date', $params['event_date']), ['id' => 'event_date', 'class' => 'col-sm-6 col-8 datepicker']) !!}
						<button id="prev" type="button" class="btn btn-default">◀</button>
						<button id="next" type="button" class="btn btn-default">▶</button>
						@if(!empty($errors->first('event_date')))
							<br>
							<span class="text-danger">{{ $errors->first('event_date') }}</span>
						@endif
					</div>
				</div>
				<div class="form-group">
                	{!! Form::label('event_time_name', '開始時間', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-8 col-12">
						{!! Form::text('event_time', old('event_time', $params['event_time']), ['id' => 'event_time', 'class' => 'col-sm-6 col-8 datepicker']) !!}
						@if(!empty($errors->first('event_time')))
							<br>
							<span class="text-danger">{{ $errors->first('event_time') }}</span>
						@endif
					</div>
				</div>
                <div class="form-group">
                    {!! Form::label('event_name', 'イベント名', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8 col-12">
                        {!! Form::text('event_name', old('event_name', $params['event_name']), ['id' => 'event_name', 'class' => 'form-control']) !!}
	                    @if(!empty($errors->first('event_name')))
	                    	<span class="text-danger">{{ $errors->first('event_name') }}</span>
	                    @endif
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('event_venue', '会場名', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8 col-12">
                        {!! Form::text('event_venue', old('event_venue', $params['event_venue']), ['id' => 'event_venue', 'class' => 'form-control']) !!}
                        @if(!empty($errors->first('event_venue')))
	                    	<span class="text-danger">{{ $errors->first('event_venue') }}</span>
	                    @endif
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('event_summary', 'イベント概要', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8 col-12">
						{!! Form::textarea('event_summary', old('event_summary', $params['event_summary']), ['id' => 'event_summary', 'size' => '30x5', 'class' => 'form-control']) !!}
	                    @if(!empty($errors->first('event_summary')))
	                    	<span class="text-danger">{{ $errors->first('event_summary') }}</span>
	                    @endif
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('event_type', 'イベントタイプ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-8 col-12">
                		{!! Form::select('event_type', $params['eventTypeStrings'], old('event_type', $params['event_type']), ['id' => 'event_type', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('event_tag', 'タグ(カンマ区切りで入力してください)', ['class' => 'col-sm-6 control-label']) !!}
                    <div class="col-sm-8 col-12">
                        {!! Form::text('event_tag', old('event_tag', $params['event_tag']), ['id' => 'event_tag', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <hr>
                <!-- hidden parameter -->
                {{Form::hidden('event_id', $params['event_id'], ['id' => 'event_id'])}}
                
                <div class="form-group">
                    <div class="col-sm-12 col-12">
                        {!! Form::submit('送信', ['class' => 'btn btn-default']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="panel-footer">
            @if (url()->previous() === url()->current())
                {{ link_to('/', '戻る') }}
            @else
                {{ link_to(url()->previous(), '戻る') }}
            @endif
        </div>
    </div>
    
@endsection

@section('script')
    
    <script>
	$(function(){
		// これがないと画面に戻った時に勝手にカレンダーが表示される
		$(window).on("focus", function () {
			$(document.activeElement).blur();
		});
		// pick a date 日付
		$('#event_date').pickadate({
			format: 'yyyy-mm-dd',
            selectYears: true,
		});
		// pick a date 時間
		$('#event_time').pickatime({
			format: 'HH:i', // 24時間表記
			interval: 30,   // 表示間隔
		});
		// 前の年ボタン
		$('button#prev').on('click', function(){
			const date = getAddedYearDate($('#event_date').val(), -1);
			$('#event_date').val(getFormatDate(date));
			reflectToPicker(date);
		});
		// 次の年ボタン
		$('button#next').on('click', function(){
			const date = getAddedYearDate($('#event_date').val(), 1);
			$('#event_date').val(getFormatDate(date));
			reflectToPicker(date);
		});

		// 時間の初期値を入れておく
		const picker = $('#event_time').pickatime('picker');
		picker.set('select', new Date("2000-01-01 18:00:00"));
	});

	// pickerに反映させる
	function reflectToPicker (date)
	{
		const picker = $('#event_date').pickadate('picker');
		picker.set('select', date);
	}
	// 年を加算した日付を取得
	function getAddedYearDate (date_string, add_year)
	{
		const date = getDate(date_string);
		date.setYear(date.getFullYear() + add_year);
		return date;
	}
	// 指定日付のDateを取得
	function getDate (date_string)
	{
		return new Date(date_string + " 00:00:00");
	}
	// フォーマットされた日付を取得
	function getFormatDate (date)
	{
		const y = date.getFullYear();
		const m = date.getMonth() + 1;
		const d = date.getDate();
		return `${y}-${m}-${d}`;
	}
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