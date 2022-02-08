<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    public $fillable = [
    	'id', 'book_id', 'user_id', 'owner_id', 'user_message', 'owner_message', 'is_seen', 'status', 'owner_confirm_time', 'owner_reject_time', 'user_confirm_time', 'user_reject_time', 'return_time', 'return_confirm_time'
    ];

    public function book()
    {
    	return $this->belongsTo(Book::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
