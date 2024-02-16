<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
            'start_date' => now()->toDateString(),
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('add', 'Data Peminjaman berhasil ditambahkan');
    }

    public function borrowBook(Request $request)
    {

        $borrowedBook = Borrow::where('user_id', $request->user_id)
        ->where('book_id', $request->book_id)
        ->where('status', 'Dipinjam')
        ->first();

        if (!$borrowedBook) {
            // Jika buku belum pernah dipinjam, buat data peminjaman baru
            Borrow::create([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'start_date' => now()->toDateString(),
                'end_date' => $request->end_date,
                'status' => 'Dipinjam',
            ]);

            return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
        } else {
            // Jika buku sudah dipinjam, set status menjadi "Dikembalikan"
            $borrowedBook->update(['status' => 'Dikembalikan']);

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
        } 
    }

    public function returnBook(Request $request)
    {
        
        $borrowedBook = Borrow::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)
            ->where('status', 'Dipinjam')
            ->first();

        if ($borrowedBook) {
            // Tambahkan log untuk melihat nilai variabel
            \Log::info('Data Before Update:', ['data' => $borrowedBook->toArray()]);

            // Hapus data peminjaman
            $borrowedBook->delete();

            // Tambahkan log untuk melihat data setelah update
            \Log::info('Data After Update:', ['data' => $borrowedBook->fresh()->toArray()]);

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
        } else {
            return redirect()->back()->with('error', 'Buku tidak sedang dipinjam atau data peminjaman tidak ditemukan.');
        }
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
