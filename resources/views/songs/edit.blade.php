@extends('layouts.app')

@section('title', $params['song']->name."の編集")

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <br>
            <h4>楽曲編集</h4>
            ・{{ $params['song']->name }} の編集
            <br>
            <br>
        </div>
        <div class="panel-body">
            {!! Form::model($params, ['route' => ['songs.update', $params['song']->song_id], 'method' => 'patch', 'class' => 'form-horizontal']) !!}
                        
                <div class="form-group"> 
                    {!! Form::label('artist_name_title', 'アーティスト名', ['class' => 'col-sm-3 control-label']) !!}   
                    <div class="dropdown col-sm-6">
                        {!! Form::text('artist_name', $params['artist']->name, ['id' => 'artist_name', 'class' => 'form-control dropdown-toggle', 'autocomplete' => 'off', 'list' => 'artist_list']) !!}
                        <datalist id="artist_list">
                            @foreach ($params['artistMasters'] as $artist)
                                <option value="{{ $artist->name }}">
                            @endforeach
                        </datalist>
                    </div>
                    @if(!empty($errors->first('artist_not_found')))
                        <span class="text-danger">{{ $errors->first('artist_not_found') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('song_name_title', '楽曲名', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('song_name', $params['song']->name, ['id' => 'song_name', 'class' => 'form-control']) !!}
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
                {{ link_to_route('artists.show', '戻る', $params['song']->artist_id) }}
            @else
                {{ link_to(url()->previous(), '戻る') }}
            @endif
        </div>
    </div>

@endsection

@section('style')
    
    <style type="text/css">
	    .dropdown-menu {
	        overflow:auto;
	        max-height: 250px;
	        min-width: 100%;
	    }
    </style>

@endsection