@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<section class="flex max-md:flex-col max-lg:flex-row items-center justify-center min-h-screen">
    <!-- Gambar Produk -->
    <div class="w-3/5 lg:flex justify-center mb-10 md:hidden">
        <img src="/image/produk.png" alt="Electronics" class="w-full max-w-md lg:max-w-xl object-contain">
    </div>

    <!-- Form Reset Password -->
    <div class="w-2/5 bg-[#ACC8DD] px-8 py-[150px] rounded-xl shadow-md">
        <h2 class="text-2xl font-semibold text-center -mt-12">Reset Password</h2>
        <p class="text-sm text-center mt-4 text-gray-700">Enter a new password</p>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-8 mt-12">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <input type="password" name="password" placeholder="New Password" required
                class="w-full py-2 px-3 bg-transparent border border-gray-300 rounded-md 
                       focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500">

            <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                class="w-full py-2 px-3 bg-transparent border border-gray-300 rounded-md 
                       focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800 placeholder-gray-500">

            @error('password')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror

            @if(session('status'))
                <p class="text-green-600 text-sm text-center">{{ session('status') }}</p>
            @endif

            <div class="flex justify-between space-x-4 items-center w-full">
                <button type="submit"
                    class="bg-[#70B9EA] text-white py-3 px-5 w-32 rounded-md text-center text-sm hover:bg-blue-600 transition-colors">
                    Continue
                </button>
            </div>
        </form>
    </div>
</section>

@endsection
