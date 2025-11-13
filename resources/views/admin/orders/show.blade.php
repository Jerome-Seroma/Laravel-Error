<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Orders') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-ig p-6">

                <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Shipping address</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {{-- <td class="py-2 px-4 border-b text-center">{{ $order }}</td> --}}
                        <td class="py-2 px-4 border-b text-center">{{ $order->user->name  }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $order->status }}</td>
                        <td class="py-2 px-4 border-b text-center">${{ number_format($order->total,2) }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $order->user->email }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $order->shipping_address }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <div class="mb-4">
                                
                                <form  action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="{{ $order->status }}"> Select a status </option>
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                         Save status
                                    </button>
                                </form>
                        
                            </div>
                        </td>
                    </tr>
                </tbody>
                <a href="{{ route('admin.orders.index') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    return
                </a>
            </div>
        </div>
    </div>
</x-app-layout>