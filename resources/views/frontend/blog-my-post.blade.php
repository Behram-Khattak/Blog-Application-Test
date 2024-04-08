<x-guest-layout>
    <div class="content max-w-screen-xl mx-auto px-4">

        <div class="author-title">
            <h2 class="text-center text-4xl font-extrabold capitalize">{{ auth()->user()->name }}</h2>
        </div>
        {{-- blog my posts cards --}}
        {{-- <div class="posts my-6 sm:grid md:grid-cols-2 lg:grid-cols-3 gap-6 space-y-6 sm:space-y-0">
            @forelse ($posts as $post)
                <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('frontend.blog-post', [$post->id, $post->slug]) }}">
                        <img class="rounded-t-lg"
                            src="{{ asset('storage/thumbnails/'.$post->thumbnail) }}"
                            alt="thumbnail" />
                    </a>
                    <div class="p-5">
                        <a href="{{ route('frontend.blog-category-post', $post->category_id) }}">
                            <span class="category font-bold capitalize bg-gray-200 p-2 rounded-full hover:underline">
                                {{ $post->category->name }}
                            </span>
                        </a>

                        <a href="{{ route('frontend.blog-post', [$post->id, $post->slug]) }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight pt-2 text-gray-900 dark:text-white">
                                {{ $post->title }}
                            </h5>
                        </a>
                        <div class="mb-3 font-normal text-gray-700 dark:text-gray-400 line-clamp-2">
                            {!! $post->description !!}
                        </div>
                        <a href="{{ route('frontend.blog-post', [$post->id, $post->slug]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Read more
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    <h1 class=" text-4xl text-gray-400 mt-20 pb-12 font-extrabold">No Posts Yet !</h1>
                    <caption>wanna write something...</caption>
                    <a href="{{ route('frontend.blog-post-write') }}"
                        class="text-md font-bold uppercase mx-4 border-blue-500 border-2 py-4 px-8 hover:bg-blue-500 hover:text-white">write</a>
                </div>
            @endforelse
        </div> --}}
        <livewire:load-more-my-posts />

        {{-- load more blog posts --}}

    </div>

    <x-slot:scripts>
        <script type="text/javascript">
            //
        </script>
    </x-slot:scripts>
</x-guest-layout>
