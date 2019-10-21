@extends('layouts.app')

@section('title', 'イベント情報検索')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <br>
            <h2>イベント情報検索</h2>
            {!! Form::open(['action' => 'EventsController@search', 'method' => 'get', 'class' => 'form-inline']) !!}
                {{ Form::label('keyword_label', '検索ワード：', ['id' => 'keyword_label', 'class' => 'control-label']) }}
                {{ Form::text('keyword', $params['keyword'], ['class' => 'form-control', 'placeholder' => '検索...', 'aria-label' => '検索...']) }}
                {!! Form::submit('検索', ['class' => 'btn']) !!}
            {!! Form::close() !!}
            <br>
            <h4>イベント検索結果</h4>
            検索ワード「{{ $params['keyword'] }}」での検索結果<br>
            {{ count($params['result']) }}件のイベントが見付かりました。<br>
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
        </div>
        <br>
        <div class="panel-footer">
            {{ link_to(url()->previous(), '戻る') }}
        </div>
    </div>

@endsection