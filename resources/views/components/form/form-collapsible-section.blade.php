@props ([
    'title' => '',
    'data' => ''
])

<div class="flex cursor-pointer items-center justify-between" @click="isOpen = !isOpen">
    <h6 class="text-lg font-bold">{{ $title }}</h6>
    <div
        x-show="!isOpen"
        x-transition:enter="transition duration-300 ease-out"
        x-transition:enter-start="-rotate-90 transform opacity-0"
        x-transition:enter-end="rotate-0 transform opacity-100"
    >
        @svg ('icon-chevron-left')
    </div>
    <div
        x-show="isOpen"
        x-transition:enter="transition duration-300 ease-out"
        x-transition:enter-start="rotate-90 transform opacity-0"
        x-transition:enter-end="rotate-0 transform opacity-100"
    >
        @svg ('icon-chevron-down')
    </div>
</div>
<div
    class="mt-4 space-y-4"
    x-show="isOpen"
    x-transition:enter="transition duration-300 ease-out"
    x-transition:enter-start="-translate-y-4 transform opacity-0"
    x-transition:enter-end="translate-y-0 transform opacity-100"
    x-transition:leave="transition duration-300 ease-in"
    x-transition:leave-start="translate-y-0 transform opacity-100"
    x-transition:leave-end="-translate-y-4 transform opacity-0"
>
    {{ $data }}
</div>
