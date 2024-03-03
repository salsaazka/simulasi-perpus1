<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataReview = Review::all();
        return view('admin.data-review', compact('dataReview'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Review::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);
        return view('/review')->with('add', 'Data Peminjaman berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Review::where('id', $id)->update([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);
        return redirect()->route('review.index')->with('editRe', 'Data Peminjaman berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Review::where('id', $id)->delete();
        return redirect()->route('review.index')->with('deleteRe', 'Data Peminjaman berhasil ditambahkan');
    }
}
