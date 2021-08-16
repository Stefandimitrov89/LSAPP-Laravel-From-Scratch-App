@extends('layouts.app')

@section('content')
    <h3>Posts</h3>
    @if(count($posts) > 0 )
        @foreach($posts as $post)
            <div class="card p-3">
                <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <small> Written in {{$post->created_at}}</small>
            </div>
        @endforeach
        {{ $posts->links() }}
    @else
        <p>No posts found</p>
    @endif
@endsection