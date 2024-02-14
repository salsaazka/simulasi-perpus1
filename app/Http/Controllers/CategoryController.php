<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataCategory = Category::all();
        return view('category.index', compact('dataCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
        ]);
        return redirect()->route('category.index')->with('add', 'Data Peminjaman berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataCategory = Category::where('id', $id)->first();
        return view('category.edit', compact('dataCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Category::where('id', $id)->update([
            'name' => $request->name,
        ]);
        return redirect()->route('category.index')->with('edit', 'Data  berhasil diubah');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->route('category.index')->with('deleteCat', 'Data berhasil dihapus');
    }
}
