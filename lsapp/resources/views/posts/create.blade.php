@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    <a href="/posts" class="btn btn-light m-3">Go back</a>
    {!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text']) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Submit') }}
        </div>
    {!! Form::close() !!}
@endsection