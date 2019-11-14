@extends('errors.layouts.base')

@section('title', '404 Not Found')

@section('message', 'The page of the corresponding address could not be found.')
{{-- 該当アドレスのページを見つける事ができませんでした。 --}}

@section('link')
  {{ link_to('/', 'to TOP&gt;&gt;') }}
@endsection