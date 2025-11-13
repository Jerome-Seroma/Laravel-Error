<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium">Order Summary</h3>
                <h4 class="text-xl font-bold mt-2">Total: ${{ Cart::total() }}</h4>

                <form action="{{ route('checkout.store') }}" method="POST" class="mt-6">
                    
                    @csrf
                    <div class="mb-4">
                        <label for="shipping_address" class="block text-sm font-medium text-gray-700">Shipping Address</label>
                        <textarea name="shipping_address" id="shipping_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('shipping_address') }}</textarea>
                    </div>
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                            Place Order
                        </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>