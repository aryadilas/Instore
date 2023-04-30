@extends('layout/app')

@section('content')
    <main class="relative mt-[5rem] min-h-[400px] flex flex-col flex-grow sm:border justify-center items-center mb-2">
        <div class=" max-w-7xl">
            <a href="/catalogue" class=""><p>Back</p></a>
        </div>
        <div class="max-w-7xl flex flex-col items-center border sm:flex-row justify-center">

            <div class="sm:w-fit w-full flex p-4 flex-col gap-2 sm:justify-center sm:flex-row-reverse ">
                
                <div id="imgShow" class="w-full h-80 max-w-[24rem] max-h-[24rem] sm:w-96 sm:h-96 bg-contain bg-no-repeat bg-center bg-slate-800 border" style="background-image: url('{{ url('storage/data-product/'.$data->photo) }}')"></div>
                <div class="flex gap-2 sm:flex-col justify-start w-60 sm:w-fit sm:justify-start">
                    <div id="imgSmall" onmouseover='over(this);' onmouseleave='leave(this);' class="w-10 h-10 bg-cover" style="background-image: url('{{ url('storage/data-product/'.$data->photo) }}')"></div>
                    @foreach ($data->productPhoto as $photo)
                        <div id="imgSmall" onmouseover='over(this);' onmouseleave='leave(this);' class="w-10 h-10 bg-cover" style="background-image: url('{{ url('storage/data-product/'.$photo->photo) }}')"></div>
                    @endforeach
                </div>

            </div>

            <form action="/cart/store/{{$data->id}}" method="POST">
                @csrf
                <div class=" flex flex-col justify-between max-w-sm">
                    
                    <div class="flex flex-col p-4 gap-4 w-full">
                        <h1 class="text-center font-semibold text-lg">{{ $data->productName }}</h1>
                        <p class="text-center font-semibold">{{ money($data->price, 'Rp') }}</p>
                        <p class="text-justify text-sm">{{ $data->description }}</p>
                        <p class="text-left text-xs">Stock : {{ $data->stock }}Pcs</p>
                    </div>

                    <div class="flex flex-col p-4 gap-2 w-full">
                        <label for="qty">Qty : </label>
                        <input class="w-1/4 border-2 pl-2 rounded-lg" value="1" type="number" name="qty" max="{{ $data->stock }}" min="1">
                        {{-- <p class="text-xs">Select Size</p>
                        <div class="flex gap-5">
                    
                    
                            <div class="border w-8 h-8 flex hover:border-black hover:border-2 cursor-pointer justify-center items-center">
                            <p class="font-semibold">S</p>
                            </div>
                            
                            <div class="border w-8 h-8 flex hover:border-black hover:border-2 cursor-pointer justify-center items-center">
                            <p class="font-semibold">M</p>
                            </div>
                            
                            
                            <div class="border w-8 h-8 flex hover:border-black hover:border-2 cursor-pointer justify-center items-center">
                            <p class="font-semibold">L</p>
                            </div>
                        
                        
                            <div class="border w-8 h-8 flex hover:border-black hover:border-2 cursor-pointer justify-center items-center">
                            <p class="font-semibold">XL</p>
                            </div>
                
                        </div> --}}
                    </div>

                    <div class="w-full p-4">
                    
                        
                            <input class="cursor-pointer w-full rounded-lg border flex justify-center py-2 bg-[#AC3B61] hover:bg-[#862c4a] text-white items-center font-semibold text-center" type="submit" value="Add to cart">
                        
                    
                    </div>

                </div>

            </form>
        </div>
        <script type="text/javascript">
            function over(el){
                document.getElementById('imgShow').removeAttribute('style');
                document.getElementById('imgShow').style.backgroundImage = el.style.backgroundImage;
                el.style.border = "1px solid black";
            }
            function leave(el){
                el.style.border = "none";
            }
        </script>
    </main>
@endsection