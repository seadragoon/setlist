@extends('layouts.app')

@section('title', '集計機能')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <h2>集計機能</h2>
            <h4>演奏回数ランキング</h4>
            <div class="d-none d-sm-flex">
                <div class="col-sm-8">楽曲名</div>
                <div class="col-sm-4">回数</div>
            </div>
            <div class="mx-2">
                @foreach ($params as $data)
                    @if($loop->iteration == 1)
                    <div class="row border-top border-bottom py-2">
                    @else
                    <div class="row border-bottom py-2">
                    @endif
                        <div class="col-sm-8 col-10">
                            {{ $data['name'] }}
                        </div>
                        <div class="col-sm-4 col-2">
                            {{ $data['count'] }}回
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection