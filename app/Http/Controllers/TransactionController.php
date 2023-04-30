<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::all();
        return view('admin/pages/transaction', ['data' => $transaction]);
    }

    public function show($transactionId)
    {
        $transaction = Transaction::where('id', $transactionId)->first();
        return view('admin/pages/transactionDetail', ['transaction' => $transaction]);
    }

    public function confirmPayment($transactionId)
    {
        $transaction = Transaction::where('id', $transactionId)->first();
        $transaction->update(['status' => 'process']);
        return redirect()->back();
    }

    public function rejectPayment($transactionId)
    {
        $transaction = Transaction::where('id', $transactionId)->first();
        // dd($transaction->receipt);
        unlinkPhoto(storage_path('app/public/payment-receipt/' . $transaction->receipt));
        $transaction->update(['receipt' => null,'status' => 'rejected']);
        return redirect()->back();
    }
    
    public function statusShipping($transactionId)
    {
        $transaction = Transaction::where('id', $transactionId)->first();
        $transaction->update(['status' => 'shipping']);
        return redirect()->back();
    }
}
