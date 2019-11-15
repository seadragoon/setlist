@extends('layouts.app')

@section('title', 'アーティスト情報')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <br>
            <h4>アーティスト検索</h4>
            {!! Form::open(['action' => 'ArtistsController@search', 'method' => 'get', 'class' => 'form-inline']) !!}
                {{ Form::label('keyword_label', '検索ワード：', ['id' => 'keyword_label', 'class' => 'control-label']) }}
                {{ Form::text('keyword', null, ['class' => 'form-control', 'placeholder' => '検索...', 'aria-label' => '検索...']) }}
                {!! Form::submit('検索', ['class' => 'btn']) !!}
            {!! Form::close() !!}
            <br>

            @auth
            <h4>アーティスト追加</h4>
                {{ link_to_action('ArtistsController@add', '追加', null, ['class' => 'btn btn-sm btn-default btn-primary']) }}
                <br>
            <br>
            @endauth
            
            <h4>アーティスト一覧</h4>
            ※アーティスト名をタップすると曲一覧が表示されます
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
                    @foreach ($artists as $artist)
                        <tr>
                            <td class="table-text">
                                {{ link_to_route('artists.show', $artist->name, $artist->artist_id) }}
                            </td>
                            @auth
                            <td class="table-text">
                                {{ link_to_route('artists.edit', '編集', $artist->artist_id, ['class' => 'btn btn-sm btn-default']) }}
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
            <br>
        </div>
        <div class="panel-footer">
            {{ link_to(url()->previous(), '戻る') }}
        </div>
    </div>
    
	<script>
	$(function(){
		$(".form_delete").submit(function(){
			if(!confirm('本当に削除しますか？')){
				return false;
			}
		});
	});
	</script>

@endsection