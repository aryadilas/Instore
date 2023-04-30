<!DOCTYPE html>
<html lang="id">
	<head>
		<!-- <link rel="stylesheet" type="text/css" href="/assets/css/style.css"> -->
		<link rel="icon" type="image/png" href="{{ asset('icons/image/icon.png') }}">
		<link rel="apple-touch-icon" sizes="120x120" href="/assets/image/apple-touch-icon-120x120-precomposed.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/assets/image/apple-touch-icon-152x152-precomposed.png">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Type" content="Text/html; charset=utf-8">
			<title>INstore Admin</title>
			<meta name="title" content="Home Page">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	    <link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	</head>
	<body class="flex flex-col min-h-screen justify-between">
		<header class="border py-3 w-full border-b fixed z-10 bg-white">
			<div class="flex justify-between w-full max-w-7xl mx-auto items-center relative">

				<div id="logo" class="ml-2">
					<img src="{{ asset('images/instore-logo.svg') }}" alt="">
				</div>

                <div class="flex gap-4 items-center sm:flex-com">
                    <svg onclick="showUnshowNav();" id="burger" class="w-6 h-6 hover:bg-slate-400 cursor-pointer border-2 border-slate-600 sm:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>

                    <nav id="nav" class="hidden sm:flex gap-5 items-center sm:static absolute z-20 left-0 top-10 bg-white w-full p-4">
                        <ul class="gap-4 flex flex-col sm:flex-row sm:items-center sm:gap-10 sm:justify-end sm:w-full">

                            <li class="hover:text-[#AC3B61] hover:font-semibold {{ request()->is('admin') ? 'text-[#AC3B61] font-semibold' : '' }}"><a href="/admin">Home</a></li>
							@if (!Auth::user())
                            	<li class="hover:text-[#AC3B61] hover:font-semibold {{ request()->is('login*') ? 'text-[#AC3B61] font-semibold' : '' }}"><a href='/login'>Login</a></li>
							@else
								<li class="hover:text-[#AC3B61] hover:font-semibold {{ request()->is('product*') ? 'text-[#AC3B61] font-semibold' : '' }}"><a href="/product">Product</a></li>
								<li class="hover:text-[#AC3B61] hover:font-semibold {{ request()->is('transaction*') ? 'text-[#AC3B61] font-semibold' : '' }}"><a href="/transaction">Transaction</a></li>
								<li class="hover:text-[#AC3B61] hover:font-semibold {{ request()->is('report*') ? 'text-[#AC3B61] font-semibold' : '' }}"><a href="/report">Report</a></li>	
								<li class="hover:text-[#AC3B61] hover:font-semibold">
									<form action="/logout" method="POST">
										@csrf
										<input type="submit" value="Logout" class="cursor-pointer">
									</form>
								</li>
							@endif

                        </ul>
                    </nav>

                    {{-- <div class="mr-2 group">
                        <a href="/cart" class="">
                            <svg class="hover:fill-[#AC3B61] {{ request()->is('cart*') ? 'fill-[#AC3B61] font-semibold' : '' }}" width="20px" height="20px">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                        </a>
                    </div> --}}
                </div>
			</div>
		</header>