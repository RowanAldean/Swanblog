<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white navbar-light pb-0">
    <!-- Container wrapper -->
    <div class="container-fluid">

        <!-- Navbar brand -->
        <a class="navbar-brand" href="{{ route('feed') }}">
            <x-application-logo class="block fill-current text-gray-600" style="height: 4rem" />
        </a>

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex nav-item">
                    <x-nav-link class="nav-link" :href="route('feed')" :active="request()->routeIs('feed')">
                        <i class="fa-solid fa-house active:text-indigo-700"></i>
                    </x-nav-link>
                    <!-- :href="route('posts.explore')" :active="request()->routeIs('posts.explore')" -->
                    <x-nav-link class="nav-link">
                        <i class="fa-solid fa-compass"></i>
                    </x-nav-link>
                    <x-nav-link class="nav-link">
                        <i class="fa-solid fa-heart"></i>
                    </x-nav-link>
                </div>
            </ul>

            <!-- Settings -->
            <ul class="navbar-nav d-flex flex-row me-1">
                <li
                    class="flex align-items-center pr-4 nav-item text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <a className="pr-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                        href="{{ route('post.create') }}"
                        active="{{ strpos(Route::currentRouteName(), 'post.create') == 0 ? true : false }}">
                        {{ __('Create Post') }}
                    </a>
                </li>
                <li class="nav-item me-3 me-lg-0 flex items-center">

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div class="container">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="flex align-items-center">
                                            <img src="{{ asset(auth()->user()->profile->getProfileImage()) }}"
                                                class="img-fluid rounded-circle w-8 mr-2">
                                            {{ Auth::user()->name }}
                                            <svg class="ml-1 fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                            <x-dropdown-link :href="route('profile.index', auth()->user()->username)">
                                {{ __('View Profile') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </li>
            </ul>

        </div>
    </div>
    <!-- Container wrapper -->
</nav>
