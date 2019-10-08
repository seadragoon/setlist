@extends('layouts.app')

@section('title', "楽曲追加")

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $param['artist']->name }}の楽曲追加
        </div>
        <div class="panel-body">
            {!! Form::model($param['song'], ['route' => 'songs.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name', '楽曲名', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name', $param['song']->name, ['id' => 'song_name', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        {!! Form::submit('追加', ['class' => 'btn btn-default']) !!}
                    </div>
                </div>
                {{ Form::hidden('artist_id', $param['artist']->artist_id) }}
            {!! Form::close() !!}
        </div>
        <div class="panel-footer">
            {{ link_to_route('artists.show', '戻る', $param['artist']->artist_id) }}
        </div>
    </div>

@endsection