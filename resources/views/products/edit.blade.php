@extends('layouts.base')

@section('content')

<div class="container mx-auto p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <img src="https://cdn.quasar.dev/img/parallax2.jpg" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md">
            <div class="card-body">
                <form action="{{ route('product.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nome do Produto:</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="form-input">
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-bold mb-2">Preço do Produto:</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="form-input">
                    </div>


                    <div class="mb-4">
                        <label for="stock_quantity" class="block text-gray-700 font-bold mb-2">Quantidade no Estoque:</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="form-input">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold mb-2">Descrição do Produto:</label>
                        <textarea name="description" id="description" class="form-textarea">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
