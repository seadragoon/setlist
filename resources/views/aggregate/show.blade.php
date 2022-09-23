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
            期間内でのライブ出演回数: {{ $params['live_count'] }}回<br>
            <br>
            <h4>演奏回数ランキング</h4>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is-own" name="is-own" value="">
                <label class="form-check-label">自身の楽曲のみ表示</label>
            </div>
            <br>
            <h6>ソート切り替え(降順)</h6>
            <div class="form-check form-check-inline">
                <div class="radio-inline">
                    <input class="form-check-input" type="radio" id="sort" name="sort_group" value="1" checked="checked">
                    <label class="form-check-label">回数　</label>
                </div>
                <div class="radio-inline">
                    <input class="form-check-input" type="radio" id="sort" name="sort_group" value="2">
                    <label class="form-check-label">採用率　</label>
                </div>
                <div class="radio-inline">
                    <input class="form-check-input" type="radio" id="sort" name="sort_group" value="3">
                    <label class="form-check-label">初回日付　</label>
                </div>
                <div class="radio-inline">
                    <input class="form-check-input" type="radio" id="sort" name="sort_group" value="4">
                    <label class="form-check-label">最終日付　</label>
                </div>
            </div>
            <br>
            <br>
            <p class="text-secondary">　※採用率：初回演奏時からの演奏確率（最近の曲は高くなる傾向にあり、統計として十分なデータが揃っていない可能性があります）</p>
            <br>
            <br>
            <div class="d-none d-sm-flex">
                <div class="col-sm-6">楽曲名</div>
                <div class="col-sm-1">回数</div>
                <div class="col-sm-1">採用率</div>
                <div class="col-sm-2">初回日付</div>
                <div class="col-sm-2">最終日付</div>
            </div>
            <div class="mx-2" id="result-area">
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
    // 変数定義
    let results = @json($params['result']);
    
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

        // チェックボックス制御
		$('input#is-own').change(function(){
            if($(this).prop('checked')){
                // チェックがある場合の処理
                ShowResult(true);
            } else {
                // チェックがない場合の処理
                ShowResult(false);
            }
		});

        // ラジオボタン制御（ソート切り替え）
		$('input#sort').change(function(){
            let radioVal = parseInt($(this).val());
            switch(radioVal){
                case 1:
                    results.sort((a, b) => b.count - a.count);
                    break;
                case 2:
                    results.sort((a, b) => b.rate - a.rate);
                    break;
                case 3:
                    results.sort((a, b) => Date.parse(b.first_date) - Date.parse(a.first_date));
                    break;
                case 4:
                    results.sort((a, b) => Date.parse(b.last_date) - Date.parse(a.last_date));
                    break;
            }

            let isOwn = $('input#is-own').prop('checked');
            ShowResult(isOwn);
		});

        // 初回表示
        ShowResult(false);
	});

    function ShowResult(isOwn)
    {
		let resultHtml = ''; // HTMLを組み立てる変数

        for (let i = 0; i < results.length; i++) {
            const songData = results[i];
            if (isOwn && songData.is_own === false)
            {
                // 自分の楽曲のみ表示の場合は他アーティスト楽曲は非表示
                continue;
            }
            if(i == 0) {
                resultHtml += '<div class="row border-top border-bottom py-2">';
            } else {
                resultHtml += '<div class="row border-bottom py-2">';
            }

            {
                resultHtml += '<div class="col-sm-6 col-6">';
                resultHtml += '<a href="/songs/' + songData.song_id + '">' + songData.name + '</a>';
                resultHtml += '</div>';

                resultHtml += '<div class="col-sm-1 col-1">';
                resultHtml += songData.count + '回';
                resultHtml += '</div>';

                resultHtml += '<div class="col-sm-1 col-1">';
                resultHtml += songData.rate + '%';
                resultHtml += '</div>';

                resultHtml += '<div class="col-sm-2 col-2">';
                resultHtml += (songData.first_date_short == null) ? '-' : songData.first_date_short;
                resultHtml += '</div>';

                resultHtml += '<div class="col-sm-2 col-2">';
                resultHtml += (songData.last_date_short == null) ? '-' : songData.last_date_short;
                resultHtml += '</div>';
            }

            resultHtml += '</div>';
        }

		document.querySelector('#result-area').innerHTML = resultHtml;
    }
    </script>
    
@endsection