@extends('layouts.app')

@section('title', "$artist->nameの編集")

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <br>
            <h4>アーティスト編集</h4>
            ・{{ $artist->name }} の編集
            <br>
            <br>
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
            @if (url()->previous() === url()->current())
                {{ link_to('/artists', '戻る') }}
            @else
                {{ link_to(url()->previous(), '戻る') }}
            @endif
        </div>
    </div>

@endsection