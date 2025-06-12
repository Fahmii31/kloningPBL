@extends('layouts.app')

@section('content')
<nav class="text-sm text-gray-600 px-14 mt-4 py-2">
  <a href="{{ route('home_page') }}" class="hover:underline text-blue-600">Home</a> / 
  <a href="{{ route('cart') }}" class="hover:underline text-blue-600">Cart</a> / 
  <span class="text-gray-800 font-medium">Checkout</span>
</nav>

<section class="bg-gray-50 py-10">
  <div class="container mx-auto px-4 flex flex-col lg:flex-row gap-10">
    <!-- Form Pembayaran -->
    <form action="{{ route('checkout.submit') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-10 w-full">
      @csrf

      {{-- Billing Details --}}
      <div class="w-full lg:w-2/3 bg-gray-50 p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Billing Details</h2>
        <div class="space-y-4">
          <div>
            <label class="block mb-1 mt-8">Name:</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div>
            <label class="block mb-1 mt-8">Address:</label>
            <input type="text" name="alamat" value="{{ $user->address }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div>
            <label class="block mb-1 mt-8">Phone Number:</label>
            <input type="text" name="nohp" value="{{ $user->phone }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div>
            <label class="block mb-1 mt-8">Email Address:</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded-md p-2 bg-gray-200" readonly>
          </div>
          <div class="flex items-center mt-4">
            <input type="checkbox" class="mr-2" checked disabled>
            <label>Save this information for faster check-out next time</label>
          </div>
        </div>
      </div>

      {{-- Order Summary + Payment --}}
      <div class="w-full lg:w-1/3 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
        <div class="space-y-4 mb-6">
          @foreach ($cartItems as $item)
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->product_name }}" class="w-10 h-10 rounded-md">
                <span class="font-medium">{{ $item->product->product_name }} x{{ $item->quantity }}</span>
              </div>
              <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
            <input type="hidden" name="selected_items[]" value="{{ $item->code_cart }}">
          @endforeach
        </div>

        <div class="border-t pt-4 space-y-2">
          <div class="flex justify-between font-semibold text-lg pt-2">
            <span>Total:</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
          </div>
        </div>

        <div class="mt-6">
          <h3 class="text-xl font-semibold mb-4">Payment Method</h3>

          <!-- BANK TRANSFER -->
          <div class="mb-4">
            <p class="font-medium mb-2">Bank Transfer:</p>
            <label class="flex items-center space-x-2 mb-2 cursor-pointer">
              <input type="radio" name="payment_method" value="bni" data-img="{{ asset('image/bni.png') }}">
              <img src="{{ asset('image/bni.png') }}" class="w-10 h-6 object-contain"> <span>BNI</span>
            </label>
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="radio" name="payment_method" value="mandiri" data-img="{{ asset('image/mandiri.png') }}">
              <img src="{{ asset('image/mandiri.png') }}" class="w-10 h-6 object-contain"> <span>Mandiri</span>
            </label>
          </div>

          <!-- E-Wallet -->
          <div class="mt-4">
            <p class="font-medium mb-2">E-Wallet:</p>
            <label class="flex items-center space-x-2 mb-2 cursor-pointer">
              <input type="radio" name="payment_method" value="dana" data-img="{{ asset('image/dana.png') }}">
              <img src="{{ asset('image/dana.png') }}" class="w-10 h-6 object-contain"> <span>DANA</span>
            </label>
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="radio" name="payment_method" value="ovo" data-img="{{ asset('image/ovo.png') }}">
              <img src="{{ asset('image/ovo.png') }}" class="w-10 h-6 object-contain"> <span>OVO</span>
            </label>
          </div>

          <!-- Input Bukti Pembayaran -->
          <input type="file" id="payment_proof" name="payment_proof" accept="image/*" class="hidden">

          <!-- Modal Konfirmasi -->
          <div id="paymentPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
              <button onclick="closePopup()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl font-bold">&times;</button>
              <h2 class="text-2xl font-semibold mb-4 text-center text-blue-600">Konfirmasi Pembayaran</h2>
              <div class="mb-4">
                <p class="text-gray-700 mb-1">Metode Pembayaran: <span id="paymentMethod" class="font-semibold">-</span></p>
                <p class="text-gray-700">Transfer ke nomor berikut:</p>
                <p class="text-lg font-bold text-blue-700 mt-1">0812 3456 7890 (a.n. E-tecnoCart)</p>
              </div>
              <div class="mb-4">
                <label for="popup_bukti" class="block text-gray-700 font-medium mb-2">Upload Bukti Pembayaran:</label>
                <input type="file" id="popup_bukti" accept="image/*" class="w-full border rounded p-2">
              </div>
              <button onclick="confirmPopupUpload()" type="button" class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700 transition">Simpan</button>
            </div>
          </div>

          <!-- Tombol Submit -->
          <button type="submit" class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-md">
            Place Order
          </button>
        </div>
      </div>
    </form>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="payment_method"]');
    radios.forEach(radio => {
      radio.addEventListener('change', function () {
        const val = this.value;
        if (val === 'dana' || val === 'ovo') {
          showPopup(val);
        } else {
          closePopup();
        }
      });
    });
  });

  function showPopup(method) {
    document.getElementById('paymentPopup').classList.remove('hidden');
    document.getElementById('paymentMethod').innerText = method.toUpperCase();
  }

  function closePopup() {
    document.getElementById('paymentPopup').classList.add('hidden');
  }

  function confirmPopupUpload() {
    const popupInput = document.getElementById('popup_bukti');
    const mainInput = document.getElementById('payment_proof');

    if (!popupInput.files.length) {
      alert("Silakan upload bukti pembayaran terlebih dahulu.");
      return;
    }

    mainInput.files = popupInput.files;

    alert("Bukti pembayaran berhasil dilampirkan.");
    closePopup();
  }
</script>
@endsection
