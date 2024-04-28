<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public $tags;

    /**
     * This Constructor function will be execute by default whenever
     * any function is called from this controller
    */
    public function __construct(Tags $tags) {
        $this->tags = $tags;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = $this->tags->paginate();

        return view('tags', compact('tags'));
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
        $request->validate([
            'tag' => ['required', 'string', 'max:255'],
        ]);

        $update = $this->tags->findOrFail($id);

        $update->update([
            'name' => ucwords($request->tag),
        ]);

        return redirect(route('dashboard.tags'))
            ->with('updated', 'Tag updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->tags->findOrFail($id);

        $delete->delete();

        return redirect(route('dashboard.tags'))
            ->with('deleted', 'Tag deleted successfully !');
    }
}
