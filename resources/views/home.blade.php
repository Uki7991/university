@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($posts as $post)
            <div class="col-8 mb-3">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ $post->link }}">
                            {{ $post->title }}
                        </a>
                    </div>
                    <div class="card-body">
                        {!! $post->excerpt !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
