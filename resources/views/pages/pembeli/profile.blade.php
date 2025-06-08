@extends('layouts.app')

@section('content')

<div class="flex flex-col md:flex-row min-h-screen">

    <!-- Sidebar -->
    <div class="w-full md:w-1/3 flex flex-col mt-8 md:mt-12 justify-start items-start gap-8 px-6 md:px-10">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-3">
            <a href="{{ url('/') }}" class="text-black hover:underline opacity-50">Home</a>
            <div class="h-4 border-l border-gray-500 opacity-70 rotate-45"></div>
            <a href="{{ route('profile') }}" class="text-black hover:underline">My Account</a>
        </div>

        <!-- Menu -->
        <div class="flex flex-col items-start gap-6">
            <div>
                <span class="text-black font-semibold">Manage My Account</span>
                <a href="{{ route('profile') }}" class="text-blue-500 hover:underline block">My Profile</a>
                <a href="{{ route('change.password') }}" class="text-blue-500 hover:underline block">Change Password</a>
            </div>

            <div>
                <span class="text-black font-semibold">My Orders</span>
                <a href="/orderList" class="text-blue-500 hover:underline block">List Order</a>
            </div>
        </div>
    </div>

    <!-- Edit Profile Form -->
    <div class="w-full md:w-2/3 px-6 md:px-0">
        <div class="max-w-2xl mx-auto mt-8 md:mt-10 p-6 bg-white shadow-md rounded-xl">
            <h2 class="text-2xl font-bold mb-6 text-blue-300">Edit Your Profile</h2>

            @if (session('success'))
                <div class="mb-4 p-4 rounded bg-green-100 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 rounded bg-red-100 text-red-800">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" method="POST" action="{{ route('profile.update') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="Name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="Name" class="mt-1 block w-full bg-[#e8dedd] px-3 py-2 rounded border border-gray-300" value="{{ old('name', $user->name) }}" />
                    </div>
                    <div>
                        <label for="Phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" id="Phone" class="mt-1 block w-full bg-[#e8dedd] px-3 py-2 rounded border border-gray-300" value="{{ old('phone', $user->phone) }}" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea name="address" id="address" rows="4" class="mt-1 block w-full bg-[#e8dedd] px-3 py-2 rounded border border-gray-300">{{ old('address', $user->address) }}</textarea>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full bg-[#e8dedd] px-3 py-2 rounded border border-gray-300" value="{{ $user->email }}" readonly />
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-4">
                    <button type="reset" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
