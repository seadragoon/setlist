@extends('layouts.app')

@section('title', 'イベント一覧')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            イベント一覧
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
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
                            <!--
                            <td class="table-text">
                                {{-- link_to_route('tasks.edit', '編集', $task->id, ['class' => 'btn btn-sm btn-default']) --}}
                            </td>
                            <td class="table-text">
                                {{-- Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) --}}
                                    {{-- Form::hidden('id', $task->id) --}}
                                    {{-- Form::submit('削除', ['class' => 'btn btn-sm btn-default']) --}}
                                {{-- Form::close() --}}
                            </td>
                            -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection