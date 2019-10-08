@extends('layouts.app')

@section('title', 'アーティスト一覧')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            アーティスト一覧
            （アーティスト名をタップすると曲一覧が表示されます）
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>名</th>
                    <th>編集</th>
                    <!--
                    <th>削除</th>
                    -->
                </thead>
                <tbody>
                    @foreach ($artists as $artist)
                        <tr>
                            <td class="table-text">
                                {{ link_to_route('artists.show', $artist->name, $artist->artist_id) }}
                            </td>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
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