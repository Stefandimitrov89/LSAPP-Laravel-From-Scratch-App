@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card d-none">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-header">{{ __('Blogposts dashboard') }}</div>

                <div class="card-body">
                    <a href="posts/create" class="btn btn-primary">Create Post</a>
                </div>
                
                <div class="card-header">{{ __('Your Blogposts:') }}</div>
                <table class="table table-striped">
                    <tr>
                        <th>Title</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @if(count($posts)==0)
                        <tr>
                            <td>{{  __('You Have no posts')  }}</td>
                        </tr>
                    @else
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{  $post->title  }}</td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-warning">EDIT</a></td>
                                <td>
                                    
                                    {!!  Form::open([
                                        'action' => ['App\Http\Controllers\PostsController@destroy', $post->id],
                                        'method' => 'POST',
                                        'class' => 'pull-right' 
                                        ])  !!}
                                        {{  Form::hidden('_method', 'DELETE')  }}
                                        {{  Form::submit('Delete', ['class' => 'btn btn-danger'])  }}
                                    {!!  Form::close()  !!}
                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
