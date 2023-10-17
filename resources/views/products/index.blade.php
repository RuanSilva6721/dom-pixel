@extends('layouts.base')

@section('content')

<div class="container mx-auto p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($products as $product)
        <div class="bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <img src="https://cdn.quasar.dev/img/parallax2.jpg" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md">
            <div class="mt-4">
                <div class="text-2xl font-semibold text-gray-800">{{ $product->name }}</div>
                <div class="text-xl text-primary mt-2">Preço: R$ {{ $product->price }}</div>
                <div class="text-xl mt-2">Quantidade no Estoque: {{ $product->stock_quantity }}</div>
                <div class="text-xl mt-2 text-gray-600">{{ $product->description }}</div>
            </div>
            <div class="mt-4 flex justify-end">
                <a href="{{ route('product.edit', $product->id) }}">
                    <button class="bg-blue-700 text-black px-4 py-2 rounded-md hover:bg-primary-dark transition-transform transform hover:scale-105">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </a>
                <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 ml-4 transition-transform transform hover:scale-105" onclick="showDeleteConfirmation({{ $product->id }})">
                    <i class="fa-solid fa-trash"></i>
                </button>
                <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-12 flex justify-center">
        {{ $products->links() }}
    </div>
</div>

<script>
    function showDeleteConfirmation(productId) {
        if (confirm('Tem certeza de que deseja excluir este produto?')) {
            event.preventDefault();
            document.getElementById('delete-form-' + productId).submit();
        }
    }
</script>
@endsection
