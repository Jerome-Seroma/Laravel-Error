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
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            {{-- <td class="py-2 px-4 border-b text-center">{{ $order }}</td> --}}
                            <td class="py-2 px-4 border-b text-center">{{ $order->user->name  }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $order->status }}</td>
                            <td class="py-2 px-4 border-b text-center">${{ number_format($order->total,2) }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    View
                                </a>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>


                
            </div>
        </div>
    </div>
</x-app-layout>