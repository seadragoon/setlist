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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection