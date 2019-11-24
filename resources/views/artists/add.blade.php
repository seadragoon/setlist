@extends('layouts.app')

@section('title', "アーティスト追加")

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
			<br>
        	<h4>アーティスト追加</h4>
            
            {!! Form::model($param['artist'], ['route' => 'artists.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'アーティスト名', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name', $param['artist']->name, ['id' => 'artist_name', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        {!! Form::submit('追加', ['class' => 'btn btn-default']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="panel-footer">
            {{ link_to_route('artists.index', '戻る') }}
        </div>
    </div>

@endsection