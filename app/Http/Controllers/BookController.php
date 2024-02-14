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
        //
        $request->validate([
            'title' => 'required'
        ]);

        $image = $request->file('image');
        $imgName = time().rand().'.'.$image->extension();

        if(!file_exists(public_path('/assets/img/data/'.$image->getClientOriginalName()))){
            //set untuk menyimpan file nya
            $dPath = public_path('/assets/img/data/');
            //memindahkan file yang diupload ke directory yang telah ditentukan
            $image->move($dPath, $imgName);
            $uploaded = $imgName;
        }else{
            $uploaded = $image->getClientOriginalName();
        }
        Book::create([
            'title' =>$request->title,
            'writer' =>$request->writer,
            'image' =>$uploaded,
            'publisher' =>$request->publisher,
            'year' =>$request->year,
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
