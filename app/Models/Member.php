<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'ic_no', 'address', 'mobile_number', 'borrowed_status'
    ];

    public function borrowed_records()
    {
        return $this->hasMany(BorrowingRecord::class);
    }
}
