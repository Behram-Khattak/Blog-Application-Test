<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $categories;

    /**
     * This Constructor function will be execute by default whenever
     * any function is called from this controller
     */
    public function __construct(Category $categories) {
        $this->categories = $categories;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categories->paginate(10);

        return view('categories', compact('categories'));
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
        $request->validate([
            'category' => ['required', 'string', 'max:255'],
        ]);

        $this->categories->create([
            'name' => ucwords($request->category),
        ]);

        return redirect(route('dashboard.categories'))
            ->with('created', 'Category added successfully !');
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
            'category' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ]);

        $update = $this->categories->findOrFail($id);

        $update->update([
            'name' => ucwords($request->category),
        ]);

        return redirect(route('dashboard.categories'))
            ->with('updated', 'Category updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->categories->findOrFail($id);

        $delete->delete();

        return redirect(route('dashboard.categories'))
            ->with('deleted', 'Category deleted successfully !');
    }
}
