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
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class=" sm:grid sm:grid-cols-3 gap-4 capitalize space-y-6 sm:space-y-0">
                <a href="{{ route('dashboard.users') }}" class="p-6 bg-white rounded-lg shadow-sm hover:border-blue-500 hover:text-blue-500 hover:border transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300">
                    <span class="font-bold">total users</span><br><br>
                    <span class="text-5xl font-extrabold">{{ $users }}</span>
                </a>
                <a href="{{ route('dashboard.posts') }}" class="p-6 bg-white rounded-lg shadow-sm hover:border-red-500 hover:text-red-500 hover:border transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300">
                    <span class="font-bold">total posts</span><br><br>
                    <span class="text-5xl font-extrabold">{{ $posts }}</span>
                </a>
                <a href="{{ route('dashboard.categories') }}" class="p-6 bg-white rounded-lg shadow-sm hover:border-yellow-500 hover:text-yellow-500 hover:border transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300">
                    <span class="font-bold">total categories</span><br><br>
                    <span class="text-5xl font-extrabold">{{ $categories }}</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
