@props(['field' => ''])

@if (isset($errors))
    @error($field)
        <div
            class="bg-danger-light border-danger dark:bg-danger-dark-light relative my-2 flex items-center rounded border p-2 text-sm text-white before:absolute before:top-1/2 before:-mt-2 before:border-t-8 before:border-b-8 before:border-l-8 before:border-t-transparent before:border-b-transparent before:border-l-inherit ltr:border-l-[64px] ltr:before:left-0 rtl:border-r-[64px] rtl:before:right-0 rtl:before:rotate-180"
        >
            <span class="absolute inset-y-0 m-auto h-6 w-6 text-white ltr:-left-11 rtl:-right-11">
                @svg('icon-danger')
            </span>
            <span class="ltr:pl-3 rtl:pr-3">{{ $message }}</span>
        </div>
    @enderror
@endif
