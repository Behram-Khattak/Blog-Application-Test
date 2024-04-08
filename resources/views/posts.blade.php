<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between px-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Hi, '. auth()->user()->name }}
            </h2>

            {{-- home page icon --}}
            <div class="home-icon">
                <a href="{{ route('frontend.home') }}" data-tooltip-target="tooltip-default">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 24 24">
                        <path d="M19,11v9h-5v-6h-4v6H5v-9H3.6L12,3.4l8.4,7.6H19z" opacity=".3"></path><path d="M20,21h-7v-6h-2v6H4v-9H1l11-9.9L23,12h-3V21z M15,19h3v-8.8l-6-5.4l-6,5.4V19h3v-6h6V19z"></path>
                    </svg>
                </a>
                <div id="tooltip-default" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Go to Home
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('deleted'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                    {{ session('deleted') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Posts !") }}
                </div>

                <div class="posts">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        tags
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        thumbnail
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $post->title }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $post->category->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $post->tags }}
                                        </td>
                                        <td class="px-6 py-4 line-clamp-3">
                                            {!! $post->description !!}
                                        </td>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('frontend/images/Error-Establishing-a-Database-Connection-Message.png') }}"
                                                width="200"
                                                alt="thumbnail">
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('dashboard.posts.delete', $post->id) }}"
                                                    class="p-2 border-red-500 border-2 rounded hover:bg-red-500 hover:text-white">
                                                    Delete
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-xl font-bold text-center text-gray-400 pt-12">No Posts yet...</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pagination p-6">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
