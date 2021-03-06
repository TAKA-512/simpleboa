<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all(); 
        return view('posts.index', compact('posts')); 
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
        $post = new Post(); 
        $post->title = $request->input('title');
        $post->content = $request->input('content'); 
        $filename = $request->file('image')->getClientOriginalName();
        $post->image = $filename;
        //$storedata =  array_replace($request->all(), array('image' => $filename));
        $post->save();
        $request->file('image')->storeAs('public/'.$post->id.'/', $filename);
        //return redirect()->route('posts.show', ['id' => $post->id])->with('message', '登録に成功しました！');
        return redirect(route('posts.show', $post->id))->with('message', '新しい記事を登録しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->title = $request->input('title'); 
        $post->content = $request->input('content');
        $post->save();
        return redirect(route('posts.show', $post->id))->with('message', '新しい記事を登録しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete(); 
        return redirect()->route('posts.index');
    }
}
