<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\WritePostRequest;
use App\Models\Category;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('frontend.write', compact('categories'));
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
    public function store(WritePostRequest $request)
    {
        $request->validated();

        $hasFile = $request->hasFile('thumbnail');

        if ($hasFile)
            $file = $request->file('thumbnail');

            $filename = $file->hashName();

            $file->store('public/thumbnails/');

        $post = $request->user()->posts()->create([
            'user_id' => $request->user()->id,
            'category_id' => $request->category,
            'title' => ucfirst($request->title),
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'thumbnail' => $filename ?: null,
        ]);

        $tags = new Tags();

        $tagArray = [];

        foreach ($request->tags as $tags_name) {
            $tags_id = $tags->create(['name' => ucwords($tags_name)]);
            $tagArray[] = $tags_id->id;
        }

        $post->tags()->attach($tagArray);

        return redirect(route('frontend.blog-post-write'))
            ->with('created', 'Post created successfully !');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
