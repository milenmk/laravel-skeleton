@section('Title', __('Terms Of Service'))

<x-guest-layout>
    <div class="bg-gray-100 pt-4 dark:bg-gray-900">
        <div class="flex min-h-screen flex-col items-center pt-6 sm:pt-0">
            <div
                class="prose dark:prose-invert bg-gray-white mt-6 w-full overflow-hidden p-6 shadow-md sm:max-w-2xl sm:rounded-lg dark:bg-gray-800"
            >
                {!! $terms !!}
            </div>
        </div>
    </div>
</x-guest-layout>
