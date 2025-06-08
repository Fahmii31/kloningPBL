@extends('layouts.app')

@section('content')

<body class="font-sans bg-white">
  <div class="home-page relative">

    <!-- Breadcrumb -->
    <div class="max-w-4xl mx-auto px-10 flex flex-row items-center gap-3 mt-10">
      <a href="home_page" class="text-black hover:underline opacity-50">Home</a>
      <div class="h-4 border-l border-gray-500 opacity-70 transform rotate-45"></div>
      <a href="{{ route('contact') }}" class="text-black hover:underline">Contact</a>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col md:flex-row items-start justify-between px-6 md:px-10 py-6 max-w-6xl mx-auto gap-8">

      <!-- Informasi Kontak di Kiri -->
      <div class="w-full md:w-1/3 flex items-center">
        <div class="bg-white p-6 rounded-xl shadow w-full">
          <div class="flex justify-start gap-4 text-xl text-blue-400">
            <i class='bx bxs-phone'></i>
            <h2 class="text-xl font-semibold text-black mb-4">Call To Us</h2>
          </div>
          <p class="mb-4 pb-4 border-b border-gray-300">
            <span class="text-gray-600">We are available 24/7</span><br />
            Phone: +62 83111590529
          </p>
          <div class="flex justify-start gap-4 text-xl text-blue-400">
            <i class='bx bx-envelope'></i>
            <h2 class="text-xl font-semibold text-black mb-4">Write To Us</h2>
          </div>
          <p>
            <span class="text-gray-600">Fill out our form and we will contact you within 24 hours.</span><br>
            etechnocart02@gmail.com
          </p>
        </div>
      </div>

      <!-- Form Kontak di Kanan -->
      <form method="POST" action="{{ route('contact.send') }}" class="w-full md:w-2/3 bg-white p-6 rounded-xl shadow">
        @csrf

        <!-- Flash Message -->
        @if(session('success'))
        <div class="p-4 mb-4 text-green-800 rounded-lg bg-green-100">
          {{ session('success') }}
        </div>
        @endif

        <!-- Form Fields -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
          <input type="text" name="name" placeholder="Your Name"
            class="p-3 border rounded-none bg-[#e8dedd] focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          <input type="email" name="email" placeholder="Your Email"
            class="p-3 border rounded-none bg-[#e8dedd] focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          <input type="tel" name="phone" placeholder="Your Phone"
            class="p-3 border rounded-none bg-[#e8dedd] focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        </div>

        <textarea name="message" placeholder="Your Message"
          class="w-full h-32 p-3 border rounded-none bg-[#e8dedd] resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
          required></textarea>

        <div class="flex flex-col md:flex-row justify-end gap-4 mt-4">
          <button type="submit"
            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition">
            Send Message</button>
        </div>
      </form>

    </div>
  </div>

</body>
@endsection
