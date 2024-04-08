<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\WritePostRequest;
use App\Models\Posts;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MyPostController extends Controller
{
    public $posts;

    /**
     * This Constructor function will be execute by default whenever
     * any function is called from this controller
     */
    public function __construct(Posts $posts) {
        $this->posts = $posts;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->posts->where('user_id', auth()->user()->id)
                            ->get();

        return view('frontend.blog-my-post', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = $this->posts->findOrFail($id);

        $hasFile = $request->hasFile('thumbnail');

        if ($hasFile) {
            $file = $request->file('thumbnail');

            $filename = $file->hashName();

            $file->store('public/thumbnails/');

        } elseif (!$hasFile) {
            $filename = $post->thumbnail;
        }

        $post->update([
            'user_id' => $request->user()->id,
            'category_id' => $request->category,
            'title' => ucfirst($request->title),
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'thumbnail' => $filename ?: null,
        ]);

        $tags = new Tags();

        $tagArray = [];

        if ($request->tags) {
            foreach ($request->tags as $tags_name) {
                $tags_id = $tags->create(['name' => $tags_name]);
                $tagArray[] = $tags_id->id;
            }

            $post->tags()->attach($tagArray);

        } elseif (!$request->tags) {
            foreach ($post->tags as $tags) {
                $tagArray[] = $tags->id;
            }

            $post->tags()->detach($tagArray);
            $post->tags()->attach($tagArray);
        }

        return back()->with('updated', 'Post updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->posts->findOrFail($id);

        $delete->delete();

        return redirect(route('frontend.blog-my-post'))
                ->with('deleted', 'Post deleted successfully !');
    }
}
