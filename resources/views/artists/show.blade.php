@extends('layouts.app')

@section('title', $param['artist']->name)

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
			<br>
        	<h4>アーティストデータ</h4>
            <div>
                アーティスト名: {{ $param['artist']->name }}
            </div>
            <div>
				<p class="text-muted">※最終編集者: {{ $param['lastEditUserName'] }} ({{ $param['lastEditTime'] }})</p>
            </div>

			@auth
			{{ link_to_route('artists.edit', '編集', $param['artist']->artist_id, ['class' => 'btn btn-sm btn-default btn-success']) }}
			<br>
			@endauth
			<br>
			
			<h4>集計ページ</h4>
			{{ link_to('aggregate/show/'.$param['artist']->artist_id, '集計ページへ', ['class' => 'btn btn-sm btn-default btn-primary']) }}
			<br>
			<br>

			<h4>イベントカレンダー</h4>
			<button id="prev" type="button" class="btn btn-default">前の月</button>
			<button id="next" type="button" class="btn btn-default">次の月</button>
			<div id="event-calendar"></div>
			<br>

			@auth
			<h4>楽曲追加</h4>
			{{ link_to_action('SongsController@add', '追加', ['artist_id' => $param['artist']->artist_id], ['class' => 'btn btn-sm btn-default btn-primary']) }}
			<br>
			<br>
			@endauth
			
			<h4>楽曲リスト（全{{ count($param['songs']) }}曲）</h4>
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<th>名</th>
						@auth
						<th>編集</th>
						<th>削除</th>
						@endauth
					</thead>
					<tbody>
						@foreach ($param['songs'] as $key => $song)
							<tr>
								<td class="table-text">
									{{ link_to_route('songs.show', $song->name, $song->song_id) }}
								</td>
								@auth
								<td class="table-text">
									{{ link_to_route('songs.edit', '編集', $song->song_id, ['class' => 'btn btn-sm btn-default btn-success']) }}
								</td>
								<td class="table-text">
									{{ Form::open(['route' => ['songs.destroy', $song->song_id], 'method' => 'delete', 'class' => 'form_delete']) }}
										{{ Form::hidden('song_id', $song->song_id) }}
										{{ Form::submit('削除', ['class' => 'btn btn-sm btn-default btn-danger']) }}
									{{ Form::close() }}
								</td>
								@endauth
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<br>
        </div>
        <div class="panel-footer">
            {{ link_to(url()->previous(), '戻る') }}
        </div>
    </div>
    
@endsection

@section('script')
    
	<script>
	// 定数定義
	const weeks = ['日', '月', '火', '水', '木', '金', '土'];
	const todayDate = new Date();
	const artistName = "{{ $param['artist']->name }}";
	const eventDates = {!! $param['datesString'] !!};
	// 変数定義・初期化
	let year = todayDate.getFullYear();
	let month = todayDate.getMonth() + 1;
	
	$(function(){
		// 削除ボタンの確認処理
		$(".form_delete").submit(function(){
			if(!confirm('本当に削除しますか？')){
				return false;
			}
		});
		
		// カレンダー表示制御
		
		// 前の月ボタン
		$('button#prev').on('click', function(){
			month -= 1;
			if(month < 1) {
				year -= 1;
				month = 12;
			}
			showCalendar(year, month);
		});
		// 次の月ボタン
		$('button#next').on('click', function(){
			month += 1;
			if(month > 12) {
				year += 1;
				month = 1;
			}
			showCalendar(year, month);
		});
		
		// 初回表示
		showCalendar(year, month);
	});
	
	// カレンダーを表示する
	function showCalendar(year, month)
	{
		const startDate = new Date(year, month - 1, 1); // 月の最初の日を取得
		const endDate = new Date(year, month,  0); // 月の最後の日を取得
		const endDayCount = endDate.getDate(); // 月の末日
		const lastMonthEndDate = new Date(year, month - 1, 0); // 前月の最後の日の情報
		const lastMonthendDayCount = lastMonthEndDate.getDate(); // 前月の末日
		const startDay = startDate.getDay(); // 月の最初の日の曜日を取得
		let dayCount = 1; // 日にちのカウント
		let calendarHtml = ''; // HTMLを組み立てる変数

		calendarHtml += '<h5>' + year  + '/' + month + '</h5>';
		calendarHtml += '<table class="table table-bordered table-condensed">';

		// 曜日の行を作成
		for (let i = 0; i < weeks.length; i++) {
		    calendarHtml += '<td><div class="weekday day' + i + '">' + weeks[i] + '</td>';
		}

		// 日付を6週分作成
		for (let w = 0; w < 6; w++) {
		    calendarHtml += '<tr>';

		    for (let d = 0; d < 7; d++) {
		        if (w == 0 && d < startDay) {
		            // 1行目で1日の曜日の前
		        	calendarHtml += '<td></td>';
		        	// let num = lastMonthendDayCount - startDay + d + 1;
		            // calendarHtml += '<td><div class="cell"><a href="/"><p class="day is-disabled">' + num + '</p><p class="count">' + 0 + '<span>件</span></p></a></div></td>';
		        } else if (dayCount > endDayCount) {
		            // 末尾の日数を超えた
		        	calendarHtml += '<td></td>';
		        	
		        	// 最終週だったら終了
		        	if (w === 5) {
		        		break;
		        	}
		        	// let num = dayCount - endDayCount;
            		// calendarHtml += '<td><div class="cell"><a href="/"><p class="day is-disabled">' + num + '</p><p class="count">' + 0 + '<span>件</span></p></a></div></td>';
		        	// dayCount++;
		        } else {
		        	const date = year + '-' + month + '-' + dayCount;
		        	let count = 0;
		        	eventDates.forEach(function(eventDate){
		        		if (eventDate === date) {
		        			count += 1;
		        		}
		        	});
		            calendarHtml += '<td><div class="cell"><a href="/events/search?keyword=' + artistName + '&date_from=' + date + '&date_to=' + date +  '">';
		            calendarHtml += '<p class="day">' + dayCount + '</p>';
		        	if (count === 0) {
			        	calendarHtml += '<p class="count is-zero">' + count + '<span>件</span></p>';
		        	} else {
			        	calendarHtml += '<p class="count">' + count + '<span>件</span></p>';
		        	}
		            calendarHtml += '</a></div></td>';
		            dayCount++;
		        }
		    }
		    calendarHtml += '</tr>';
		}
		calendarHtml += '</table>';
		
		document.querySelector('#event-calendar').innerHTML = calendarHtml;
	}
	</script>

@endsection

@section('style')
    
    <style type="text/css">
	    .day0 {
	    	color: red;
	    }
	    .day6 {
	    	color: royalblue;
		}
		.table-condensed > thead > tr > th,
		.table-condensed > tbody > tr > th,
		.table-condensed > tfoot > tr > th,
		.table-condensed > thead > tr > td,
		.table-condensed > tbody > tr > td,
		.table-condensed > tfoot > tr > td {
			padding: 0px;  /* 12px の値を変更 */
		}
		.weekday {
			padding: 12px;
		}
		.cell a {
	    	display: block;
			text-decoration: none;
		}
		.cell .day {
			font-size: 12px;
			text-align: left;
			margin: 0px;
			color: black;
		}
		.cell .is-zero {
			color: #666;
		}
		.cell .count {
			font-size: 24px;
			text-align: center;
			margin: 0px;
		}
		.cell .count span {
			font-size: 10px;
			color: #666;
		}
    </style>

@endsection