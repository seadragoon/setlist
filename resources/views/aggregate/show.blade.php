@extends('layouts.app')

@section('title', $params['artist']->name.'集計データ')

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
            <h2>集計機能</h2>
            アーティスト名: {{ $params['artist']->name }}<br>
            <br>
            {!! Form::open(['action' => array('AggregateController@show', $params['artist']->artist_id), 'method' => 'get', 'class' => 'form-block']) !!}
				<div class="form-group col-sm-8">
                	{!! Form::label('date_from_name', '期間開始', ['class' => 'col-sm-4 col-5 control-label']) !!}
                	{!! Form::label('wavy_line', '～', ['class' => 'col-sm-1 col-1 control-label']) !!}
                	{!! Form::label('date_to_name', '期間終了', ['class' => 'col-sm-4 col-5 control-label']) !!}
                    {!! Form::text('date_from', old('date_from', $params['date_from']), ['id' => 'date_from', 'class' => 'datepicker col-sm-4 col-5']) !!}
                	{!! Form::label('wavy_line', '～', ['class' => 'col-sm-1 col-1 control-label']) !!}
                    {!! Form::text('date_to', old('date_to', $params['date_to']), ['id' => 'date_to', 'class' => 'datepicker col-sm-4 col-5']) !!}
				</div>
                <div class="form-group col-sm-6">
                    {!! Form::submit('絞り込み', ['class' => 'btn']) !!}
                </div>
            {!! Form::close() !!}
            <br>
            <h4>演奏回数ランキング</h4>
            <div class="d-none d-sm-flex">
                <div class="col-sm-8">楽曲名</div>
                <div class="col-sm-4">回数</div>
            </div>
            <div class="mx-2">
                @foreach ($params['result'] as $value)
                    @if($loop->iteration == 1)
                    <div class="row border-top border-bottom py-2">
                    @else
                    <div class="row border-bottom py-2">
                    @endif
                        <div class="col-sm-8 col-9">
                            {{ link_to_route('songs.show', $value['name'], $value['song_id']) }}
                        </div>
                        <div class="col-sm-4 col-3">
                            {{ $value['count'] }}回
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="panel-footer">
            @if (url()->previous() === url()->current())
                {{ link_to('/aggregate', '戻る') }}
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
		$('#date_from').pickadate({
            format: 'yyyy-mm-dd',
			firstDay: 0,
            selectYears: true,
		});
		$('#date_to').pickadate({
			format: 'yyyy-mm-dd',
			firstDay: 0,
            selectYears: true,
		});
	});
    </script>
    
@endsection