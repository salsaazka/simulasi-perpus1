<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\User;
use App\Models\Collection;
use App\Models\Review;
use App\Exports\BorrowsExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BorrowController extends Controller
{

    public function index()
    {
        $dataBorrow = Borrow::with(['user', 'book'])->get();
        return view('borrow.index', compact('dataBorrow'));
    }

    public function exportExcel()
    {
        return Excel::download(new BorrowsExport, 'Borrow.xlsx');
    }

    public function exportPdf()
    {
        $dataBorrow = Borrow::select(
            'borrows.id as no',
            'users.name as user',
            'books.title as title',
            'borrows.start_date as start_date',
            'borrows.end_date as end_date',
            'borrows.status as status'
        )
            ->join('users', 'borrows.user_id', '=', 'users.id')
            ->join('books', 'borrows.book_id', '=', 'books.id')
            ->orderBy('borrows.id', 'ASC')
            ->get();
        // $dataBorrow = Borrow::orderBy('id', 'ASC')->get();
        // share $dataBorrow to view (ambil data) -> redirect ke halaman view sama seperti compact
        view()->share('dataBorrow', $dataBorrow);
        // yang didalam petik nama yang ada di blade, $ ambil nama variable untuk models
        //kalau mau 'borrow.exportPdf'
        $pdf = PDF::loadView('borrow.borrowPdf', $dataBorrow->toArray());
        // download PDF file with download method
        return $pdf->download('Data Peminjaman.pdf');
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
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays(10)->toDateString(),
            'status' => $request->status,
        ]);

        Collection::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
        ]);
        return redirect()->back()->with('add', 'Data Peminjaman berhasil ditambahkan');
    }

    public function borrowBook(Request $request)
    {
        // dd($request->all());
        // $borrowedBook = Borrow::where('user_id', $request->user_id)
        //     ->where('book_id', $request->book_id)
        //     ->first();

        Borrow::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'start_date' => now()->toDateString(),
            'end_date' => null,
            'status' => 'Dipinjam',
        ]);

        return redirect()->route('borrow.index')->with('success', 'Buku berhasil dipinjam.');

        // if (!$borrowedBook) {
        //     // Jika buku belum pernah dipinjam, buat data peminjaman baru
        //     Borrow::create([
        //         'user_id' => $request->user_id,
        //         'book_id' => $request->book_id,
        //         'start_date' => now()->toDateString(),
        //         'end_date' => $request->end_date,
        //         'status' => 'Dipinjam',
        //     ]);

        //     Collection::create([
        //         'user_id' => $request->user_id,
        //         'book_id' => $request->book_id,
        //     ]);

        //     return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
        // } else {
        //     // Jika buku sudah dipinjam, set status menjadi "Dikembalikan"
        //     $borrowedBook->update(['status' => 'Dikembalikan']);

        //     return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
        // }
    }

    public function returnBook(Request $request)
    {

        $dataBorrow = Borrow::where('id', $request->id)->first();
        $dataBorrow->update([
            'status' => 'Dikembalikan',
            'end_date' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'Buku telah berhasil dikembalikan.');

        // dd($request->all());

        // $dataBorrow = Borrow::where('book_id', $request->book_id)->first();

        // if ($dataBorrow) {
        //     $dataBorrow->update([
        //         'status' => 'Dikembalikan',
        //         'end_date' => now()->toDateString(),
        //     ]);

        //     return redirect()->back()->with('success', 'Buku telah berhasil dikembalikan.');
        // } else {
        //     return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
        // }

        // Review::create([
        //     'user_id' => $request->user_id,
        //     'book_id' => $request->book_id,
        //     'review' => $request->review,
        //     'rating' => $request->rating,
        // ]);
        // Collection::where('book_id', $request->book_id)->delete();

        // return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
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
        return redirect()->route('borrow.index')->with('deleteBor', 'Data Peminjaman berhasil dihapus');
    }
}
