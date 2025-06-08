<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Invoice</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 px-20">
  <div class="max-w-3xl mx-auto bg-white shadow-md rounded border border-gray-300">
    <!-- Header -->
    <div class="flex justify-between items-center bg-blue-100 px-10 py-4 border-b">
      <h1 class="text-lg font-semibold text-gray-700">E-TechnoCart</h1>
      <span class="font-bold text-gray-800">Invoice</span>
    </div>

    <!-- Order Details -->
    <div class="px-12 py-4">
      <h2 class="text-xl font-bold mb-4">Order Details</h2>
      <div class="space-y-2 text-sm font-semibold text-gray-700">
        <p>Order ID : {{ $order['id'] }}</p>
        <p>Order Date : {{ $order['date'] }}</p>
        <p>Name : {{ $order['name'] }}</p>
        <p>Address : {{ $order['address'] }}</p>
        <p>Phone : {{ $order['phone'] }}</p>
        <p>Payment Method : {{ $order['payment_method'] }}</p>
      </div>
    </div>

    <!-- Table -->
    <div class="px-6">
      <div class="overflow-x-auto">
        <table class="w-full text-center shadow-sm rounded overflow-hidden border">
          <thead class="bg-gray-200 text-gray-700 font-semibold text-sm">
            <tr>
              <th class="px-4 py-2">Product</th>
              <th class="px-4 py-2">Quantity</th>
              <th class="px-4 py-2">Price</th>
              <th class="px-4 py-2">Total</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ($invoiceProducts as $product)
              <tr class="border-t">
                <td class="flex items-center justify-center gap-2 px-4 py-2">
                  <img src="{{ asset($product['image_path']) }}" alt="{{ $product['name'] }}" class="w-10 h-10 object-cover rounded" />
                  <span>{{ $product['name'] }}</span>
                </td>
                <td class="px-4 py-2">1</td> <!-- Asumsikan quantity 1, sesuaikan jika perlu -->
                <td class="px-4 py-2">${{ number_format($product['price'], 2) }}</td>
                <td class="px-4 py-2">${{ number_format($product['price'], 2) }}</td> <!-- Total sama dengan harga untuk quantity 1 -->
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Sub Total -->
    <div class="px-20 py-4 text-right font-semibold text-gray-700">
      <p>Sub Total : ${{ number_format($subTotal, 2) }}</p>
    </div>

    <!-- Done Button -->
    <div class="px-6 pb-6 text-right">
      <button class="bg-blue-400 hover:bg-blue-500 text-white font-medium px-6 py-2 rounded shadow">Done</button>
    </div>
  </div>
</body>
</html>
