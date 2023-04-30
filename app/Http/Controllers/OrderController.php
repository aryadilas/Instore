<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use \Auth;
use \Storage;

class OrderController extends Controller
{
    public function index()
    {
        $transaction = Transaction::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->get();
        return view('pages/order', ['data' => $transaction]);
    }

    public function cancel($transactionId)
    {
        $transaction = Transaction::where('id', $transactionId)->first();
        
        foreach($transaction->transactionDetails as $detail){
            $product = $detail->product;
            $product->update(['stock' => $product->stock + $detail->qty]);
        }
        $transaction->delete();
        return redirect('/order');
    }

    public function receipt(Request $request, $transactionId)
    {
        $file = $request->file('receipt');
        $path = time() . '_' . $transactionId . '.' . $file->getClientOriginalExtension();
        
        Storage::disk('local')->put('public/payment-receipt/'. $path, file_get_contents($file));
        
        $transaction = Transaction::where('id', $transactionId)->first();
        $transaction->update([
            'receipt' => $path,
            'status' => 'paymentReview'
        ]);

        return redirect('/order');
    }

    public function finish($transactionId)
    {
        $transaction = Transaction::where('id', $transactionId)->first();
        $transaction->update([
            'status' => 'finished'
        ]);

        return redirect('/order');

    }

    
}
