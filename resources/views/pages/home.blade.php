@extends('layout/app')

@section('content')
    <main class="relative mt-[5rem] min-h-[400px] flex flex-col items-center">
        <div id="banner" class="relative w-full -z-10">
                <div class="max-w-7xl mx-auto w-full h-[600px] bg-cover contrast-50 hue-rotate-15 grayscale bg-center brightness-50" style="background-image: url({{ asset('images/banner.jpeg') }})"></div>
                <!-- <img class="w-full h-[600px] bg-cover brightness-50" src="assets/images/banner.jpeg"> -->
                <div id="tag" class="flex flex-col gap-2 justify-left absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <img class="w-40 " src="assets/images/instore-logo.svg" alt="">
                    <h1 class="text-white font-semibold text-xl sm:text-3xl">Shop Brand New<br> 2023 Fashion Trends</h1>
                    <a class="w-fit bg-[#AC3B61] p-1 rounded-sm text-white" href="katalog.php">Get Started</a>
                </div>
            </div>
            
            <div id="category" class="flex flex-wrap justify-center max-w-4xl mx-auto w-full items-center py-10">
                <a href="katalog.php?hijab" class="relative">
                    <p class="font-semibold text-center text-white absolute top-3/4 left-1/2 transform -translate-x-1/2 -translate-y-3/4">HIJAB</p>
                    <img src="{{ asset('images/hijab.png') }}">
                </a>
                <a href="katalog.php?dress" class="relative">
                    <p class="font-semibold text-center text-white absolute top-3/4 left-1/2 transform -translate-x-1/2 -translate-y-3/4">DRESS</p>
                    <img src="{{ asset('images/dress.png') }}">
                </a>
                <a href="katalog.php?top" class="relative">
                    <p class="font-semibold text-center text-white absolute top-3/4 left-1/2 transform -translate-x-1/2 -translate-y-3/4">TOP</p>
                    <img src="{{ asset('images/top.png') }}">
                </a>
                <a href="katalog.php?bottom" class="relative">
                    <p class="font-semibold text-center text-white absolute top-3/4 left-1/2 transform -translate-x-1/2 -translate-y-3/4">BOTTOM</p>
                    <img src="{{ asset('images/bottom.png') }}">
                </a>
                <a href="katalog.php?goodies" class="relative">
                    <p class="font-semibold text-center text-white absolute top-3/4 left-1/2 transform -translate-x-1/2 -translate-y-3/4">GOODIES</p>
                    <img src="{{ asset('images/goodies.png') }}">
                </a>
                <a href="katalog.php?blouse" class="relative">
                    <p class="font-semibold text-center text-white absolute top-3/4 left-1/2 transform -translate-x-1/2 -translate-y-3/4">BLOUSE</p>
                    <img src="{{ asset('images/blous.png') }}">
                </a>
            </div>
    </main>
@endsection