@extends('layouts.app')

@section('title', 'Register')

@section('content')

<section class="flex max-md:flex-col max-lg:flex-row items-center justify-center min-h-screen">
    <!-- Gambar Produk -->
    <div class="w-3/5 lg:flex justify-center mb-10 md:hidden">
        <img src="/image/produk.png" alt="Electronics" class="w-full max-w-md lg:max-w-xl object-contain">
    </div>

    <!-- Form Registrasi -->
    <div class="w-2/5 bg-[#ACC8DD] px-8 py-[150px] rounded-xl shadow-md">
        <h2 class="text-2xl font-semibold text-center -mt-12">Forgot Password</h2>
        <p class="text-sm text-center mt-4 text-gray-700">Enter a new password</p>
        <form class="space-y-8 mt-12">
            <input type="password" placeholder="New Password" class="w-full py-2 px-3 bg-transparent border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500">
            <input type="password" placeholder="Confirm Password" class="w-full py-2 px-3 bg-transparent border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500">
            <div class="flex justify-between space-x-4 items-center w-full">
                <a href="/home_page" class="bg-[#70B9EA] text-white py-3 px-5 w-32 rounded-md text-center text-sm hover:bg-blue-600 transition-colors">Continue</a>
            </div>
        </form>
    </div>
</section>

@endsection 