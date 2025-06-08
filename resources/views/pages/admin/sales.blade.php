@extends('layouts.admin')

@section('title', 'Sales Report')

@section('content')
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Main content -->
            <main class="flex-1 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold">Sales Report</h2>
                </div>

                <!-- Report table -->
                <div class="bg-white shadow rounded-lg p-6">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-3">Id Product</th>
                                <th class="p-3">Product</th>
                                <th class="p-3">Brand</th>
                                <th class="p-3">Quantity</th>
                                <th class="p-3">Base Cost</th>
                                <th class="p-3">Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $item)
                                <tr class="border-t">
                                    <td class="p-3">{{ $item['id'] }}</td>
                                    <td class="p-3">{{ $item['product'] }}</td>
                                    <td class="p-3">{{ $item['brand'] }}</td>
                                    <td class="p-3">{{ $item['quantity'] }}</td>
                                    <td class="p-3">${{ $item['base_cost'] }}</td>
                                    <td class="p-3">${{ $item['total_cost'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex items-center justify-between mt-6">
                        <div class="text-lg font-semibold">Total = <span class="text-blue-600">${{ $total }}</span></div>
                        <div class="space-x-2">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Print</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
@endsection
