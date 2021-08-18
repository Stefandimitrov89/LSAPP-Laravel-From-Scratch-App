<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show'] ]);
    }

    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =  Post::orderby('updated_at', 'desc')->paginate(12);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        /* Validate */
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        
        
        /* File Upload */
        if($request->hasFile('cover_image')){
            /*  File Name With Extention  */
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            /*  File Name Without Extention  */
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            /*  Just Extention  */
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            /*  Filename To Store  */
            $fileNameToStore = $fileName."_".time().".".$extention;
            /*  Upload Image  */
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }
        
        
        /* Create Post */
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        
        /* redirect */
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $post = Post::find($id);
        //check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /* Validate */
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        
        /* File Upload */
        if($request->hasFile('cover_image')){
            /*  File Name With Extention  */
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            /*  File Name Without Extention  */
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            /*  Just Extention  */
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            /*  Filename To Store  */
            $fileNameToStore = $fileName."_".time().".".$extention;
            /*  Upload Image  */
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        
        /* Find Post */
        $post = Post::find($id);
        //check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        
        /* redirect */
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* Find Post */
        $post = Post::find($id);
        //check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        if($post->cover_image != "noimage.jpg"){
            // Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        /* redirect */
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
