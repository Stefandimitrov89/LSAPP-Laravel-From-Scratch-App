@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-light m-3">Go back</a>
    <div class="card p-3">
        <h4>{{$post->title}}</h4>
        <div>{!!$post->body!!}</div>
        <hr>
        <small> Written in {{$post->created_at}} by {{ $post->user->name }}</small>
    </div>
    <hr>
    @if( !Auth::guest() )
        @if(  Auth::user()->id == $post->user_id  )
            <a href="/posts/{{$post->id}}/edit" class="btn btn-light">EDIT</a>
            {!!  Form::open([
                'action' => ['App\Http\Controllers\PostsController@destroy', $post->id],
                'method' => 'POST',
                'class' => 'pull-right' 
                ])  !!}
                {{  Form::hidden('_method', 'DELETE')  }}
                {{  Form::submit('Delete', ['class' => 'btn btn-danger'])  }}
            {!!  Form::close()  !!}
        @endif
    @endif
@endsection