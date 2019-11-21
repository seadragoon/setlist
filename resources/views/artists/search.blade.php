@extends('layouts.app')

@section('title', 'アーティスト情報検索')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <br>
            <h4>アーティスト情報検索</h4>
            {!! Form::open(['action' => 'ArtistsController@search', 'method' => 'get', 'class' => 'form-inline']) !!}
                {{ Form::label('keyword_label', '検索ワード：', ['id' => 'keyword_label', 'class' => 'control-label']) }}
                {{ Form::text('keyword', $params['keyword'], ['class' => 'form-control', 'placeholder' => '検索...', 'aria-label' => '検索...']) }}
                {!! Form::submit('検索', ['class' => 'btn']) !!}
            {!! Form::close() !!}
            <br>
            <br>
            @if(!empty($params['keyword']))
                <h4>イベント検索結果</h4>
                検索ワード「{{ $params['keyword'] }}」での検索結果<br>
                @if($params['result']->total() > 0)
                    {{ $params['result']->total() }}件のアーティストが見付かりました。({{ $params['result']->currentPage() }}/{{ $params['result']->lastPage() }})
                    <br>
                    <table class="table table-striped task-table">
                        <thead>
                            <th>名</th>
                            @auth
                            <th>編集</th>
                            <!--
                            <th>削除</th>
                            -->
                            @endauth
                        </thead>
                        <tbody>
                            @foreach ($params['result'] as $artist)
                                <tr>
                                    <td class="table-text">
                                        {{ link_to_route('artists.show', $artist->name, $artist->artist_id) }}
                                    </td>
                                    @auth
                                    <td class="table-text">
                                        {{ link_to_route('artists.edit', '編集', $artist->artist_id, ['class' => 'btn btn-sm btn-default btn-success']) }}
                                    </td>
                                    
                                    <!--
                                    // 一旦削除は非表示にしておく
                                    <td class="table-text">
                                        {{ Form::open(['route' => ['artists.destroy', $artist->artist_id], 'method' => 'delete', 'class' => 'form_delete']) }}
                                            {{ Form::hidden('artist_id', $artist->artist_id) }}
                                            {{ Form::submit('削除', ['class' => 'btn btn-sm btn-default']) }}
                                        {{ Form::close() }}
                                    </td>
                                    -->
                                    @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- page control -->
                    <br>
                    {!! $params['result']->render() !!}
                @else
                    アーティストが見付かりませんでした。
                @endif
            @endif
        </div>
        <br>
        <div class="panel-footer">
            {{ link_to(url()->previous(), '戻る') }}
        </div>
    </div>

@endsection