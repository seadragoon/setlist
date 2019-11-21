@extends('layouts.app')

@section('title', 'イベント情報')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <br>
            <h4>ホーム画面</h4>
            <h6>・このサイトについて</h6>
            アーティストのライブセットリストを登録・集計するためのサイトです。<br>
            <br>
            @if($events->total() > 0)
                <h4>直近のイベント一覧({{ $events->currentPage() }}/{{ $events->lastPage() }})</h4>
                <div class="d-none d-sm-flex">
                    <div class="col-sm-5">イベント名</div>
                    <div class="col-sm-3">日付</div>
                    <div class="col-sm-4">会場名</div>
                </div>
                <div class="mx-2">
                    @foreach ($events as $event)
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
                {!! $events->render() !!}
            @else
                <h4>直近のイベント一覧</h4>
                <p>イベントが登録されていません。</p>
            @endif
        </div>
    </div>

@endsection