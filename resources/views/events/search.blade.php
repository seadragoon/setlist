@extends('layouts.app')

@section('title', 'イベント情報検索')

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
            <h4>イベント情報検索</h4>
            {!! Form::open(['action' => 'EventsController@search', 'method' => 'get', 'class' => 'form-block']) !!}
                <div class="form-group col-sm-6">
                    {{ Form::label('keyword_label', '検索ワード：', ['id' => 'keyword_label', 'class' => 'control-label']) }}
                    {{ Form::text('keyword', $params['keyword'], ['class' => 'form-control', 'placeholder' => '検索...', 'aria-label' => '検索...']) }}
                </div>
				<div class="form-group col-sm-8">
                	{!! Form::label('date_from_name', '期間開始', ['class' => 'col-sm-4 col-5 control-label']) !!}
                	{!! Form::label('wavy_line', '～', ['class' => 'col-sm-1 col-1 control-label']) !!}
                	{!! Form::label('date_to_name', '期間終了', ['class' => 'col-sm-4 col-5 control-label']) !!}
                    {!! Form::text('date_from', old('date_from', $params['date_from']), ['id' => 'date_from', 'class' => 'datepicker col-sm-4 col-5']) !!}
                	{!! Form::label('wavy_line', '～', ['class' => 'col-sm-1 col-1 control-label']) !!}
                    {!! Form::text('date_to', old('date_to', $params['date_to']), ['id' => 'date_to', 'class' => 'datepicker col-sm-4 col-5']) !!}
				</div>
                <div class="form-group col-sm-6">
                    {!! Form::submit('検索', ['class' => 'btn']) !!}
                </div>
            {!! Form::close() !!}
            <br>
            <h4>イベント検索結果</h4>
            @if(!empty($params['keyword']))
                検索ワード「{{ $params['keyword'] }}」での検索結果<br>
            @endif
            @if($params['result']->total() > 0)
                {{ $params['result']->total() }}件のイベントが見付かりました。({{ $params['result']->currentPage() }}/{{ $params['result']->lastPage() }})
                <br>
                <div class="d-none d-sm-flex">
                    <div class="col-sm-5">イベント名</div>
                    <div class="col-sm-3">日付</div>
                    <div class="col-sm-4">会場名</div>
                </div>
                <div class="mx-2">
                    @foreach ($params['result'] as $event)
                        @if($loop->iteration == 1)
                        <div class="row border-top border-bottom py-2">
                        @else
                        <div class="row border-bottom py-2">
                        @endif
                            <div class="col-sm-5 col-12">
                                {{ link_to_route('events.show', $event->name, $event->event_id, ['class' => 'btn-default']) }}
                            </div>
                            <div class="col-sm-3 col-12">
                                {{ date('Y年m月d日',  strtotime($event->datetime)) }}
                            </div>
                            <div class="col-sm-4 col-12">
                                {{ $event->venue_name }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- page control -->
                <br>
                {!! $params['result']->render() !!}
            @else
                イベントが見付かりませんでした。
            @endif
            @if(!empty($params['date_from']) && $params['date_from'] === $params['date_to'])
                <br>
                <h4>追加</h4>
                {{ link_to_route('events.create', $params['date_from'].'のイベントを追加', array('date' => $params['date_from'], 'artist_id' => $params['artist_id']), ['class' => 'btn btn-sm btn-default']) }}
                <br>
            @endif
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

@section('script')
    
    <script>
	$(function(){
        // これがないと画面に戻った時に勝手にカレンダーが表示される
		$(window).on("focus", function () {
			$(document.activeElement).blur();
		});
		$('#date_from').pickadate({
			format: 'yyyy-mm-dd',
            selectYears: true,
		});
		$('#date_to').pickadate({
			format: 'yyyy-mm-dd',
            selectYears: true,
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
	    
	    .datepicker{
			border: 2px solid #ccc;
			font-size: 16px;
		}
    </style>

@endsection