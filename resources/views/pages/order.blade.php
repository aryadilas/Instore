@extends('layout/app')

@section('content')
    <main class="relative mt-[5rem] flex-grow min-h-[400px] flex flex-col items-center py-10">
        
        @if($data->count() < 1)
            <div class=" w-full flex-grow flex flex-col items-center justify-center">
                <p class="text-center mt-4 font-semibold text-xl">Your order is empty,</p>
                <p class="text-sm mb-10">please checkout your favorite product from catalogue page</p>
                <a href="/catalogue">
                    <p class="rounded-lg border flex justify-center p-2 bg-[#AC3B61] hover:bg-[#862c4a] text-white items-center">Go to Catalogue</p>
                </a>
            </div>    
        @else
            <div class="flex flex-col gap-2 p-2">
            @foreach ($data as $transaction)
                @php
                    $qty = 0;
                    $subtotal = 0;
                    $status = '';
                    
                    if ($transaction->status == 'success') {
                        $status = 'Order Success';
                    } else if ($transaction->status == 'paymentReview') {
                        $status = 'Waiting, admin reviewing your payment';
                    } else if ($transaction->status == 'paid') {
                        $status = 'Payment received';
                    } else if ($transaction->status == 'shipping') {
                        $status = 'Your order on the way';
                    } else if ($transaction->status == 'finished') {
                        $status = 'Your order finishied';
                    }
                @endphp
                <div class="mx-auto max-w-3xl w-full rounded-md border-2 p-4">
                    <!-- Breadcrumb -->
                    <div class="flex justify-between gap-2 text-xs">
                        <div class="flex">
                            <p>Orders</p>
                            <p>></p>
                            <p>ID {{ $transaction->id }}</p>
                        </div>
                        <div>
                            @php
                            if ($transaction->status == 'success') {
                                $status = 'Order Success, Waiting for Payment';
                            } else if ($transaction->status == 'paymentReview') {
                                $status = 'Payment is Being Processed';
                            } else if ($transaction->status == 'rejected') {
                                $status = 'Payment Rejected, Please Repay';
                            } else if ($transaction->status == 'process') {
                                $status = 'Order in progress';
                            } else if ($transaction->status == 'shipping') {
                                $status = 'Order is Being Shipped';
                            } else if ($transaction->status == 'finished') {
                                $status = 'Order has been Completed';
                            }
                            @endphp
                            <p>{{ $status }}</p>
                        </div>
                    </div>
                
                    <!-- Head -->
                    <div class="border-b py-2">
                        <h1 class="text-2xl">Order ID {{ $transaction->id }}</h1>
                        <p class="text-sm">Order date: {{ dateFormatter($transaction->created_at) }}</p>
                    </div>
                
                    <!-- Items -->
                    <div class="flex flex-col gap-2 border-b py-2">
                        @foreach ($transaction->transactionDetails as $item)
                            @php
                                $qty += $item->qty;
                                $subtotal += $item->qty * $item->product->price;
                            @endphp
                            <div class="flex items-center justify-between gap-2">
                                <div class="h-10 w-10 rounded border bg-cover bg-center" style="background-image: url({{ asset('storage/data-product/'.$item->product->photo) }});"></div>
                        
                                <div class="flex flex-grow flex-col justify-center w-3/6">
                                    <p class="">{{ $item->product->productName }}</p>
                                    <p class="text-justify text-xs text-slate-500">{{ substr($item->product->description,0,50).'...' }}</p>
                                </div>
                        
                                <div class="flex flex-col justify-end w-2/6">
                                    <p class="text-right">{{ money($item->price, 'Rp') }}</p>
                                    <p class="text-right text-xs">Qty:{{ $qty }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                
                    <!-- Transaction Info -->
                    @php 
                        $address = $transaction->address . ", " . $transaction->city . " " . $transaction->province . " " . $transaction->postal;
                        $expedition = $transaction->expedition;
                        $shipping = $transaction->shipping_price;
                        $total = $transaction->total;
                    @endphp
                    <div class="flex justify-between border-b py-2">
                        <div class="flex w-1/2 flex-col justify-between gap-2">
                            <p>Payment</p>
                            <div>
                                <p class="text-xs text-slate-500">Method</p>
                                <p class="text-sm">Bank Transfer</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Receipt</p>
                                <div class="flex flex-col">
                                    @if ($transaction->status == 'success' || $transaction->status == 'rejected')
                                        <p class="text-xs" id="receiptName"></p>
                                        <form action="/order/receipt/{{ $transaction->id }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <div class="flex">
                                                <p class="w-fit rounded-md border p-1 text-sm cursor-pointer" onclick="document.getElementById('receipt').click();">Choose File</p>
                                                <input class="hidden" type="file" name="receipt" id="receipt" onchange="changeReceiptName(event)">
                                                <input class="w-fit rounded-md border px-2 py-1 text-sm cursor-pointer" type="submit" value="↑">
                                            </div>
                                        </form>
                                    @else
                                        <a class="text-blue-600" href="{{ asset('storage/payment-receipt/'.$transaction->receipt) }}" target="_blank"><p>{{ $transaction->receipt }}</p></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex w-1/2 flex-col justify-between gap-2">
                            <p>Delivery</p>
                            <div>
                                <p class="text-xs text-slate-500">Address</p>
                                <p class="text-sm">{{ $address }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Delivery Method</p>
                                <p class="text-sm">{{ $expedition }}</p>
                            </div>
                        </div>
                    </div>
                
                    <!-- Summary -->
                    <div class="flex justify-between py-2">
                        <div class="flex">
                            @if ($transaction->status == 'success' || $transaction->status == 'rejected')
                                <form action="/order/cancel/{{ $transaction->id }}" method="POST">
                                    @csrf
                                    <input class="border-red-500 border px-1 cursor-pointer rounded-md text-sm" type="submit" value="Cancel Order">
                                </form>
                            @elseif ($transaction->status == 'shipping')
                                <form action="/order/finish/{{ $transaction->id }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <input class="border-green-500 border px-1 cursor-pointer rounded-md text-sm" type="submit" value="Finish Order">
                                </form>
                            @endif
                        </div>
                        <div class="w-1/2">
                            <p>Order Summary</p>
                            <div class="flex justify-between text-sm text-slate-500">
                                <p>Subtotal</p>
                                <p>{{ money($subtotal, 'Rp') }}</p>
                            </div>
                            <div class="flex justify-between border-b border-dashed border-black pb-2 text-sm text-slate-500">
                                <p>Delivery</p>
                                <p>{{ money($shipping, 'Rp') }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p>Total</p>    
                                <p>{{ money($total, 'Rp') }}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>

                

                

            @endforeach
            </div>
        @endif
    </main>
    <script type="text/javascript">
        function changeReceiptName(event){
            if( event.target.files.length !== 0 ){
                document.getElementById('receiptName').innerHTML = event.target.files.item(0).name;
            }
        }
    </script>
@endsection

{{-- <div class="border">
                    
                    <p>Order ID : {{ $transaction->id }}</p>
                    <p>Order Date : {{ dateFormatter($transaction->created_at) }}</p>
                    <p>Status : {{ $status }}</p>
                    
                    @foreach ($transaction->transactionDetails as $item)
                        @php
                            $qty += $item->qty;
                            $subtotal += $item->qty * $item->product->price;
                        @endphp
                        <div class="border">
                            <div class="w-10 h-10 bg-cover" style="background-image: url('{{ url('storage/data-product/'.$item->product->photo) }}')"></div>
                            <p>Name : {{ $item->product->productName }} </p>
                            <p>Description : {{ $item->product->description }} </p>  
                            <p>Price : {{ money($item->product->price, 'Rp') }} </p>
                            <p>Qty : {{ $item->qty }} </p>
                        </div>
                    @endforeach    
                    
                    @php 
                        $address = $transaction->address . ", " . $transaction->city . " " . $transaction->province . " " . $transaction->postal;
                        $expedition = $transaction->expedition;
                        $shipping = $transaction->shipping_price;
                        $total = $transaction->total;
                    @endphp
                    <p>Payment Receipt : {{ $transaction->receipt }}</p>
                    @if ($transaction->status == 'success')
                        <form action="/order/receipt/{{ $transaction->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <input type="file" name="receipt">
                            <input type="submit" value="Upload">
                        </form>
                    @endif
                    
                    <p>Address : {{ $address }}</p>
                    <p>DeliveryMethod : {{ $expedition }}</p>
                    <br>
                    <p>Total Product : {{ $qty }} Item</p>
                    <p>Subtotal : {{ money($subtotal, 'Rp') }}</p>
                    <p>Shipping : {{ money($shipping, 'Rp') }}</p>
                    <p>Total : {{ money($total, 'Rp') }}</p>
                    @if ($transaction->status == 'success')
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
                    @endif
                </div> --}}
