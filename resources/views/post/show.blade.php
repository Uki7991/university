@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <h1>{!! $post->title !!}</h1>
            </div>
            <div class="col-8">
                {!! $post->content !!}
            </div>
        </div>
    </div>
@endsection
