<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowingFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_date',
        'due_date',
        'returned_date',
        'status',
    ];

    protected $casts = [
        'borrowed_date'=> 'date',
        'due_date'=> 'date',
        'returned_date'=> 'date',
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function member(){
        return $this->belongsTo(Member::class);
    }

    //check if borrowing is overdue
    public function isOverdue(){
        return $this->due_date < Carbon::today() && $this->status === 'borrowed';
    }
    
}
