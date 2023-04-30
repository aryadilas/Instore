@extends('admin/layout/app')

@section('content')
    <main class="relative mt-[5rem] flex-grow min-h-[400px] flex flex-col items-center">
                  
            
                <div class="border">
                    @php
                        $qty = 0;
                        $subtotal = 0;
                        $status = '';
                         
                        if ($transaction->status == 'success') {
                            $status = 'Order Success, waiting for user payment';
                        } else if ($transaction->status == 'paymentReview') {
                            $status = 'User payment needs review';
                        } else if ($transaction->status == 'rejected') {
                            $status = 'Payment rejected, waiting for user repayment';
                        } else if ($transaction->status == 'shipping') {
                            $status = 'This order is on the way';
                        } else if ($transaction->status == 'finished') {
                            $status = 'This order is finished';
                        }
                    @endphp
                    <p>Order ID : {{ $transaction->id }}</p>
                    <p>Order Date : {{ dateFormatter($transaction->created_at) }}</p>
                    <p>Status : {{ $status }}</p>
                    
                    @foreach ($transaction->transactionDetails as $item)
                        @php
                            $qty += $item->qty;
                            $subtotal += $item->qty * $item->price;
                        @endphp
                        <div class="border">
                            <div class="w-10 h-10 bg-cover" style="background-image: url('{{ url('storage/data-product/'.$item->product->photo) }}')"></div>
                            <p>Name : {{ $item->product->productName }} </p>
                            <p>Description : {{ $item->product->description }} </p>  
                            <p>Price : {{ money($item->price, 'Rp') }} </p>
                            <p>Qty : {{ $item->qty }} </p>
                        </div>
                    @endforeach    
                    
                    @php 
                        $address = $transaction->address . ", " . $transaction->city . " " . $transaction->province . " " . $transaction->postal;
                        $expedition = $transaction->expedition;
                        $shipping = $transaction->shipping_price;
                        $total = $transaction->total;
                    @endphp
                    <p>Payment Receipt : <a href="{{ asset('storage/payment-receipt/'.$transaction->receipt) }}" target="_blank">{{ $transaction->receipt }}</a></p>
                
                    <p>Address : {{ $address }}</p>
                    <p>DeliveryMethod : {{ $expedition }}</p>
                    <br>
                    <p>Total Product : {{ $qty }} Item</p>
                    <p>Subtotal : {{ money($subtotal, 'Rp') }}</p>
                    <p>Shipping : {{ money($shipping, 'Rp') }}</p>
                    <p>Total : {{ money($total, 'Rp') }}</p>
                    @if ($transaction->status == 'paymentReview')
                        <form action="/transaction/payment/confirm/{{ $transaction->id }}" method="POST">
                            @method('patch')
                            @csrf
                            <input type="submit" value="Confirm Payment">
                        </form>
                        <form action="/transaction/payment/reject/{{ $transaction->id }}" method="POST">
                            @method('patch')
                            @csrf
                            <input type="submit" value="Reject Payment">
                        </form>
                    @elseif ($transaction->status == 'process')
                        <form action="/transaction/status/shipping/{{ $transaction->id }}" method="POST">
                            @method('patch')
                            @csrf
                            <input type="submit" value="Change Status to Shipping">
                        </form>
                    @endif
                </div>
            
        
    </main>
@endsection