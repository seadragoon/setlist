@extends('layouts.app')

@section('title', 'イベント情報')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <br>
            <h4>ホーム画面</h4>
            <h6>■このサイトについて</h6>
            <p>アーティストのライブセットリストを登録・集計するためのサイトです。<br>
            一つのイベントにそれぞれのアーティストのセットリストがぶら下がる想定です。<br>
            （あくまでもアーティスト毎の集計を目的としたい）</p>
            <h6>■追加したい機能</h6>
            <ul>
                <li>ダブルアンコール登録に対応</li>
                <li>セトリの集計の種類を増やす</li>
            </ul>
            <h6>■意見ください</h6>
            <p><a href='https://twitter.com/keiryu342'>@keiryu342</a>が趣味で作成しております。<br>
            要望ありましたらリプ・DMで意見くださると嬉しいです。<br>
            一部イベンターノート参考にしました。<br>
            あと多分スマートフォンからだとセトリ登録しずらいですが、登録協力してくださいm(_ _)m<br>
            (ガルニデですと、ミニライブ系が結構抜けてます)</p>
            <br>
            <h6>更新履歴</h6>
            <ul>
                <li>2020/01/30 イベントに閲覧注意フラグを追加しました。ツアー中などネタバレ防止にご使用頂けます。<br>
                (楽曲ページを見ると演奏したかどうかは分かってしまう気休め仕様ですのでお気をつけください)</li>
                <li>2022/08/02 集計ページで自身の楽曲かどうかのON/OFFができるようにしました。</li>
                <li>2022/09/23 集計ページで採用率・初回日付・最終日付の追加と、ソートをできるようにしました。</li>
            </ul>
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