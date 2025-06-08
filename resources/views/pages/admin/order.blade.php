@extends('layouts.admin')

@section('title', 'Order')

@section('content')
<div x-data="orderTable()" class="space-y-6">
  <div class="flex items-center justify-between">
    <h2 class="text-2xl font-bold">Order Lists</h2>
  </div>

  <!-- Filter Bar -->
  <div class="flex items-center space-x-2">
    <button class="flex items-center border px-4 py-2 rounded bg-white hover:bg-gray-50">🔍 Filter By</button>

    <div class="flex space-x-4">
      <!-- Filter Order Product -->
      <select x-model="selectedProduct"
        class="border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
        <option value="">Order Product</option>
        <option>Television</option>
        <option>Fan</option>
        <option>Air Conditioner</option>
        <option>Refrigerator</option>
        <option>Dispenser</option>
        <option>Rice Cooker</option>
        <option>Washing Machine</option>
      </select>

      <!-- Filter Order Status -->
      <select x-model="selectedStatus"
        class="border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
        <option value="">Order Status</option>
        <option>Processing</option>
        <option>Send</option>
        <option>Completed</option>
        <option>Rejected</option>
      </select>

      <!-- Filter Date -->
      <div class="relative inline-block">
        <button class="border px-4 py-2 rounded">Date</button>
        <input x-model="selectedDate" type="date" class="border px-2 py-2 rounded mt-2">
      </div>
    </div>

    <button @click="resetFilters()" class="text-red-500 ml-4">Reset Filter</button>
  </div>

  <!-- Order Table -->
  <div class="bg-white shadow rounded-lg p-4">
    <table class="w-full text-left border-collapse">
      <thead>
        <tr class="bg-gray-100">
          <th class="p-3">ID</th>
          <th class="p-3">Name</th>
          <th class="p-3">Address</th>
          <th class="p-3">Date</th>
          <th class="p-3">Product</th>
          <th class="p-3">Status</th>
        </tr>
      </thead>
      <tbody>
        <template x-for="order in filteredOrders" :key="order.id">
          <tr class="border-t">
            <td class="p-3" x-text="order.id"></td>
            <td class="p-3" x-text="order.name"></td>
            <td class="p-3" x-text="order.address"></td>
            <td class="p-3" x-text="order.date"></td>
            <td class="p-3" x-text="order.product"></td>
            <td class="p-3">
              <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" 
                  :class="{
                    'bg-purple-100 text-purple-800': order.status === 'Send',
                    'bg-yellow-100 text-yellow-800': order.status === 'Processing',
                    'bg-green-100 text-green-800': order.status === 'Completed',
                    'bg-red-100 text-red-800': order.status === 'Rejected'
                  }"
                  class="px-2 py-1 rounded text-sm font-medium">
                  <span x-text="order.status"></span>
                </button>

                <!-- Status Dropdown -->
                <div x-show="open" @click.outside="open = false"
                  class="absolute z-10 mt-1 w-36 bg-white border border-gray-200 rounded-lg shadow-lg">
                  <template x-for="status in ['Processing', 'Send', 'Completed', 'Rejected']" :key="status">
                    <button @click="order.status = status; open = false"
                      :class="{
                        'bg-yellow-100 text-yellow-800 hover:bg-yellow-200': status === 'Processing',
                        'bg-purple-100 text-purple-800 hover:bg-purple-200': status === 'Send',
                        'bg-green-100 text-green-800 hover:bg-green-200': status === 'Completed',
                        'bg-red-100 text-red-800 hover:bg-red-200': status === 'Rejected'
                      }"
                      class="w-full text-left px-3 py-2 text-sm">
                      <span x-text="status"></span>
                    </button>
                  </template>
                </div>
              </div>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</div>

<script>
  function orderTable() {
    return {
      selectedProduct: '',
      selectedStatus: '',
      selectedDate: '',
      orders: [
        { id: '00001', name: 'Christine Brooks', address: '089 Kutch Green Apt. 448', date: '2019-09-04', product: 'Television', status: 'Processing' },
        { id: '00002', name: 'Rosie Pearson', address: '979 Immanuel Ferry Suite 526', date: '2019-05-28', product: 'Refrigerator', status: 'Send' },
        { id: '00003', name: 'Darrell Caldwell', address: '8587 Frida Ports', date: '2019-11-23', product: 'Dispenser', status: 'Completed' },
        { id: '00004', name: 'Brett Tyler', address: '242 Collier Viaduct', date: '2020-01-01', product: 'Fan', status: 'Rejected' },
        { id: '00005', name: 'Alison Walker', address: '778 King Street', date: '2020-03-12', product: 'Washing Machine', status: 'Processing' },
        { id: '00006', name: 'David Smith', address: '2322 River Road', date: '2021-07-20', product: 'Rice Cooker', status: 'Completed' },
        { id: '00007', name: 'Diana Waters', address: '125 Elm Street', date: '2022-06-15', product: 'Air Conditioner', status: 'Send' },
      ],
      get filteredOrders() {
        return this.orders.filter(order => {
          const matchProduct = this.selectedProduct === '' || order.product === this.selectedProduct;
          const matchStatus = this.selectedStatus === '' || order.status === this.selectedStatus;
          const matchDate = this.selectedDate === '' || order.date === this.selectedDate;
          return matchProduct && matchStatus && matchDate;
        });
      },
      resetFilters() {
        this.selectedProduct = '';
        this.selectedStatus = '';
        this.selectedDate = '';
      }
    }
  }
</script>
@endsection
