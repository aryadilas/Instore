<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionDetail;

class Transaction extends Model
{
    //use HasFactory;
    protected $fillable = [
        'user_id',
        'recipient',
        'receipt',
        'city',
        'province',
        'address',
        'postal',
        'expedition',
        'shipping_price',
        'total',
        'status'
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
