<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use \Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        
        return view('pages/checkout', ['cart' => $cart]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'recipient' => 'required',
            'city' => 'required',
            'province' => 'required',
            'address' => 'required',
            'postal' => 'required',
            'shipping' => 'required',
            'total' => 'required' 
        ]);
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'recipient' => $request->recipient,
            'city' => $request->city ,
            'province' => $request->province ,
            'address' => $request->address ,
            'postal' => $request->postal ,
            'expedition' => 'JNE' ,
            'shipping_price' => $request->shipping ,
            'total' => $request->total ,
            'status' => 'success' 
        ]);

        $cartItem = Cart::where('user_id', Auth::id())->first();
        
        foreach ($cartItem->CartDetails as $item) {
            $product = Product::where('id', $item->product_id)->first();
            
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'price' => $product->price
            ]);   
            $product->update([
                'stock' => $product->stock - $item->qty
            ]);
        }
        
        $cartItem->delete();

        return redirect('/order');
        
    }
}
