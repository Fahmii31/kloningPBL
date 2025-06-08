@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h2 class="text-2xl font-semibold text-gray-800 mb-6">Dashboard</h2>

<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-blue-200 rounded-lg shadow-sm p-6">
        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-600">Total User</p>
                <h3 class="text-2xl font-bold text-gray-800">40,689</h3>
            </div>
            <div class="p-3 bg-blue-300 rounded-lg">
                <i class="fas fa-users text-blue-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-blue-200 rounded-lg shadow-sm p-6">
        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-600">Total Order</p>
                <h3 class="text-2xl font-bold text-gray-800">10293</h3>
            </div>
            <div class="p-3 bg-yellow-200 rounded-lg">
                <i class="fas fa-shopping-bag text-yellow-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-blue-200 rounded-lg shadow-sm p-6">
        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-600">Total Sales</p>
                <h3 class="text-2xl font-bold text-gray-800">$89,000</h3>
            </div>
            <div class="p-3 bg-green-200 rounded-lg">
                <i class="fas fa-dollar-sign text-green-600"></i>
            </div>
        </div>
    </div>
</div>

<!-- Sales Chart -->
<div class="bg-white p-6 rounded-lg shadow-sm mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Sales Statistics</h3>
    <div class="h-80">
        <canvas id="salesChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($salesData)) !!},
                datasets: [{
                    label: 'Sales Revenue ($)',
                    data: {!! json_encode(array_values($salesData)) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
@endsection
