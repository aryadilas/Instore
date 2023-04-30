@extends('layout/app')

@section('content')
    <main class="relative mt-[5rem] flex-grow min-h-[400px] flex flex-col items-center">
        <h1 class="mx-auto text-2xl font-semibold py-5">Your Cart (4 items)</h1>

        <div class="flex flex-col sm:flex-row gap-2 mx-auto w-full max-w-3xl justify-center p-2">
            @if ($errors->any())
                <div class="flex flex-col w-full px-4 py-2 border mx-auto">
                    <span>Error : </span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="flex flex-col gap-2 sm:w-2/3">
                
                @php 
                    $subTotal = 0; 
                    $qtyTotal = 0;
                @endphp
                @foreach ($cart->cartDetails as $cartItem)
                    @php 
                        $totalItem = ($cartItem->qty * $cartItem->product->price);
                        $subTotal += $totalItem;  
                        $qtyTotal += $cartItem->qty;
                    @endphp
                    <div class="mx-auto flex w-full flex-col gap-4 border px-4 py-2">
                        <div class="flex justify-between">
                    
                            <div class="flex gap-2 sm:flex-row sm:items-center">
                    
                                <div class="h-20 w-20 rounded border bg-cover bg-center" style="background-image: url({{ asset('storage/data-product/'.$cartItem->product->photo) }});"></div>
                    
                                <div class="flex flex-col flex-grow">
                                    <p class="">{{ $cartItem->product->productName }}</p>
                                    <p class="text-justify text-xs text-slate-500">{{ substr($cartItem->product->description, 0, 60).'...' }}</p>
                                    <p class="text-sm">{{ money($cartItem->product->price, 'Rp') }} - {{ $cartItem->qty }} Pieces</p>
                                </div>

                            </div>

                        </div>

                        <div class="flex justify-between">
                            <p class="font-semibold text-right">{{ money($totalItem, 'Rp') }}</p>
                        </div>
                    </div>
                @endforeach
                @php 
                    $shipping = ceil($qtyTotal/4) * 15000;
                    $total = $subTotal + $shipping;
                @endphp
            </div>

            <div class="flex flex-col gap-2 sm:w-1/3">
                <div class="flex flex-col w-full px-4 py-2 border mx-auto">
                    <p class="font-semibold">Payment Details</p>
                    <div class="flex items-center gap-1">
                        <p class="text-xs text-slate-500">Method - </p>
                        <p class="text-sm">Bank Transfer</p>
                    </div>
                    <p class="text-xs text-justify">Please transfer according to the specified amount. You can see the account information on the payment page.</p>
                </div>

                <div class="flex flex-col w-full px-4 py-2 border mx-auto">
                    <p class="font-semibold">Order Summary</p>
                    <div class="flex justify-between text-sm text-slate-500">
                        <p>Subtotal</p>
                        <p>{{ money($subTotal, 'Rp') }}</p>
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

                <div class="border px-4 py-2 w-full mx-auto">
                    <p class="font-semibold">Shipping Details</p><br>
                    <form action="/checkout" method="POST">
                        @csrf
                        <div>
                        <label class="text-slate-500 text-xs" for="recipient">RECIPIENT:</label><br>
                        <input class="border" type="text" name="recipient" ><br>
                        <label class="text-slate-500 text-xs" for="city">CITY:</label><br>
                        <input class="border" type="text" name="city" ><br>
                        <label class="text-slate-500 text-xs" for="province">PROVINCE:</label><br>
                        <input class="border" type="text" name="province" ><br>
                        <label class="text-slate-500 text-xs" for="address">ADDRESS:</label><br>
                        <input class="border" type="text" name="address" ><br>
                        <label class="text-slate-500 text-xs" for="postal">POSTAL:</label><br>
                        <input class="border" type="text" name="postal" ><br><br>
                        <input type="hidden" name="shipping" value="{{ $shipping }}">
                        <input type="hidden" name="total" value="{{ $total }}">
                        <input class="cursor-pointer border px-4 py-1 bg-[#AC3B61] hover:bg-[#862c4a] text-white rounded-md" type="submit" value="Purchase">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        {{-- <form action="/checkout" method="POST">
            @csrf
            <div>
                <p>Shipping Detail</p>
                <label for="recipient">Recipient</label>
                <input class="border" type="text" name="recipient"><br>
                <label for="city">City</label>
                <input class="border" type="text" name="city"><br>
                <label for="province">Province</label>
                <input class="border" type="text" name="province"><br>
                <label for="address">Address</label>
                <input class="border" type="text" name="address"><br>
                <label for="postal">Postal</label>
                <input class="border" type="text" name="postal">
            </div><br>
            <div>
                Please transfer according to the specified amount. You can see the account information on the payment page.
            </div>
            <div>
                @php 
                    $subtotal = 0; 
                    $qtyTotal = 0;
                @endphp
                @foreach ($cart->cartDetails as $cartItem)
                    @php 
                        $subtotal += ($cartItem->qty * $cartItem->product->price);  
                        $qtyTotal += $cartItem->qty;
                    @endphp
                    <p>{{ $cartItem->product->productName . " " . $cartItem->qty . " " . money($cartItem->product->price, 'Rp') }}</p>
                @endforeach
                @php 
                    $shipping = ceil($qtyTotal/4) * 15000;
                    $total = $subtotal + $shipping;
                @endphp
                <p>Subtotal : {{ money($subtotal, 'Rp') }}</p>
                <p>Shipping : {{ money($shipping, 'Rp') }}</p>
                <p>Total : {{ money($total, 'Rp') }}</p>
                <input type="hidden" name="shipping" value="{{ $shipping }}">
                <input type="hidden" name="total" value="{{ $total }}">
                <input type="submit" value="Purchase">

            </div>
        </form> --}}
    </main>
@endsection