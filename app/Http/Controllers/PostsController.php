<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\SiteManagement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostsController extends Controller
{
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

    public function show(Post $post)
    {        
        $post->load('comments');
        
        return view('front-end.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('back-end.admin.posts.edit', compact('post', 'categories'));
    }

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
