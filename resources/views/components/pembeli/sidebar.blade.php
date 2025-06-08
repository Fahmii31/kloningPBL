<aside class="space-y-2 hidden md:block">
    <ul class="bg-[#b0cee3] shadow p-4 space-y-2">
        @foreach (\App\Models\Category::where('status', 'ON')->get() as $category)
            <li>
                <a href="{{ route('category.show', ['code' => $category->code]) }}" class="block hover:text-blue-700">
                    {{ ucfirst($category->name) }}
                </a>
            </li>
        @endforeach
    </ul>
</aside>
