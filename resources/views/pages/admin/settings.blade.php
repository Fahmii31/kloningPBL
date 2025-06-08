@extends('layouts.admin')

@section('title', 'General Settings')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-xl shadow p-8 mt-10">
    <h2 class="text-2xl font-semibold mb-6 text-center">General Settings</h2>

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
                <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}" class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Copyright</label>
                <input type="text" name="copyright" value="{{ old('copyright', $setting->copyright) }}" class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $setting->email) }}" class="w-full px-4 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" class="w-full px-4 py-2 border rounded-md">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <textarea name="address" rows="5" class="w-full px-4 py-2 border rounded-md">{{ old('address', $setting->address) }}</textarea>
            </div>
        </div>

        <div class="flex justify-center mt-8">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-2 rounded-md">Save</button>
        </div>
    </form>
</div>
@endsection
