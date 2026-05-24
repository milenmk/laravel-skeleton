@section ('Title', __('Sign In'))

<x-guest-layout>
    <div class="dark:bg-dark-custom relative flex items-center justify-center px-6 sm:px-16">
        <div
            class="relative mt-10 mb-10 w-full max-w-[750px] rounded-md bg-[linear-gradient(60deg,#f1eeff_0%,rgba(255,255,255,0)_25%,rgba(255,255,255,0)_75%,#e6e1ff_100%)] p-2 dark:bg-[linear-gradient(60deg,#2f227c_0%,rgba(14,23,38,0)_18.66%,rgba(14,23,38,0)_51.04%,rgba(14,23,38,0)_80.07%,#1c1357_100%)]"
        >
            <div
                class="relative flex flex-col justify-center rounded-md bg-white/60 px-6 py-20 backdrop-blur-lg dark:bg-black/50"
            >
                <div class="mx-auto w-full max-w-[440px]">
                    <div class="p-4">
                        <h1 class="text-primary text-3xl !leading-snug font-extrabold uppercase md:text-4xl">
                            {{ __('Sign In') }}
                        </h1>
                        <p class="text-white-dark text-base leading-normal font-bold">
                            {{ __('Enter your email and password to login') }}
                        </p>
                    </div>

                    <form class="space-y-5 dark:text-white" method="POST" action="{{ route('login.store') }}">
                        @csrf

                        <x-form.form-field
                            class="w-full"
                            fieldName="email"
                            :fieldLabel="__('Email')"
                            fieldType="email"
                            :placeholder="__('Enter Email')"
                            svgIcon="letter"
                            :required="true"
                            :value="old('email')"
                            :autofocus="true"
                        />

                        <x-form.form-field
                            class="w-full"
                            fieldName="password"
                            :fieldLabel="__('Password')"
                            fieldType="password"
                            :placeholder="__('Enter Password')"
                            svgIcon="lock"
                            :required="true"
                        />

                        <button
                            class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]"
                        >
                            {{ __('Sign In') }}
                        </button>
                    </form>

                    <div class="mt-7 text-center text-sm dark:text-white">
                        {{ __('Don\'t have an account?') }}
                        <a
                            wire:navigate
                            href="{{ route('register') }}"
                            class="text-primary uppercase underline transition hover:text-black dark:hover:text-white"
                        >
                            {{ __('SIGN UP') }}
                        </a>
                    </div>
                    <div class="mt-2 text-center text-sm dark:text-white">
                        {{ __('Forgot your password?') }}
                        <a
                            wire:navigate
                            href="{{ route('password.request') }}"
                            class="text-primary uppercase underline transition hover:text-black dark:hover:text-white"
                        >
                            {{ __('RESET PASSWORD') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
