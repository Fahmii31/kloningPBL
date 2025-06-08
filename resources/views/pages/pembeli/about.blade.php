@extends('layouts.app')

@section('content')

<body class="font-sans bg-white">
  <div class="home-page relative">

    <!-- Breadcrumb -->
    <div class="max-w-4xl mx-auto px-10 flex flex-row items-center gap-3 mt-10">
      <a href="{{ route('home_page') }}" class="text-black hover:underline opacity-50">Home</a>
      <div class="h-4 border-l border-gray-500 opacity-70 transform rotate-45"></div>
      <a href="{{ route('about') }}" class="text-black hover:underline">About</a>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col md:flex-row items-center justify-between px-10 py-6 max-w-4xl mx-auto">
      <!-- Teks di kiri -->
      <div class="text-left max-w-md mb-6 md:mb-0">
        <h2 class="text-2xl font-semibold mb-2">Welcome to E-TechnoCart</h2>
        <p class="text-gray-600">
          {{ $welcomeText }}
        </p>
      </div>
      <!-- Gambar di kanan -->
      <div class="ml-0 md:ml-6 max-w-sm w-full">
        <img src="{{ asset($welcomeImage) }}" alt="Tech Image" class="rounded-lg shadow-md w-full object-cover" />
      </div>
    </div>

    <!-- Grid Team Members -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 max-w-6xl mx-auto px-8 py-4">
      @foreach ($teamMembers as $member)
      <div class="text-center">
        <img src="{{ asset($member['image']) }}" alt="{{ $member['name'] }}" class="w-full h-48 object-cover rounded shadow-md mb-2" />
        <h1 class="text-lg font-semibold mb-1">{{ $member['name'] }}</h1>
        <p class="text-gray-600">{{ $member['role'] }}</p>
        <div class="flex justify-center gap-4 text-xl text-gray-600">
          <a href="{{ $member['instagram'] }}"><i class='bx bxl-instagram'></i></a>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</body>

@endsection
