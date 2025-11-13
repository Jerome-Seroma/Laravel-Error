<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Categories') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-ig p-6">
                <div class="mb-4">
                    <table class="min-w-full bg-white">
                        <thread>
                            
                                <th class="py-2 px-4 border-b">Categories</th>
                            
                        </thread>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    
                                    <td>{{ $category->name }}</td>    
                                    <td class="py-2 px-4 border-b">
                                        <form action="{{ route('admin.category.destroy', $category->id) }}" method='POST'>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>                                   
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     <a href="/admin/categories/create" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Add new category
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>