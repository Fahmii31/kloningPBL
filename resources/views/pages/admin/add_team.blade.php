@extends('layouts.admin')

@section('title', 'Add Team Member')

@section('content')
    <h1 class="text-2xl font-medium text-gray-800">Add New Team Member</h1>

    @if(session('success'))
        <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif
    <div class="mt-6 bg-white rounded-lg shadow-sm p-6">
  <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <!-- Photo Upload -->
            <div class="flex flex-col items-center justify-center">
                <div class="mb-2 w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center overflow-hidden">
                    <i class="fas fa-camera text-gray-400 text-2xl" id="photo-icon"></i>
                    <img id="photo-preview" class="hidden w-full h-full object-cover">
                </div>
                <button type="button" class="text-blue-500 text-sm font-medium" onclick="document.getElementById('photo-upload').click()">
                    Upload Photo
                </button>
                <input type="file" id="photo-upload" name="photo" class="hidden" accept="image/*">
            </div>
            <!-- Form Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md">
                    @error('first_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md">
                    @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>
            </div>
    
            <div class="flex justify-center mt-10">
                <button type="submit" class="px-8 py-3 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md">
                    Add Now
                </button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('photo-upload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photo-preview').src = e.target.result;
                    document.getElementById('photo-preview').classList.remove('hidden');
                    document.getElementById('photo-icon').classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
