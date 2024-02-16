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

    // public function list(Book $book)
    // {
    //     $dataBook = Book::all();
    //     return view('landingPage.book', compact('dataBook'));
    // }

    public function edit($id)
    {
        $dataBook = Book::where('id', $id)->first();
        return view('book.edit', compact('dataBook'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Perubahan validasi untuk memperbolehkan file kosong saat edit
        ]);
    
        $book = Book::find($id);
    
        if ($request->hasFile('image')) {
            // Hapus file gambar lama jika ada
            if ($book->image) {
                $oldImagePath = public_path('/assets/img/data/') . $book->image;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
    
            // Proses upload gambar baru
            $image = $request->file('image');
            $imgName = time() . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/assets/img/data/'), $imgName);
    
            $book->update([
                'image' => $imgName,
            ]);
        }
    
        // Update data buku tanpa mengubah gambar jika tidak ada gambar baru
        $book->update([
            'title' => $request->title,
            'writer' => $request->writer,
            'publisher' => $request->publisher,
            'year' => $request->year,
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
