<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
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
        $posts = $this->posts->paginate(10);

        return view('posts', compact('posts'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->posts->findOrFail($id);

        unlink(storage_path('app/public/thumbnails/'.$delete->thumbnail));

        $delete->delete();

        return redirect(route('dashboard.posts'))
            ->with('deleted', 'Post deleted successfully !');
    }
}
