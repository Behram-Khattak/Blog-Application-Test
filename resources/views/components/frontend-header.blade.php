<div class="content">
    <nav class="bg-gray-50 border-gray-200 border-b dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('frontend.home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Blog</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default"
            x-data="{ active: '{{ Route::currentRouteName() }}' }">
            @if (Route::has('login'))
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-200 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <li>
                                <a href="{{ route('dashboard.dashboard') }}"
                                    class="block my-1 py-2 px-3 text-white md:text-black bg-blue-700 rounded md:bg-transparent md:p-0"
                                    aria-current="page"
                                    :class="{ 'text-blue-70': active === 'dashboard' }"
                                    >
                                    Dashboard
                                </a>
                            </li>
                            @elseif (auth()->user()->role === 'user')
                            <li>
                                <a href="{{ route('frontend.home') }}"
                                    class="block my-1 py-2 px-3 text-black md:p-0"
                                    aria-current="page"
                                    :class="{ 'md:text-blue-500 text-white bg-blue-700 rounded md:bg-transparent': active === 'frontend.home' }"
                                    >
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.blog-post-write') }}"
                                    class="block my-1 py-2 px-3 text-black md:p-0"
                                    aria-current="page"
                                    :class="{ 'md:text-blue-500 text-white bg-blue-700 rounded md:bg-transparent': active === 'frontend.blog-post-write' }"
                                    >
                                    Write
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.blog-my-post') }}"
                                    class="block my-1 py-2 px-3 text-black md:p-0"
                                    aria-current="page"
                                    :class="{ 'md:text-blue-500 text-white bg-blue-700 rounded md:bg-transparent': active === 'frontend.blog-my-post' }"
                                    >
                                    My Posts
                                </a>
                            </li>
                            <li>
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <div>{{ Auth::user()->name }}</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </li>
                        @endunless
                    @else
                        <li>
                            <a href="{{ route('frontend.home') }}"
                                class="block my-1 py-2 px-3 text-black md:p-0"
                                aria-current="page"
                                :class="{ 'md:text-blue-500 text-white bg-blue-700 rounded md:bg-transparent': active === 'frontend.home' }"
                                >
                                Home
                            </a>
                        </li>
                        {{--  --}}
                        <li>
                            <a href="{{ route('login') }}"
                                class="block my-1 py-2 px-3 text-black md:p-0"
                                aria-current="page"
                                :class="{ 'md:text-blue-500 text-white bg-blue-700 rounded md:bg-transparent': active === 'login' }"
                                >
                                Login
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}"
                                class="block my-1 py-2 px-3 text-black md:p-0"
                                aria-current="page"
                                :class="{ 'md:text-blue-500 text-white bg-blue-700 rounded md:bg-transparent': active === 'register' }"
                                >
                                Register
                            </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            @endif

        </div>
        </div>
    </nav>
</div>
