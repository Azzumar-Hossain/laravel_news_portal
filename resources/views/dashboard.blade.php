<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <a href="{{ route('articles.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium">
                + Create New Article
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Published Articles</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm whitespace-nowrap">
                            <thead class="uppercase tracking-wider border-b-2 border-gray-200 bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Image</th>
                                    <th scope="col" class="px-6 py-4">Title</th>
                                    <th scope="col" class="px-6 py-4">Category</th>
                                    <th scope="col" class="px-6 py-4">Featured</th>
                                    <th scope="col" class="px-6 py-4">Date</th>
                                    <th scope="col" class="px-6 py-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 align-middle">

                                        <td class="px-6 py-3">
                                            @if ($article->thumbnail_url)
                                                <img src="{{ $article->thumbnail_url }}" alt="Thumbnail"
                                                    style="width: 64px; height: 48px; object-fit: cover; border-radius: 4px; border: 1px solid #e5e7eb;">
                                            @elseif($article->image_url)
                                                <img src="{{ $article->image_url }}" alt="Thumbnail"
                                                    style="width: 64px; height: 48px; object-fit: cover; border-radius: 4px; border: 1px solid #e5e7eb;">
                                            @else
                                                <div
                                                    style="width: 64px; height: 48px; background-color: #f3f4f6; border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; color: #9ca3af; border: 1px solid #e5e7eb;">
                                                    No Img
                                                </div>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ Str::limit($article->title, 40) }}</td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="bg-gray-100 text-gray-800 text-xs font-semibold px-2 py-1 rounded">
                                                {{ $article->category }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4">
                                            @if ($article->is_featured)
                                                <span
                                                    class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded">Yes</span>
                                            @else
                                                <span class="text-gray-400 text-xs">No</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-gray-500">{{ $article->created_at->format('M d, Y') }}
                                        </td>

                                        <td class="px-6 py-4 flex gap-3 items-center mt-2">
                                            <a href="{{ route('articles.edit', $article->id) }}"
                                                class="text-blue-600 hover:text-blue-900 font-medium">Edit</a>

                                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this article?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                                            </form>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $article->user ? $article->user->name : 'Unknown' }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($article->status === 'published')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Published</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Draft</span>
                                    @endif
                                </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $articles->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
