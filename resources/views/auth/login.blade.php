@extends('layouts.app')

@section('title', 'Login')

@section('content')
<section class="flex max-md:flex-col max-lg:flex-row items-center justify-center min-h-screen">
    <div class="w-3/5 lg:flex justify-center mb-10 md:hidden">
        <img src="/image/produk.png" alt="Electronics" class="w-full max-w-md lg:max-w-xl object-contain">
    </div>

    <div class="w-2/5 bg-[#ACC8DD] px-8 py-[150px] rounded-xl shadow-md">
        <h2 class="text-2xl font-semibold text-center -mt-12">Login</h2>
        <p class="text-sm text-center mt-4 text-gray-700">Enter your details below</p>

        @if (session('failed'))
            <div class="text-red-700 mt-10 text-center">{{ session('failed') }}</div>
        @endif

        @if (session('success'))
            <div class="text-green-700 mt-10 text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('dataLogin') }}" method="post" class="space-y-8 mt-12">
            @csrf
            <div class="relative">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                    class="w-full py-2 px-3 pr-10 bg-transparent border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500">
                <i class='bx bx-envelope-open absolute right-3 top-1/2 -translate-y-1/2 text-gray-500'></i>
            </div>
            @error('email')
                <small class="text-red-700">{{ $message }}</small>
            @enderror

            <div class="relative">
                <input type="password" name="password" placeholder="Password"
                    class="w-full py-2 px-3 bg-transparent border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500">
            </div>
            @error('password')
                <small class="text-red-700">{{ $message }}</small>
            @enderror

            <div class="flex justify-between space-x-4 items-center w-full">
                <button type="submit" class="bg-[#70B9EA] text-white py-3 px-5 w-32 rounded-md text-center text-sm hover:bg-blue-600 transition-colors">Login</button>
                <a href="/forget_password1" class="text-black hover:underline">Forget Password?</a>
            </div>
        </form>

        <p class="mt-4 text-sm text-gray-700"> Don't have an account?
            <a href="{{ route('tampilRegister') }}" class="text-blue-600 underline">Register</a>
        </p>
    </div>
</section>
@endsection
