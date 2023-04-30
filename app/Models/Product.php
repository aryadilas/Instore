<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPhoto;
use App\Models\CartDetail;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'productName',
        'photo',
        'price',
        'description',
        'category',
        'stock',
    ];

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class);
    }

    public function productPhoto()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
