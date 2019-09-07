<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\SiteManagement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

            $posts = Post::where('title', 'like', '%' . $request->keyword . '%')->with('category')->paginate(10);

        } else {
            $posts = Post::with('category')->paginate(10);
        }
        

        $categories = Category::all();

        return view('back-end.admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories         = Category::all();
        $posts              = Post::query();
        $allPostsCount      = $posts->count();
        $posts              = $posts->filter($request)->get();
        $keyword            = $request->has('keyword') ? $request->keyword : null;
        $categoriesFilter   = $request->has('categoriesFilter') ? $request->categoriesFilter : [];
        
        
        return view('front-end.posts.index', compact('posts', 'allPostsCount', 'categories', 'keyword', 'categoriesFilter'));
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
            'title'         => 'required',
            'body'          => 'required',
            'category_id'   => ['required', Rule::exists('categories', 'id')]
        ]);

        $validated['image'] = $request->hasFile('image') ? $request->file('image')->store(Post::IMAGE_DIRECTORY_NAME) : null;

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
        $categories = Category::all();

        return view('back-end.admin.posts.edit', compact('post', 'categories'));
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
        $request->validate([
            'title'         => 'required',
            'body'          => 'required',
            'category_id'   => ['required', Rule::exists('categories', 'id')]
        ]);

        $post->updateWithImage($request);

        session()->flash('message', trans('lang.data-updated'));
        return redirect()->route('admin.posts.adminIndex');
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
