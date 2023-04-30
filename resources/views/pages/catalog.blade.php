@extends('layout/app')

@section('content')
    <main class="relative mt-[5rem] min-h-[400px] flex flex-col items-center">
        <div id="cat" class="mx-auto text-center mt-4">
                <a><input class="w-fit bg-[#AC3B61] p-1 rounded-sm text-white" type="button" value="All" onclick="showall();"></a>
                <a><input class="w-fit bg-[#AC3B61] p-1 rounded-sm text-white" type="button" value="Hijab" onclick="cathijab();"></a>
                <a><input class="w-fit bg-[#AC3B61] p-1 rounded-sm text-white" type="button" value="Dress" onclick="catdress();"></a>
                <a><input class="w-fit bg-[#AC3B61] p-1 rounded-sm text-white" type="button" value="Top" onclick="cattop();"></a>
                <a><input class="w-fit bg-[#AC3B61] p-1 rounded-sm text-white" type="button" value="Bottom" onclick="catbottom();"></a>
                <a><input class="w-fit bg-[#AC3B61] p-1 rounded-sm text-white" type="button" value="Goodies" onclick="catgoodies();"></a>
                <a><input class="w-fit bg-[#AC3B61] p-1 rounded-sm text-white" type="button" value="Blouse" onclick="catblouse();"></a>
        </div>
        
        <div class="flex max-w-7xl w-full flex-wrap  justify-center  gap-4 mx-auto items-center py-10">
            @foreach($data as $row)
            <a href='/catalogue/{{ $row->id }}' class='{{ $row->category }}'>
                <div class='flex flex-col border p-2 w-44 h-52'>
                    <div class='w-40 h-40 bg-cover bg-center ' style="background-image: url({{ asset('storage/data-product/'.$row->photo) }})"></div>
                    <p class='font-semibold w-40 text-sm flex-grow'>{{ $row->productName }}</p>
                    <p class='text-sm'>{{ money($row->price, 'Rp') }}</p>
                </div>		
            </a>
            @endforeach
        </div>
        

        <div class="w-full  justify-center flex">
        
        @if ($data->previousPageUrl())        
            <a href="{{ $data->previousPageUrl() }}">
                <div class="px-2 py-1 border rounded-tl rounded-bl hover:text-[#AC3B61]">
                    <p > Prev </p>
                </div>
            </a>
        @endif
            <div class="px-2 py-1 border">
                <p>1</p>
            </div>
        @if ($data->nextPageUrl())        
            <a href="{{ $data->nextPageUrl() }}">
                <div class="px-2 py-1 border rounded-rt rounded-br hover:text-[#AC3B61]">
                    <p> Next </p>
                </div>
            </a>
        @endif
        </div>
        <script>
            
            const ghijab = document.getElementsByClassName('hijab');
            const gdress = document.getElementsByClassName('dress');
            const gtop = document.getElementsByClassName('top');
            const gbottom = document.getElementsByClassName('bottom');
            const ggoodies = document.getElementsByClassName('goodies');
            const gblouse = document.getElementsByClassName('blouse');
            function showall(){
                for (var i = 0; i < ghijab.length; i++) {ghijab[i].style.display = "block";}
                for (var i = 0; i < gdress.length; i++) {gdress[i].style.display = "block";}
                for (var i = 0; i < gtop.length; i++) {gtop[i].style.display = "block";}
                for (var i = 0; i < gbottom.length; i++) {gbottom[i].style.display = "block";}
                for (var i = 0; i < ggoodies.length; i++) {ggoodies[i].style.display = "block";}
                for (var i = 0; i < gblouse.length; i++) {gblouse[i].style.display = "block";}
            }
            function cathijab(){
                for (var i = 0; i < ghijab.length; i++) {ghijab[i].style.display = "block";}
                for (var i = 0; i < gdress.length; i++) {gdress[i].style.display = "none";}
                for (var i = 0; i < gtop.length; i++) {gtop[i].style.display = "none";}
                for (var i = 0; i < gbottom.length; i++) {gbottom[i].style.display = "none";}
                for (var i = 0; i < ggoodies.length; i++) {ggoodies[i].style.display = "none";}
                for (var i = 0; i < gblouse.length; i++) {gblouse[i].style.display = "none";}
            }
            function catdress(){
                for (var i = 0; i < ghijab.length; i++) {ghijab[i].style.display = "none";}
                for (var i = 0; i < gdress.length; i++) {gdress[i].style.display = "block";}
                for (var i = 0; i < gtop.length; i++) {gtop[i].style.display = "none";}
                for (var i = 0; i < gbottom.length; i++) {gbottom[i].style.display = "none";}
                for (var i = 0; i < ggoodies.length; i++) {ggoodies[i].style.display = "none";}
                for (var i = 0; i < gblouse.length; i++) {gblouse[i].style.display = "none";}
            }
            function cattop(){
                for (var i = 0; i < ghijab.length; i++) {ghijab[i].style.display = "none";}
                for (var i = 0; i < gdress.length; i++) {gdress[i].style.display = "none";}
                for (var i = 0; i < gtop.length; i++) {gtop[i].style.display = "block";}
                for (var i = 0; i < gbottom.length; i++) {gbottom[i].style.display = "none";}
                for (var i = 0; i < ggoodies.length; i++) {ggoodies[i].style.display = "none";}
                for (var i = 0; i < gblouse.length; i++) {gblouse[i].style.display = "none";}
            }
            function catbottom(){
                for (var i = 0; i < ghijab.length; i++) {ghijab[i].style.display = "none";}
                for (var i = 0; i < gdress.length; i++) {gdress[i].style.display = "none";}
                for (var i = 0; i < gtop.length; i++) {gtop[i].style.display = "none";}
                for (var i = 0; i < gbottom.length; i++) {gbottom[i].style.display = "block";}
                for (var i = 0; i < ggoodies.length; i++) {ggoodies[i].style.display = "none";}
                for (var i = 0; i < gblouse.length; i++) {gblouse[i].style.display = "none";}
            }
            function catgoodies(){
                for (var i = 0; i < ghijab.length; i++) {ghijab[i].style.display = "none";}
                for (var i = 0; i < gdress.length; i++) {gdress[i].style.display = "none";}
                for (var i = 0; i < gtop.length; i++) {gtop[i].style.display = "none";}
                for (var i = 0; i < gbottom.length; i++) {gbottom[i].style.display = "none";}
                for (var i = 0; i < ggoodies.length; i++) {ggoodies[i].style.display = "block";}
                for (var i = 0; i < gblouse.length; i++) {gblouse[i].style.display = "none";}
            }
            function catblouse(){
                for (var i = 0; i < ghijab.length; i++) {ghijab[i].style.display = "none";}
                for (var i = 0; i < gdress.length; i++) {gdress[i].style.display = "none";}
                for (var i = 0; i < gtop.length; i++) {gtop[i].style.display = "none";}
                for (var i = 0; i < gbottom.length; i++) {gbottom[i].style.display = "none";}
                for (var i = 0; i < ggoodies.length; i++) {ggoodies[i].style.display = "none";}
                for (var i = 0; i < gblouse.length; i++) {gblouse[i].style.display = "block";}
            }

        </script>
    </main>
@endsection