<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', session('applocale') ?? app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="color-scheme" content="light dark" />

    <!-- SEO Meta Tags -->
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Milen Karaganski - MINKOV>DEV" />
    <meta name="robots" content="index, follow" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta
        property="og:title"
        content="{{ $ogTitle ?? (isset($title) ? $title . ' - ' . config('app.name') : config('app.name')) }}"
    />
    <meta property="og:description" content="{{ $ogDescription ?? ($metaDescription ?? '') }}" />
    <meta property="og:image" content="{{ $ogImage ?? asset('assets/images/logo.png') }}" />
    <meta property="og:site_name" content="MINKOV>DEV" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta
        property="twitter:title"
        content="{{ $twitterTitle ?? (isset($title) ? $title . ' - ' . config('app.name') : config('app.name')) }}"
    />
    <meta property="twitter:description" content="{{ $twitterDescription ?? ($metaDescription ?? '') }}" />
    <meta property="twitter:image" content="{{ $twitterImage ?? asset('assets/images/logo.png') }}" />

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $canonicalUrl ?? url()->current() }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}" />

    <title>
        @hasSection ('Title') @yield ('Title')- @endif
        {{ config('app.name', 'Laravel') }}
    </title>

    <script defer src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

    <!-- Styles -->
    @vite ('resources/css/app.css')

    @livewireStyles

    @stack ('style')
</head>

<body
    class="font-geist bg-sand-light-2 relative overflow-x-hidden text-gray-600 antialiased dark:bg-gray-900 dark:text-gray-300"
>
    <!-- scroll to top -->
    <div class="fixed right-6 bottom-6 z-50" x-data="scrollToTop">
        <template x-if="showTopButton">
            <button
                type="button"
                class="btn btn-outline-primary dark:hover:bg-primary animate-pulse rounded-full bg-[#fafafa] p-2 dark:bg-[#060818]"
                @click="goToTop"
            >
                <svg width="24" height="24" class="h-4 w-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        opacity="0.5"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12 20.75C12.4142 20.75 12.75 20.4142 12.75 20L12.75 10.75L11.25 10.75L11.25 20C11.25 20.4142 11.5858 20.75 12 20.75Z"
                        fill="currentColor"
                    />
                    <path
                        d="M6.00002 10.75C5.69667 10.75 5.4232 10.5673 5.30711 10.287C5.19103 10.0068 5.25519 9.68417 5.46969 9.46967L11.4697 3.46967C11.6103 3.32902 11.8011 3.25 12 3.25C12.1989 3.25 12.3897 3.32902 12.5304 3.46967L18.5304 9.46967C18.7449 9.68417 18.809 10.0068 18.6929 10.287C18.5768 10.5673 18.3034 10.75 18 10.75L6.00002 10.75Z"
                        fill="currentColor"
                    />
                </svg>
            </button>
        </template>
    </div>

    <!-- Page wrapper -->
    <div
        class="relative w-full flex-1 bg-white/25 bg-contain bg-position-[center_top_--spacing(16)] bg-no-repeat dark:bg-[#060818]"
    >
        <div class="main-content flex min-h-screen flex-col">
            <x-app.header id="auth-header" />

            <div class="grow">{{ $slot }}</div>

            <x-app.footer id="site-footer" />
        </div>
    </div>

    @stack ('modals')

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('scrollToTop', () => ({
                showTopButton: false,
                init() {
                    window.onscroll = () => {
                        this.scrollFunction()
                    }
                },

                scrollFunction() {
                    this.showTopButton = document.body.scrollTop > 50 || document.documentElement.scrollTop > 50
                },

                goToTop() {
                    document.body.scrollTop = 0
                    document.documentElement.scrollTop = 0
                },
            }))
        })
    </script>

    @vite ('resources/js/app.js')

    @stack ('scripts')

    @livewireScripts
</body>
</html>
