@extends('layouts.app')

@section('title', "$artist->nameの編集")

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $artist->name }}の編集
        </div>
        <div class="panel-body">
            {!! Form::model($artist, ['route' => ['artists.update', $artist->artist_id], 'method' => 'patch', 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'アーティスト名', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name', $artist->name, ['id' => 'artist_name', 'class' => 'form-control']) !!}
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
            {{ link_to(url()->previous(), '戻る') }}
        </div>
    </div>

@endsection