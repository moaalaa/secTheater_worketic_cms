<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource for admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex(Request $request)
    {
        if ($request->has('keyword')) {

            $posts = Post::where('title', 'like', '%' . $request->keyword . '%')->paginate(10);

        } else {
            $posts = Post::paginate(10);
        }

        $categories = Category::all();

        return view('back-end.admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front-end.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'body'  => 'required',
        ]);

        $validated['image'] = $request->hasFile('image') ? $request->file('image')->store('/posts/') : null;

        Post::create($validated);
        
        session()->flash('message', trans('lang.data-saved'));
        return redirect()->route('admin.posts.adminIndex');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $json = [];

        if ($request->has('id')) {
            $post = Post::find($request->id);

            if (!! $post) {
                $post->delete();
                $json['type'] = 'success';
                $json['message'] = trans('lang.data-deleted');
                return $json;
            }

            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }

        $json['type'] = 'error';
        $json['message'] = trans('lang.something_wrong');
        return $json;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelected(Request $request)
    {
        $json = [];
        
        if ($request->has('ids')) {
            Post::destroy($request->ids);
            $json['type'] = 'success';
            $json['message'] = trans('lang.data-deleted');
            return $json;
        }

        $json['type'] = 'error';
        $json['message'] = trans('lang.something_wrong');
        return $json;
    }
}
