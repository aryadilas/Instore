@extends('layout/app')

@section('content')
    <main class="relative mt-[5rem] flex-grow min-h-[400px] flex flex-col items-center">
        
        @if(!$data || !$data->cartDetails->count())
            <div class=" w-full flex-grow flex flex-col items-center justify-center">
                <p class="text-center mt-4 font-semibold text-xl">Your cart is empty,</p>
                <p class="text-sm mb-10">please select your favorite product from catalogue page</p>
                <a href="/catalogue">
                    <p class="rounded-lg border flex justify-center p-2 bg-[#AC3B61] hover:bg-[#862c4a] text-white items-center">Go to Catalogue</p>
                </a>
            </div>    
        @else
            <h1 class="mx-auto text-2xl font-semibold my-5">Your Cart ({{$data->cartDetails->count()}} items)</h1>
            @foreach ($data->cartDetails as $cartItem)
            <div class="mx-auto flex w-full max-w-2xl flex-col gap-4 border px-4 py-2">
                <div class="flex justify-between">
                  
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                    
                        <div class="h-20 w-20 rounded border bg-cover bg-center" style="background-image: url({{ asset('storage/data-product/'.$cartItem->product->photo) }});"></div>
                    
                        <div>
                            <p class="">{{ $cartItem->product->productName }}</p>
                            <p class="text-justify text-xs text-slate-500">{{ substr($cartItem->product->description,0,50).'...' }}</p>
                            <p class="text-sm">{{ money($cartItem->product->price, 'Rp') }}</p>
                            </div>
                        </div>
          
                        <div class="flex flex-col">
                            <form action="/cart/delete/{{ $cartItem->id }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit">
                                    <svg class="w-5 h-5 fill-[#AC3B61] hover:fill-[#67122e]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style=""><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                                </button>
                                {{-- <input class="text-red-600 cursor-pointer" type="submit" value="Delete"> --}}
                            </form>
                        </div>
                </div>
          
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <form action="/cart/update/{{ $cartItem->id }}/{{ $cartItem->qty - 1 }}" method="post">
                            @method('patch')
                            @csrf
                            <input class="cursor-pointer rounded-bl rounded-tl border-2 border-black px-2 text-center font-semibold" type="submit" value="-">
                        </form>
                        <span class="border-y-2 border-black px-3 text-center font-semibold">{{ $cartItem->qty }}</span>
                        <form action="/cart/update/{{ $cartItem->id }}/{{ $cartItem->qty + 1 }}" method="post">
                            @method('patch')
                            @csrf
                            <input class="cursor-pointer rounded-br rounded-tr border-2 border-black px-2 text-center font-semibold" type="submit" value="+">
                        </form>
                    </div>
                    <p class="font-semibold">{{ money($cartItem->qty * $cartItem->product->price, 'Rp') }}</p>
                </div>
            </div>

            {{-- <div class="border flex flex-col">
                {{ $cartItem->product->photo }}<br>
                {{ $cartItem->product->productName }}<br>
                {{ $cartItem->qty }} <br>
                <div class="flex gap-2">
                    <form action="/cart/update/{{ $cartItem->id }}/{{ $cartItem->qty - 1 }}" method="post">
                        @method('patch')
                        @csrf
                        <input class="text-blue-600 cursor-pointer text-left" type="submit" value="Subtract Qty">
                    </form>
                    <form action="/cart/update/{{ $cartItem->id }}/{{ $cartItem->qty + 1 }}" method="post">
                        @method('patch')
                        @csrf
                        <input class="text-blue-600 cursor-pointer text-left" type="submit" value="Add Qty">
                    </form>
                </div><br>
                {{ money($cartItem->product->price, 'Rp') }}<br>
                {{ money($cartItem->qty * $cartItem->product->price, 'Rp') }}<br>
                <form action="/cart/delete/{{ $cartItem->id }}" method="POST">
                    @method('delete')
                    @csrf
                    <input class="text-red-600 cursor-pointer" type="submit" value="Delete">
                </form>
                
                
            </div> --}}
            @endforeach
            <form action="/checkoutConfirm" method="POST">
                @csrf
                <input class="text-red-600 cursor-pointer" type="submit" value="Checkout">
            </form>
        @endif
    </main>
@endsection