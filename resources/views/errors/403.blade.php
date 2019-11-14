@extends('errors.layouts.base')

@section('title', '403 Forbidden')

@section('message', 'You do not have access.')
{{-- あなたにはアクセス権がありません。 --}}

@section('link')
  {{ link_to('/', 'to TOP&gt;&gt;') }}
@endsection