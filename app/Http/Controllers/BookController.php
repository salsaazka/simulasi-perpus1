<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Collection;
use App\Models\Borrow;
use App\Models\Review;
use App\Exports\BooksExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use PDF;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        $dataBook = Book::with(['category'])->get();

        // $bookIdsInCollection = Collection::pluck('book_id');
        // $booksNotInCollection = Book::whereNotIn('id', $bookIdsInCollection)->get();
        // $bookFilter = $booksNotInCollection;
        $book = Book::get();
        // dapatkan list book_id dari Borrow
        $borrowedBooks = Borrow::pluck('book_id');
        // ambil borrow berdasarkan id bukku
        $borrowedBook = Borrow::get();
        $review = Review::get();

        return view('book.index', compact('dataBook', 'book', 'review', 'borrowedBooks', 'borrowedBook'));
    }

    public function detail($id)
    {
        $dataBook = Book::where('id', $id)->first();
        $review = Review::get();
        return view('book.review', compact('dataBook', 'review'));
    }

    public function exportExcel()
    {
        return Excel::download(new BooksExport, 'Books.xlsx');
    }

    public function exportPdf()
    {
        $dataBook = Book::orderBy('id', 'ASC')->get();
        // share $dataBook to view (ambil data) -> redirect ke halaman view sama seperti compact
        view()->share('dataBook',$dataBook);
        // yang didalam petik nama yang ada di blade, $ ambil nama variable untuk models
        //kalau mau 'book.exportPdf'
        $pdf = PDF::loadView('book.bookPdf', $dataBook->toArray());
        // download PDF file with download method
        return $pdf->download('Data Buku.pdf', compact('dataBook'));
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
