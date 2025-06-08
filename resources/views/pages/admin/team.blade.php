@extends('layouts.admin')

@section('title', 'Team Members')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-medium text-gray-800">Team</h1>
  <a href="{{ route('team.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex items-center">Add New Team</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
  @php
    $teamMembers = [
      ['name' => 'Steven Marcell Samosir', 'email' => 'stevenmarcell@gmail.com', 'img' => null],
      ['name' => 'Aisyah Nurwa Hida', 'email' => 'aisyahnurwahida60@gmail.com', 'img' => '/image/ais.png'],
      ['name' => 'Naylah Amirah Az-Zikra', 'email' => 'naylahamirah123@gmail.com', 'img' => null],
      ['name' => 'Fahmi Ahmad Fardani', 'email' => 'fahmiahmadf31070@gmail.com', 'img' => '/image/fahmi.jpg'],
    ];
  @endphp

  @foreach ($teamMembers as $member)
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
      <div class="flex flex-col items-center p-6">
        <div class="mb-4 w-full h-56 bg-gray-100 flex items-center justify-center overflow-hidden">
          @if ($member['img'])
            <img src="{{ $member['img'] }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover">
          @endif
        </div>
        <h3 class="text-lg font-medium text-center mt-2">{{ $member['name'] }}</h3>
        <p class="text-gray-500 text-sm text-center">{{ $member['email'] }}</p>
      </div>
    </div>
  @endforeach
</div>
@endsection
