<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Book::all();
    // }

    public function headings(): array
    {
        return [
            "No", 
            "Name Book", 
            "Writer", 
            "Publisher", 
            "Year",
        ];
    }

    public function collection()
    {
        return Book::select(
            "id",
            "title",
            "writer",
            "publisher",
            "year",
        )->get();
    }
}
