@extends('admin/layout/app')

@section('content')
    <main class="relative mt-[5rem] flex-grow min-h-[400px] flex flex-col items-center">
            
        @if($data->count() < 1)
            <div class=" w-full flex-grow flex flex-col items-center justify-center">
                <p class="text-center mt-4 font-semibold text-xl">Transaction is empty.</p>
            </div>    
        @else
            @foreach ($data as $transaction)
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
                        } else if ($transaction->status == 'process') {
                            $status = 'This order needs to be prepared';
                        } else if ($transaction->status == 'shipping') {
                            $status = 'This order is on the way';
                        } else if ($transaction->status == 'finished') {
                            $status = 'This order is finished';
                        }
                    @endphp
                    <p>Order ID : {{ $transaction->id }}</p>
                    <p>Order Date : {{ dateFormatter($transaction->created_at) }}</p>
                    <p>Status : {{ $status }}</p>
                    <a href="/transaction/{{ $transaction->id }}"><p class="text-blue-400">Detail</p></a>
                    
                    {{-- @foreach ($transaction->transactionDetails as $item)
                        @php
                            $qty += $item->qty;
                            $subtotal += $item->qty * $item->product->price;
                        @endphp
                        <div class="border">
                            <div class="w-10 h-10 bg-cover" style="background-image: url('{{ url('storage/data-product/'.$item->product->photo) }}')"></div>
                            <p>Name : {{ $item->product->productName }} </p>
                            <p>Description : {{ $item->product->description }} </p>  
                            <p>Price : {{ $item->product->price }} </p>
                            <p>Qty : {{ $item->qty }} </p>
                        </div>
                    @endforeach     --}}
                    
                    @php 
                        $address = $transaction->address . ", " . $transaction->city . " " . $transaction->province . " " . $transaction->postal;
                        $expedition = $transaction->expedition;
                        $shipping = $transaction->shipping_price;
                        $total = $transaction->total;
                    @endphp
                    {{-- <p>Payment Receipt : {{ $transaction->receipt }}</p>
                    @if ($transaction->status == 'success')
                        <form action="/order/receipt/{{ $transaction->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <input type="file" name="receipt">
                            <input type="submit" value="Upload">
                        </form>
                    @endif --}}
                    
                    {{-- <p>Address : {{ $address }}</p>
                    <p>DeliveryMethod : {{ $expedition }}</p>
                    <br>
                    <p>Total Product : {{ $qty }} Item</p>
                    <p>Subtotal : {{ $subtotal }}</p>
                    <p>Shipping : {{ $shipping }}</p>
                    <p>Total : {{ $total }}</p> --}}
                    {{-- @if ($transaction->status == 'success')
                        <form action="/order/cancel/{{ $transaction->id }}" method="POST">
                            @csrf
                            <input type="submit" value="Cancel">
                        </form>
                    @elseif ($transaction->status == 'shipping')
                        <form action="/order/finish/{{ $transaction->id }}" method="POST">
                            @csrf
                            @method('patch')
                            <input type="submit" value="Finish">
                        </form>
                    @endif --}}
                </div>
            @endforeach
        @endif
    </main>
@endsection