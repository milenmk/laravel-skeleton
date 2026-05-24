@session ('status')
    <div
        x-data="{ showSuccessAlert: true }"
        x-init="setTimeout(() => (showSuccessAlert = false), 3000)"
        x-show="showSuccessAlert"
        x-transition:enter="transition duration-300 ease-out"
        x-transition:enter-start="scale-90 transform opacity-0"
        x-transition:enter-end="scale-100 transform opacity-100"
        x-transition:leave="transition duration-300 ease-in"
        x-transition:leave-start="scale-100 transform opacity-100"
        x-transition:leave-end="scale-90 transform opacity-0"
        class="bg-success-light border-success dark:bg-success-dark-light relative my-2 flex items-center rounded border p-2 text-white before:absolute before:top-1/2 before:-mt-2 before:border-t-8 before:border-b-8 before:border-l-8 before:border-t-transparent before:border-b-transparent before:border-l-inherit ltr:border-l-[64px] ltr:before:left-0 rtl:border-r-[64px] rtl:before:right-0 rtl:before:rotate-180"
    >
        <span class="absolute inset-y-0 m-auto h-6 w-6 text-white ltr:-left-11 rtl:-right-11">
            @svg ('icon-success-exclamation')
        </span>
        <span class="ltr:pl-3 rtl:pr-3">{{ __($value) }}</span>
        <button type="button" class="hover:opacity-80 ltr:ml-auto rtl:mr-auto" @click="showSuccessAlert = false">
            @svg ('icon-close')
        </button>
    </div>
@endsession
