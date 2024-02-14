<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function index()
    {
        $dataBook = Book::all();
        return view('book.index', compact('dataBook'));
    }

   
    public function create()
    {
        return view('book.create-book');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Tambahkan validasi untuk jenis file dan ukuran maksimum
        ]);
        
        $image = $request->file('image');
        $imgName = time() . rand() . '.' . $image->getClientOriginalExtension();
        
        $dPath = public_path('/assets/img/data/');
        $image->move($dPath, $imgName);
        
        Book::create([
            'title' => $request->title,
            'writer' => $request->writer,
            'image' => $imgName, // Gunakan nama file yang baru dibuat
            'publisher' => $request->publisher,
            'year' => $request->year,
        ]);

        return redirect()->route('book.index')->with('addBook', 'Berhasil menambahkan daftar buku');
    }

    public function show(Book $book)
    {
        //
    }

    public function edit($id)
    {
        $data = Book::where('id', $id)->first();
        return view('book.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        Book::where('id', $id)->update([
            'title' =>$request->title,
            'writer' =>$request->writer,
            'publisher' =>$request->publisher,
            'year' =>$request->year,
        ]);
        return redirect('/book')->with('editBook', 'Data buku berhasil diubah');
    }

    // public function bookDetail($id)
    // {
    //     $book = Book::where('id', $id)->first();
    //     return view('dashboard.bookDetail', compact('book'));
    // }

    public function destroy($id)
    { 
        //
        Book::where('id', $id)->delete();
        return redirect('/book')->with('deleteBook', 'Data buku berhasil dihapus');
    }
}
