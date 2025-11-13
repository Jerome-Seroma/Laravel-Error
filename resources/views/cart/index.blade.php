<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Your Shopping Cart') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-ig p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (Cart::count()>0)
                    <table class="min-w-full bg-white">
                        <thread>
                            <tr>
                                <th class="py-2 px-4 border-b">Id</th>
                                <th class="py-2 px-4 border-b">Product</th>
                                <th class="py-2 px-4 border-b">Qty</th>
                                <th class="py-2 px-4 border-b">Price</th>
                                <th class="py-2 px-4 border-b">Subtotal</th>
                                <th class="py-2 px-4 border-b">Action</th>
                            </tr>
                        </thread>
                        <tbody>
                            @foreach (Cart::content() as $item)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $item->id }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->qty }}</td>
                                    <td class="py-2 px-4 border-b">${{ number_format($item->price,2) }}</td>
                                    <td class="py-2 px-4 border-b">${{ number_format($item->subtotal,2) }}</td>
                                    <td class="py-2 px-4 border-b"><form action="{{ route('cart.destroy', $item->rowId) }}" method='POST'>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>                                   
                                        </form>
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="py-2 px-4 border-t text-right font-bold">Total</td>
                                <td colspan="2" class="py-2 px-4 border-t font-bold">${{ Cart::total() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <div class="mt-6 text-right">
                        <a href="/checkout" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                            Proceed to Checkout
                        </a>
                    </div>

                @else
                    <p>Your cart is empty</p>
                    <a href="{{ route('shop') }}" class="text-blue-500 hover:underline">Start Shopping!</a>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>