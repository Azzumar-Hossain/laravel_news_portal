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
                                    <th scope="col" class="px-6 py-4">Author</th>
                                    <th scope="col" class="px-6 py-4">Status</th>
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

                                        <td class="px-6 py-4">
                                            <div class="flex gap-3 items-center mb-3">
                                                <a href="{{ route('articles.edit', $article->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 font-medium">Edit</a>

                                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this article?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                                                </form>
                                            </div>
                                            
                                            <div class="mt-4 flex items-center space-x-3 border-t border-gray-100 pt-3">
                                                @php
                                                    $shareUrl = urlencode(route('article.show', $article->id));
                                                    $shareTitle = urlencode($article->title);
                                                @endphp
                                                
                                                <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Quick Share:</span>
                                                
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="p-2 rounded-full text-white shadow-sm hover:opacity-80 transition duration-150" style="background-color: #1877F2;" title="Share on Facebook">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                                </a>
                                                
                                                <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" class="p-2 rounded-full text-white shadow-sm hover:opacity-80 transition duration-150" style="background-color: #25D366;" title="Share on WhatsApp">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                                </a>
                                                
                                                <button onclick="navigator.clipboard.writeText('{{ route('article.show', $article->id) }}'); alert('Link Copied to clipboard!');" class="p-2 rounded-full text-gray-600 bg-gray-200 hover:bg-gray-300 shadow-sm transition duration-150" title="Copy Link to Clipboard">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                                </button>
                                            </div>
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