<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'category',
        'productName',
        'productPrice',
        'productPhoto',
        'quantity',
        'address',
        'postalCode',
        'totalPrice'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
