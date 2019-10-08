@extends('layouts.app')

@section('title', $param['artist']->name)

@section('content')

    <div class="panel panel-default">
        
        <hr>
        <h4>アーティストデータ</h4>
        <div class="panel-body">
            <div>
                アーティスト名: {{ $param['artist']->name }}
            </div>
        </div>
        <br>
        {{ link_to_route('artists.edit', '編集', $param['artist']->artist_id, ['class' => 'btn btn-sm btn-default']) }}
        <br>
        <h4>楽曲追加</h4>
        {{ link_to_action('SongsController@add', '追加', ['artist_id' => $param['artist']->artist_id], ['class' => 'btn btn-sm btn-default']) }}
        <br>
        <h4>楽曲リスト（全{{ count($param['songs']) }}曲）</h4>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>名</th>
                    <th>編集</th>
                    <th>削除</th>
                </thead>
                <tbody>
                    @foreach ($param['songs'] as $key => $song)
                        <tr>
                            <td class="table-text">
                                {{ link_to_route('songs.show', $song->name, $song->song_id) }}
                            </td>
                            <td class="table-text">
                                {{ link_to_route('songs.edit', '編集', $song->song_id, ['class' => 'btn btn-sm btn-default']) }}
                            </td>
                            <td class="table-text">
                                {{ Form::open(['route' => ['songs.destroy', $song->song_id], 'method' => 'delete', 'class' => 'form_delete']) }}
                                    {{ Form::hidden('song_id', $song->song_id) }}
                                    {{ Form::submit('削除', ['class' => 'btn btn-sm btn-default']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
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