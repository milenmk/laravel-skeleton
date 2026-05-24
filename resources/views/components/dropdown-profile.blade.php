@props ([
    'align' => 'right'
])

<div class="relative inline-flex" x-data="{ open: false }">
    <button
        class="group inline-flex items-center justify-center"
        aria-haspopup="true"
        @click.prevent="open = !open"
        :aria-expanded="open"
    >
        <img
            class="rounded-full"
            src="{{ Auth::user()->profile_photo_url }}"
            width="32"
            height="32"
            alt="{{ Auth::user()->full_name }}"
        />
        <div class="hidden items-center truncate md:flex">
            <span
                class="dark:text-sand-light-2 ml-2 truncate text-sm font-medium text-gray-600 group-hover:text-gray-800 dark:group-hover:text-white"
            >
                {{ Auth::user()->full_name }}
            </span>
            <svg class="ml-1 h-3 w-3 shrink-0 fill-current text-gray-400 dark:text-gray-500" viewBox="0 0 12 12">
                <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
            </svg>
        </div>
    </button>
    <div
        class="{{ $align === 'right' ? 'right-0' : 'left-0' }} absolute top-full z-10 mt-1 min-w-44 origin-top-right overflow-hidden rounded-lg border border-gray-200 bg-white py-1.5 shadow-lg dark:border-gray-700/60 dark:bg-gray-800"
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        x-show="open"
        x-transition:enter="transform transition duration-200 ease-out"
        x-transition:enter-start="-translate-y-2 opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition duration-200 ease-out"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-cloak
    >
        <div class="mb-1 border-b border-gray-200 px-3 pt-0.5 pb-2 dark:border-gray-700/60">
            <div class="dark:text-sand-light-2 font-medium text-gray-800">{{ Auth::user()->full_name }}</div>
            <div class="text-xs text-gray-500 italic dark:text-gray-400">
                {{ auth()->user()->license->name->label() }}
            </div>
        </div>

        <ul>
            <li>
                @routeLink ('dashboard',
                    [
                        'class' => 'px-3 py-1 text-sm font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400',
                        'wire:navigate' => true,
                        'x-active' => true
                    ])
            </li>
            <li>
                @routeLink ('profile.show',
                    [
                        'class' => 'px-3 py-1 text-sm font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400',
                        'wire:navigate' => true,
                        'x-active' => true
                    ])
            </li>
            <li class="mt-2 border-t border-gray-200 dark:border-gray-700/60">
                <form class="p-0" method="post" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="text-danger flex cursor-pointer items-center px-3 py-1 text-sm font-medium"
                        type="submit"
                    >
                        <i class="fa fa-right-from-bracket mr-2"></i>
                        {{ __('Sign Out') }}
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
