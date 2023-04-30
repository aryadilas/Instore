<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use App\Models\Cart;
use App\Models\CartDetail;

class CartController extends Controller
{
    public function index()
    {
        $data = Cart::where('user_id', Auth::id())->first();
        return view('pages/cart', ['data' => $data]);
    }
    public function store(Request $request, $productId)
    {
        
        $cartId = Cart::where('user_id', Auth::id())->first();
        
        if(!$cartId){
            $cartId = Cart::create([
                'user_id' => Auth::id()
            ]);
        }
        $cartId = $cartId->id;

        $product_exist = CartDetail::where('cart_id', $cartId)->where('product_id', $productId)->first();

        if($product_exist){
            $product_exist->update([
                'qty' => $product_exist->qty + $request->qty
            ]);
        } else {
            CartDetail::create([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'qty' => $request->qty
            ]);
        }

        return redirect()->back();
    }
    
    public function update($cartDetailId, $qty)
    {
        $cartDetail = CartDetail::where('id', $cartDetailId);
        if($qty > 0){
            $cartDetail->update(['qty' => $qty]);
        }
        return redirect('/cart');
    }

    public function delete($cartDetailId)
    {
        CartDetail::where('id', $cartDetailId)->delete();
        return redirect('/cart');
    }
}
