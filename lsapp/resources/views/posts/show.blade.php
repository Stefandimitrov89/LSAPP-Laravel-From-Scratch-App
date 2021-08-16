@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-light m-3">Go back</a>
    <div class="card p-3">
        <h4>{{$post->title}}</h4>
        <div>{{$post->body}}</div>
        <hr>
        <small> Written in {{$post->created_at}}</small>
    </div>
@endsection