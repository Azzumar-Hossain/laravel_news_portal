<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category: ') }} {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if($errors->any())
                    <div class="text-red-600 mb-4 text-sm font-medium">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Category (Optional)</label>
                        <select name="parent_id" id="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Make this a Main Category --</option>
                            @foreach($mainCategories as $mainCat)
                                <option value="{{ $mainCat->id }}" {{ $category->parent_id == $mainCat->id ? 'selected' : '' }}>
                                    {{ $mainCat->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-gray-500">Leave blank to make this a top-level category.</small>
                    </div>

                    <div class="mb-6">
                        <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order (Menu Position)</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <small class="text-gray-500">Lower numbers appear first in the navigation bar (e.g., 1, 2, 3).</small>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Update Category
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>