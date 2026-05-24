@section ('Title', __('Email Verification'))

<x-guest-layout>
    <div class="dark:bg-dark-custom relative flex items-center justify-center px-6 sm:px-16">
        <div
            class="relative mt-10 mb-10 w-full max-w-[750px] rounded-md bg-[linear-gradient(60deg,#f1eeff_0%,rgba(255,255,255,0)_25%,rgba(255,255,255,0)_75%,#e6e1ff_100%)] p-2 dark:bg-[linear-gradient(60deg,#2f227c_0%,rgba(14,23,38,0)_18.66%,rgba(14,23,38,0)_51.04%,rgba(14,23,38,0)_80.07%,#1c1357_100%)]"
        >
            <div
                class="relative flex flex-col justify-center rounded-md bg-white/60 px-6 py-20 backdrop-blur-lg dark:bg-black/50"
            >
                <div class="mx-auto w-full max-w-[440px]">
                    <div>
                        <h1 class="text-primary text-3xl !leading-snug font-extrabold uppercase md:text-4xl">
                            {{ __('Email Verification') }}
                        </h1>
                        <p class="text-white-dark text-sm leading-normal font-bold">
                            {{
                                __(
                                    'Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.',
                                )
                            }}
                        </p>

                        @if (session('status') == 'verification-link-sent')
                            <div
                                x-data="{ showAlert: true }"
                                x-init="setTimeout(() => (showAlert = false), 3000)"
                                x-show="showAlert"
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
                                <span class="ltr:pl-3 rtl:pr-3">
                                    {{
                                        __(
                                            'A new verification link has been sent to the email address you provided in your profile settings.',
                                        )
                                    }}
                                </span>
                                <button type="button" @click="showAlert = false">
                                    @svg ('icon-close')
                                </button>
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button
                            type="submit"
                            class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]"
                        >
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    <div class="col-md-12 flex items-center justify-between p-4">
                        <div class="p-4">
                            <a href="{{ route('profile.show') }}" class="btn btn-primary"> {{ __('Edit Profile') }} </a>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">{{ __('Log Out') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
