<div
    {{
        $attributes->merge([
            'class' =>
                'dark:text-white-dark flex flex-col items-center space-y-2 md:space-y-0 p-4 text-xs sm:flex-row sm:justify-between sm:items-center',
        ])
    }}
>
    <div class="dark:text-white-dark flex gap-4">
        <a href="#">{{ __('Terms of Service') }}</a>
        <a href="#">{{ __('Privacy Policy') }}</a>
        <a href="#">{{ __('Cookie Policy') }}</a>
    </div>

    <p class="md:absolute md:left-1/2 md:-translate-x-1/2">
        <a href="https://minkov.dev" target="_blank">Delivered by &lt;/&gt;MINKOV DEV&gt;</a>
    </p>

    <p class="flex items-center justify-center gap-1">
        &copy; {{ config('app.name') }}
        <span>2025</span>
        -
        <span id="footer-year"></span>
        {{ __('All rights reserved.') }}
    </p>
</div>
