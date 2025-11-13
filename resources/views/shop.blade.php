<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Shop') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-ig p-6">
                <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <div class="bg-white border border-gray-200 rounded-ig shadow-sm overflow-hidden">
                                <a href="#">
                                    <img class="h-48 w-full object-cover" src="{{ $product->image ? asset('storage/' .$product->image): 'https://via.placeholder.com/300' }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                            <td class="py-2 px-4 border-b text-center">{{ $product->name }}</td>
                            <td class="py-2 px-4 border-b text-center">${{ number_format($product->price,2) }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <form action="{{ route('cart.store', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-blue-500 hover:text-blue-700">Add to Cart</button>
                                </form>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
            
            </div>
        </div>
    </div>
</x-app-layout>