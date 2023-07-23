<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();

        //For API and Testing
//        return response()->json([
//            'message'=>'Berhasil menampilkan kategori',
//        ], 200);
        return view('library.admin.category.categories', compact('categories'));
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
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category = Category::create($request->all());

        //For API and Testing
//        return response()->json([
//            'message'=>'Kategori berhasil ditambahkan',
//            'category'=>$category,
//        ], 201);
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Category $category
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate(['name' => 'required|string|max:255']);
        $category->update($validatedData);

        //For API and Testing
//        return response()->json([
//            'message'=>'Kategori berhasil diubah',
//            'category'=>$category,
//            'id'=>$category->id,
//        ], 200);
        return redirect()->back()->with('success', 'Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
