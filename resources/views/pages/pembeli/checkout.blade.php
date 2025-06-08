@extends('layouts.app')

@section('content')
<nav class="text-sm text-gray-600 px-14 mt-4 py-2">
  <a href="{{ route('home_page') }}" class="hover:underline text-blue-600">Home</a> / 
  <a href="{{ route('cart') }}" class="hover:underline text-blue-600">Cart</a> / 
  <span class="text-gray-800 font-medium">Checkout</span>
</nav>

<section class="bg-gray-50 py-10">
  <div class="container mx-auto px-4 flex flex-col lg:flex-row gap-10">
    {{-- Billing Details --}}
    <div class="w-full lg:w-2/3 bg-gray-50 p-8 rounded-lg shadow-md">
      <h2 class="text-2xl font-bold mb-6">Billing Details</h2>
      <!--<form method="POST" action=" id="checkoutForm" class="space-y-4">
  @csrf

  <div>
    <label class="block mb-1 mt-8">Name</label>
    <input type="text" name="name" required class="w-full border rounded-md p-2 bg-gray-200">
  </div>
  <div>
    <label class="block mb-1 mt-8">Address</label>
    <input type="text" name="address" required class="w-full border rounded-md p-2 bg-gray-200">
  </div>
  <div>
    <label class="block mb-1 mt-8">Phone Number</label>
    <input type="text" name="phone" required class="w-full border rounded-md p-2 bg-gray-200">
  </div>
  <div>
    <label class="block mb-1 mt-8">Email Address</label>
    <input type="email" name="email" required class="w-full border rounded-md p-2 bg-gray-200">
  </div>
  <div class="flex items-center mt-4">
    <input type="checkbox" class="mr-2" checked>
    <label>Save this information for faster check-out next time</label>
  </div>
</form>-->


      <form class="space-y-4">
        <div>
          <label class="block mb-1 mt-8">Name</label>
          <input type="text" class="w-full border rounded-md p-2 bg-gray-200" required>
        </div>
        <div>
          <label class="block mb-1 mt-8">Address</label>
          <input type="text" class="w-full border rounded-md p-2 bg-gray-200" required>
        </div>
        <div>
          <label class="block mb-1 mt-8">Phone Number</label>
          <input type="text" class="w-full border rounded-md p-2 bg-gray-200" required>
        </div>
        <div>
          <label class="block mb-1 mt-8">Email Address</label>
          <input type="email" class="w-full border rounded-md p-2 bg-gray-200" required>
        </div>
        <div class="flex items-center mt-4">
          <input type="checkbox" class="mr-2" checked>
          <label>Save this information for faster check-out next time</label>
        </div>
      </form>
    </div>

    {{-- Order Summary --}}
    <div class="w-full lg:w-1/3 bg-white p-8 rounded-lg shadow-md">
      <div class="space-y-4 mb-6">
      @foreach ($cart as $item)
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <img src="{{ asset($item['image']) }}" class="w-10 h-10 rounded-md">
            <span class="font-medium">{{ $item['name'] }} x{{ $item['quantity'] }}</span>
          </div>
          <span>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
        </div>
      @endforeach
    </div>

      <div class="border-t pt-4 space-y-2">
        <div class="flex justify-between font-semibold text-lg pt-2">
          <span>Total:</span>
          <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
      </div>

      <div class="mt-6 space-y-4 relative">
  <!-- BANK TRANSFER -->
  <div class="relative">
    <label class="flex items-center justify-between cursor-pointer">
      <div class="flex items-center">
        <input type="radio" name="payment" id="bank" class="mr-2">
        <span>Bank Transfer</span>
      </div>
      <div id="bankLogo" class="hidden">
        <img src="" alt="Selected Bank" class="w-10 h-6 object-contain">
      </div>
    </label>

    <!-- Card: Bank Options -->
    <div id="bankCard" class="absolute z-10 mt-2 hidden bg-white border border-gray-200 rounded-md shadow-lg p-4 w-64">
      <p class="font-semibold mb-2">Pilih Bank:</p>
      <label class="flex items-center space-x-2 mb-2 cursor-pointer">
        <input type="radio" name="bank_option" value="BNI" data-img="{{ asset('image/bni.png') }}">
        <img src="{{ asset('image/bni.png') }}" class="w-10 h-6 object-contain"> <span>BNI</span>
      </label>
      <label class="flex items-center space-x-2 cursor-pointer">
        <input type="radio" name="bank_option" value="Mandiri" data-img="{{ asset('image/mandiri.png') }}">
        <img src="{{ asset('image/mandiri.png') }}" class="w-10 h-6 object-contain"> <span>Mandiri</span>
      </label>
    </div>
  </div>

  <!-- E-WALLET -->
  <div class="relative">
    <label class="flex items-center justify-between cursor-pointer">
      <div class="flex items-center">
        <input type="radio" name="payment" id="ewallet" class="mr-2" checked>
        <span>E-Wallet</span>
      </div>
      <div id="ewalletLogo" class="hidden">
        <img src="" alt="Selected Wallet" class="w-10 h-6 object-contain">
      </div>
    </label>

    <!-- Card: E-Wallet Options -->
    <div id="ewalletCard" class="absolute z-10 mt-2 bg-white border border-gray-200 rounded-md shadow-lg p-4 w-64">
      <p class="font-semibold mb-2">Pilih E-Wallet:</p>
      <label class="flex items-center space-x-2 mb-2 cursor-pointer">
        <input type="radio" name="ewallet_option" value="DANA" data-img="{{ asset('image/dana.png') }}">
        <img src="{{ asset('image/dana.png') }}" class="w-10 h-6 object-contain"> <span>DANA</span>
      </label>
      <label class="flex items-center space-x-2 cursor-pointer">
        <input type="radio" name="ewallet_option" value="OVO" data-img="{{ asset('image/ovo.png') }}">
        <img src="{{ asset('image/ovo.png') }}" class="w-10 h-6 object-contain"> <span>OVO</span>
      </label>
    </div>
  </div>
</div>



<!--<div id="flashMessage" class="hidden bg-green-100 text-green-700 px-4 py-2 rounded-md mb-4"></div>-->

      <a href="{{ route('home_page') }}" class="mt-6 w-full bg-blue-400 hover:bg-blue-500 text-white font-semibold py-3 rounded-md text-center block">Place Order</a>
    </div>
  </div>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const bankRadio = document.getElementById('bank');
    const ewalletRadio = document.getElementById('ewallet');

    const bankCard = document.getElementById('bankCard');
    const ewalletCard = document.getElementById('ewalletCard');

    const bankLogo = document.getElementById('bankLogo');
    const ewalletLogo = document.getElementById('ewalletLogo');

    function showCard(type) {
      if (type === 'bank') {
        bankCard.classList.remove('hidden');
        ewalletCard.classList.add('hidden');
        // Reset logo ewallet
        ewalletLogo.classList.add('hidden');
        ewalletLogo.querySelector('img').src = '';
      } else {
        ewalletCard.classList.remove('hidden');
        bankCard.classList.add('hidden');
        // Reset logo bank
        bankLogo.classList.add('hidden');
        bankLogo.querySelector('img').src = '';
      }
    }

    // Initial state
    if (bankRadio.checked) {
      showCard('bank');
    } else {
      showCard('ewallet');
    }

    // On method change
    bankRadio.addEventListener('change', () => showCard('bank'));
    ewalletRadio.addEventListener('change', () => showCard('ewallet'));

    // Option inside cards
    document.querySelectorAll('input[name="bank_option"]').forEach(input => {
      input.addEventListener('change', function () {
        const selectedImage = this.getAttribute('data-img');
        bankLogo.querySelector('img').src = selectedImage;
        bankLogo.classList.remove('hidden');
        bankCard.classList.add('hidden');
      });
    });

    document.querySelectorAll('input[name="ewallet_option"]').forEach(input => {
      input.addEventListener('change', function () {
        const selectedImage = this.getAttribute('data-img');
        ewalletLogo.querySelector('img').src = selectedImage;
        ewalletLogo.classList.remove('hidden');
        ewalletCard.classList.add('hidden');
      });
    });
  });
</script>
@endsection
