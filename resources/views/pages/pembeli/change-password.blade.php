@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">

    <!-- Tombol Back ke My Profile -->
    <div class="mb-6">
        <a href="{{ route('profile') }}" 
           class="inline-block text-blue-500 hover:underline font-semibold">
            ← Back to My Profile
        </a>
    </div>

    <h2 class="text-2xl font-bold text-blue-500 mb-6">Change Password</h2>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Pesan error global -->
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('change.password.update') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
            <input 
                id="current_password" 
                type="password" 
                name="current_password"
                class="mt-1 block w-full px-3 py-2 rounded border bg-[#e8dedd] border-gray-300 focus:ring-2 focus:ring-blue-500" 
                required
            />
            @error('current_password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
            <input 
                id="new_password" 
                type="password" 
                name="new_password"
                class="mt-1 block w-full px-3 py-2 rounded border bg-[#e8dedd] border-gray-300 focus:ring-2 focus:ring-blue-500" 
                required
            />
            @error('new_password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
            <input 
                id="new_password_confirmation" 
                type="password" 
                name="new_password_confirmation"
                class="mt-1 block w-full px-3 py-2 rounded border bg-[#e8dedd] border-gray-300 focus:ring-2 focus:ring-blue-500" 
                required
            />
        </div>

        <button 
            type="submit" 
            class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
        >
            Update Password
        </button>
    </form>
</div>

@endsection
