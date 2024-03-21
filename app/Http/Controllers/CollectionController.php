<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $data = Collection::with('book') // Eager load data book
            ->where('user_id', $userId)
            ->get();

        return view('collection.index', compact('data'));
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
        $collection = Collection::firstOrCreate([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
        ]);

        if ($collection->wasRecentlyCreated) {
            return redirect()->route('collection.index')->with('add', 'Data koleksi buku berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Data koleksi buku sudah ada');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collection $collection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    }
}
