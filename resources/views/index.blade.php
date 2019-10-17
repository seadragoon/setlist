@extends('layouts.app')

@section('title', 'イベント一覧')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            イベント一覧
        </div>
        <div class="panel-body">
        
            <!--
            <div class="d-flex d-sm-none">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>
                                    <div>
                                        {{ date('Y年m月d日',  strtotime($event->datetime)) }}
                                    </div>
                                    <div>
                                        {{ link_to_route('events.show', $event->name, $event->event_id, ['class' => 'btn-default']) }}
                                    </div>
                                    <div>
                                        {{ $event->venue_name }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-none d-sm-flex">
                <table class="table table-striped">
                    <thead>
                        <th>日付</th>
                        <th>イベント名</th>
                        <th>会場名</th>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td class="table-text">
                                    {{ date('Y年m月d日',  strtotime($event->datetime)) }}
                                </td>
                                <td class="table-text">
                                    {{ link_to_route('events.show', $event->name, $event->event_id, ['class' => 'btn btn-sm btn-default']) }}
                                </td>
                                <td class="table-text">
                                    {{ $event->venue_name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            -->
            
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
        </div>
    </div>

@endsection