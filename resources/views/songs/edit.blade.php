@extends('layouts.app')

@section('title', "$song->nameの編集")

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <br>
            <h4>楽曲編集</h4>
            ・{{ $song->name }} の編集
            <br>
            <br>
        </div>
        <div class="panel-body">
            {!! Form::model($song, ['route' => ['songs.update', $song->song_id], 'method' => 'patch', 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name', '楽曲名', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name', $song->name, ['id' => 'song_name', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        {!! Form::button('<i class="fa fa-save"></i> 保存', ['type' => 'submit', 'class' => 'btn btn-default']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="panel-footer">
            @if (url()->previous() === url()->current())
                {{ link_to_route('artists.show', '戻る', $song->artist_id) }}
            @else
                {{ link_to(url()->previous(), '戻る') }}
            @endif
        </div>
    </div>

@endsection