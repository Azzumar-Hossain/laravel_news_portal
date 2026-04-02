<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6">
            
            <div class="w-full md:w-1/3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Add New Category</h3>
                    
                    @if(session('success'))
                        <div class="text-green-600 mb-4 text-sm font-medium">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="text-red-600 mb-4 text-sm font-medium">{{ $errors->first() }}</div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                            <input type="text" name="name" id="name" placeholder="e.g. POLITICS" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <div class="mb-4 mt-3">
                            <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Category (Optional)</label>
                            <select name="parent_id" id="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Make this a Main Category --</option>
                                @foreach($mainCategories as $mainCat)
                                    <option value="{{ $mainCat->id }}">{{ $mainCat->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-gray-500">Leave blank unless making a sub-category.</small>
                        </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Save Category
                        </button>
                    </form>
                </div>
            </div>

            <div class="w-full md:w-2/3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Existing Categories</h3>
                    
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 border-gray-200 bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-6 py-4 font-bold text-gray-800">{{ $category->name }}</td>
                                    <td class="px-6 py-4 text-right flex justify-end gap-3">
                                        
                                        <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">Edit</a>
                                        
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-center text-gray-500">No categories found. Create one!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>