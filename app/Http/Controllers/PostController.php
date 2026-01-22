<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function indexBerita(Request $request)
    {
        $query = Post::berita()->published()->with(['author', 'category']);

        // Filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('author') && $request->author) {
            $query->where('author_id', $request->author);
        }

        if ($request->has('sort')) {
            if ($request->sort === 'populer') {
                $query->orderBy('view_count', 'desc');
            } elseif ($request->sort === 'terbaru') {
                $query->latest('published_at');
            }
        } else {
            $query->latest('published_at');
        }

        $posts = $query->paginate(12);
        $categories = \App\Models\Category::whereHas('posts', function ($q) {
            $q->berita()->published();
        })->get();
        $authors = \App\Models\User::whereHas('posts', function ($q) {
            $q->berita()->published();
        })->get();

        return view('frontend.rubrik.berita', compact('posts', 'categories', 'authors'));
    }

    public function indexPenaSantri(Request $request)
    {
        $query = Post::penaSantri()->published()->with(['author', 'category']);

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('author') && $request->author) {
            $query->where('author_id', $request->author);
        }

        $query->latest('published_at');
        $posts = $query->paginate(12);

        $categories = \App\Models\Category::whereHas('posts', function ($q) {
            $q->penaSantri()->published();
        })->get();

        return view('frontend.rubrik.pena-santri', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        if ($post->published_at === null) {
            abort(404);
        }

        $post->increment('view_count');

        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->published()
            ->latest('published_at')
            ->take(3)
            ->with(['author', 'category'])
            ->get();

        return view('frontend.post.show', compact('post', 'relatedPosts'));
    }
}
