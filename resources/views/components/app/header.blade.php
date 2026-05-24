<header
    {{
        $attributes->merge([
            'class' =>
                'lg:before:bg-sand-light-2/90 sticky top-0 z-30 before:absolute before:inset-0 before:-z-10 before:backdrop-blur-md max-lg:shadow-xs max-lg:before:bg-white/90 dark:max-lg:before:bg-gray-800/90 dark:lg:before:bg-gray-900/90',
        ])
    }}
>
    @php
        $menuItems = [
            ['href' => '#', 'text' => 'Documentation'],
            ['href' => '#', 'text' => 'About'],
            ['href' => '#', 'text' => 'Contact'],
        ];
    @endphp

    <div class="px-4 sm:px-2 lg:px-8">
        <!-- Desktop Header -->
        <div
            class="flex h-12 items-center justify-between border-b border-gray-200 md:relative md:h-16 dark:border-gray-700/60"
        >
            <div class="flex items-center md:space-x-3" x-data="{ open: false }">
                <!-- Main menu links -->
                <nav
                    id="main-links"
                    class="absolute top-12 right-0 left-0 z-10 flex flex-col space-y-2 rounded-b-lg bg-white px-4 pt-2 pb-3 shadow-lg md:static md:flex-row md:space-y-0 md:space-x-3 md:rounded-none md:bg-transparent md:p-0 md:shadow-none dark:bg-gray-800 md:dark:bg-transparent"
                    x-show="open || window.innerWidth >= 768"
                    @click.away="open = false"
                    @click.prevent="open = false"
                    x-cloak
                    x-transition:enter="transition duration-200 ease-out"
                    x-transition:enter-start="scale-95 transform opacity-0"
                    x-transition:enter-end="scale-100 transform opacity-100"
                    style="display: none"
                >
                    @routeLink ('home', ['class' => 'hover:text-primary-500 block md:inline', 'wire:navigate' => true])

                    @foreach ($menuItems as $index => $item)
                        <a href="{{ $item['href'] }}" wire:navigate class="block md:inline">{{ $item['text'] }}</a>
                    @endforeach

                    @if (auth()->check())
                        @routeLink ('dashboard',
                            [
                                'class' => 'hover:text-primary-500 block md:inline',
                                'wire:navigate' => true,
                                'wire:current' => 'text-primary-500 font-semibold'
                            ])
                    @endif
                </nav>

                <!-- Mobile menu button -->
                <button
                    type="button"
                    class="focus-visible:ring-primary/60 rounded-md p-2 text-gray-700 hover:text-gray-900 focus:outline-none focus-visible:ring-2 md:hidden dark:text-gray-200"
                    @click="open = !open"
                    :aria-expanded="open.toString()"
                    aria-controls="main-links"
                    aria-label="Toggle main menu"
                >
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed -->
                    <svg
                        x-show="!open"
                        class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                    <!-- Icon when menu is open -->
                    <svg
                        x-show="open"
                        class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            <!-- Header: Center -->
            @routeLinkStart (auth()->user() ? 'dashboard' : 'home',
                [
                    'class' => 'absolute top-1/2 left-1/2 flex -translate-x-1/2 -translate-y-1/2 transform items-center',
                    'wire:navigate' => true
                ])
            <img class="-ml-1 inline w-8" src="{{ asset('assets/images/logo.png') }}" alt="LaraGDPR" />
            <span class="ml-1.5 align-middle text-2xl font-semibold transition-all duration-300">
                {{ config('app.name') }}
            </span>
            @routeLinkEnd

            <div class="flex items-center md:space-x-3" x-data="{ open: false }">
                <!-- Dark mode toggle -->
                <x-theme-toggle />
                @if (auth()->user())
                    <!-- Divider -->
                    <hr class="hidden !h-6 w-px border-none bg-gray-200 md:block dark:bg-gray-700/60" />
                    <x-dropdown-profile align="right" />
                @else
                    <!-- Navigation container for sign in/up -->
                    <nav
                        id="auth-links"
                        class="absolute top-12 right-0 z-10 ml-auto flex w-1/2 flex-col space-y-2 rounded-b-lg bg-white px-4 pt-2 pb-3 shadow-lg md:static md:ml-0 md:flex md:w-full md:flex-row md:space-y-0 md:space-x-3 md:rounded-none md:bg-transparent md:p-0 md:shadow-none dark:bg-gray-800 md:dark:bg-transparent"
                        x-show="open || window.innerWidth >= 768"
                        @click.away="open = false"
                        @click.prevent="open = false"
                        x-cloak
                        x-transition:enter="transition duration-200 ease-out"
                        x-transition:enter-start="scale-95 transform opacity-0"
                        x-transition:enter-end="scale-100 transform opacity-100"
                        style="display: none"
                    >
                        <a
                            wire:navigate
                            href="{{ route('login') }}"
                            class="btn-outline-gradient hidden text-xs md:block md:text-sm"
                        >
                            <div>
                                <span>{{ __('Sign In') }}</span>
                            </div>
                        </a>
                        <a
                            wire:navigate
                            href="{{ route('login') }}"
                            class="btn-sm btn-gradient flex text-xs md:hidden md:text-sm"
                        >
                            {{ __('Sign In') }}
                        </a>
                        <a wire:navigate href="{{ route('register') }}" class="btn-sm btn-gradient text-xs md:text-sm">
                            {{ __('Sign Up') }}
                        </a>
                    </nav>
                    <!-- Mobile menu button -->
                    <button
                        type="button"
                        class="focus-visible:ring-primary/60 rounded-md p-2 text-gray-700 hover:text-gray-900 focus:outline-none focus-visible:ring-2 md:hidden dark:text-gray-200"
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                        aria-controls="auth-links"
                        aria-label="Toggle authentication menu"
                    >
                        <span class="sr-only">Open authentication menu</span>
                        <i class="far fa-user"></i>
                    </button>
                @endif
            </div>
        </div>
    </div>
</header>
