@extends('layouts.app')

@section('content')

<!-- Wrapper Utama Grid 2 Kolom -->
<div class="flex flex-col md:flex-row min-h-screen">

    <!-- Sidebar -->
    <aside class="w-full md:w-1/3 mt-8 md:mt-12 px-6 md:px-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-3 mb-8">
            <a href="home_page" class="text-black hover:underline opacity-50">Home</a>
            <div class="h-4 border-l border-gray-500 opacity-70 rotate-45"></div>
            <a href="{{ route('profile') }}" class="text-black hover:underline">My Orders</a>
        </nav>

        <!-- Sidebar Menu -->
        <div class="flex flex-col gap-6">
            <!-- Manage Account -->
            <div>
                <h3 class="text-black font-semibold">My Account</h3>
                <a href="{{ route('profile') }}" class="text-blue-500 hover:underline block mt-1">My Profile</a>
            </div>

            <!-- Orders -->
            <div>
                <h3 class="text-black font-semibold">My Orders</h3>
                <a href="/orderList" class="text-blue-500 hover:underline block mt-1">List Order</a>
            </div>
        </div>
    </aside>

    <!-- Konten Utama -->
    <main class="w-full md:w-2/3 mt-12 px-4 md:px-6">
        <section class="w-full">
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 whitespace-nowrap">Product</th>
                            <th class="px-6 py-3 whitespace-nowrap">Price</th>
                            <th class="px-6 py-3 whitespace-nowrap">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @php
                            $orders = [
                                ['image' => 'image/3.png', 'name' => 'TV-LG', 'price' => '$650', 'status' => 'Finish', 'bg' => 'bg-teal-400'],
                                ['image' => 'image/3.png', 'name' => 'TV-LG', 'price' => '$650', 'status' => 'Confirm', 'bg' => 'bg-green-500'],
                                ['image' => 'image/3.png', 'name' => 'TV-LG', 'price' => '$650', 'status' => 'Process', 'bg' => 'bg-amber-400'],
                                ['image' => 'image/3.png', 'name' => 'TV-LG', 'price' => '$650', 'status' => 'Rejected', 'bg' => 'bg-red-500'],
                            ];
                        @endphp

                        @foreach ($orders as $order)
                        <tr class="border-b">
                            <td class="flex items-center gap-4 py-6 px-6 whitespace-nowrap">
                                <img src="{{ asset($order['image']) }}" alt="{{ $order['name'] }}" class="w-12 h-auto">
                                {{ $order['name'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order['price'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="{{ $order['bg'] }} text-white py-1 px-3 rounded-lg text-sm">
                                    {{ $order['status'] }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

</div>

@endsection
