@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($posts as $post)
            <div class="col-8 mb-3">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('post.show', ['link' => $post->link]) }}">
                            {!! $post->title !!}
                        </a>
                    </div>
                    <div class="card-body">
                        {!! $post->excerpt !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        @if(isset($prev) && $prev)
            <div class="col-auto mr-auto">
                <a href="{{ route('home', ['page' => $prev]) }}">&#8592; Предыдущие статьи</a>
            </div>
        @endif
        @if(isset($next) && $next)
            <div class="col-auto ml-auto">
                <a href="{{ route('home', ['page' => $next]) }}">Следующие статьи &#8594;</a>
            </div>
        @endif
    </div>
</div>
@endsection
