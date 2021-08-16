@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-light m-3">Go back</a>
    <div class="card p-3">
        <h4>{{$post->title}}</h4>
        <div>{!!$post->body!!}</div>
        <hr>
        <small> Written in {{$post->created_at}}</small>
    </div>
    <hr>
    <a href="/posts/{{$post->id}}/edit" class="btn btn-light">EDIT</a>
    
    {!!  Form::open([
        'action' => ['App\Http\Controllers\PostsController@destroy', $post->id],
        'method' => 'POST',
        'class' => 'pull-right' 
        ])  !!}
        {{  Form::hidden('_method', 'DELETE')  }}
        {{  Form::submit('Delete', ['class' => 'btn btn-danger'])  }}
    {!!  Form::close()  !!}
    
@endsection