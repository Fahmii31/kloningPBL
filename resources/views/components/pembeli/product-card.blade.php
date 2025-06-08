<div class="bg-[#E2D8D8] rounded-lg shadow p-4 text-start relative">
    <a href="{{ route('product.show', $product->code_product) }}" class="absolute top-2 right-2 text-gray-700 hover:text-blue-600 text-lg">
        <i class='bx bx-show'></i>
    </a>
    
    <div class="relative pb-4">
        @if ($product->image)
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="mx-auto mb-4 w-32 h-32 object-contain">
        @else
            <div class="w-32 h-32 mx-auto mb-4 flex items-center justify-center bg-gray-200 text-gray-500">
                No Image
            </div>
        @endif
    </div>

    <button class="w-full bg-[#373D49] text-white py-1.5 text-sm rounded-none mt-3"
            onclick="addToCart({{ $product->code_product }})">
        Add to Cart
    </button>

    <div class="border-t border-gray-300 pt-1">
        <h4 class="font-semibold text-xs mt-1">{{ $product->name }}</h4>
        <p class="text-sm">
            <span class="text-blue-600 font-bold">Rp.{{ number_format($product->price, 2, ',', '.') }}</span>
        </p>
    </div>
</div>

<script>
    function addToCart(productId) {
        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw new Error(err.message || 'Gagal tambah ke keranjang'); });
            }
            return response.json();
        })
        .then(data => {
            alert(data.message || 'Berhasil ditambahkan ke keranjang!');
        })
        .catch(error => {
            console.error(error);
            alert(error.message || 'Terjadi kesalahan saat menambahkan produk.');
        });
    }
</script>
