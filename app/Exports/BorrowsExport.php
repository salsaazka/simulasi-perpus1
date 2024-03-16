<?php

namespace App\Exports;

use App\Models\Borrow;
use App\Models\User;
use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BorrowsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Borrow::all();
    // }

    public function headings(): array
    {
        return [
            "No", 
            "Name User", 
            "Name Book", 
            "Start date", 
            "End date",
            "Status"
        ];
    }

    public function collection()
    {
        return Borrow::select(
            'borrows.id as No',
            'users.name as Name User',
            'books.title as Name Book',
            'borrows.start_date as Start date',
            'borrows.end_date as End date',
            'borrows.status as Status'
        )
        ->join('users', 'borrows.user_id', '=', 'users.id')
        ->join('books', 'borrows.book_id', '=', 'books.id')
        ->get();
    }
    
}
