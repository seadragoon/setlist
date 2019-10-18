@extends('layouts.app')

@section('title', $params['artist']->name.'集計データ')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <h2>集計機能</h2>
            アーティスト名: {{ $params['artist']->name }}
            <br>
            <h4>演奏回数ランキング</h4>
            <div class="d-none d-sm-flex">
                <div class="col-sm-8">楽曲名</div>
                <div class="col-sm-4">回数</div>
            </div>
            <div class="mx-2">
                @foreach ($params['result'] as $value)
                    @if($loop->iteration == 1)
                    <div class="row border-top border-bottom py-2">
                    @else
                    <div class="row border-bottom py-2">
                    @endif
                        <div class="col-sm-8 col-10">
                            {{ link_to_route('songs.show', $value['name'], $value['song_id']) }}
                        </div>
                        <div class="col-sm-4 col-2">
                            {{ $value['count'] }}回
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