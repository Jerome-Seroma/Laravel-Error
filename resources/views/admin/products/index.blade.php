<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Product Management') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7 xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('admin.products.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Add New Product
            </a>

            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Category</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Stock</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="py-2 px-4 border-b text-center">{{ $product->name }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $product->category?->name  }}</td>
                            <td class="py-2 px-4 border-b text-center">${{ number_format($product->price,2) }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $product->stock }}</td>
                            <td class="py-2 px-4 border-b">
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method='POST'>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>                                   
                                </form>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <form  method='POST'>
                                    
                                    <button type="submit" class="text-blue-500 hover:text-blue-700">Edit</button>                                   
                                </form>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
            <div class="mt-4"></div>
        </div>
    </div>
</x-app-layout>