@extends('layout/app')

@section('content')
    <main class="relative mt-24 min-h-[400px] flex items-center">
        <div class="mx-auto justify-center gap-4 p-6 border flex flex-col max-w-xs w-full ">
            <h1 class="w-full font-semibold text-3xl py-3 text-white rounded-md text-center bg-[#AC3B61]">Register</h1>
            <form action="/register" method="POST">
                @csrf
                <div class="flex flex-col gap-2 justify-center">
                    <div class="flex flex-col">
                        <label for="name" class="text-sm mb-2">Name</label>
                        <input class="border rounded-md py-1 px-4" type="text" name="name">
                    </div>
                    <div class="flex flex-col">
                        <label for="email" class="text-sm mb-2">Email</label>
                        <input class="border rounded-md py-1 px-4" type="email" name="email">
                    </div>
                    <div class="flex flex-col">
                        <label for="password" class="text-sm mb-2">Password</label>
                        <input class="border rounded-md py-1 px-4" type="password" name="password">
                    </div>
                    <input class="cursor-pointer mt-10 bg-[#123C69] text-white rounded-md p-2" type="submit" name="register" value="Register">
                    <p class="text-sm text-center">Sudah Punya Akun? <a class="text-[#123C69]" href="/login">Login</a></p>
                </div>
            </form>
        </div>
    </main>
@endsection