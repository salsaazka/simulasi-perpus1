<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
  
    public function index()
    {
        $dataBorrow = Borrow::all();
        return view('borrow.index', compact('dataBorrow'));
    }

   
    public function create()
    {
        return view('borrow.create-borrow');
    }

    
    public function store(Request $request)
    {
       
        Borrow::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);
        return view('/borrow')->with('add', 'Data Peminjaman berhasil ditambahkan');
    }

    
    public function show(Borrow $borrow)
    {
        //
    }

    
    public function edit($id)
    {
        $data = Borrow::where('id', $id)->first();
        return view('borrow.edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        Borrow::where('id', $id)->update([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);
        return view('/borrow')->with('editBor', 'Data Peminjaman berhasil diubah');
    }

     
    public function destroy($id)
    {
        Borrow::where('id', $id)->delete();
        return view('/borrow')->with('deleteBor', 'Data Peminjaman berhasil dihapus');
    }
}
