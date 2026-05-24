@section('Title', __('Forgot Password'))

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
                            {{ __('Password Reset') }}
                        </h1>
                        <p class="text-white-dark text-base leading-normal font-bold">
                            {{ __('Enter your email to reset your password.') }}
                        </p>
                    </div>

                    <x-session-success-message />

                    <form method="POST" action="{{ route('password.email') }}">
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
                        />

                        <button
                            type="submit"
                            class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]"
                        >
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </form>

                    <div class="mt-7 text-center text-sm dark:text-white">
                        {{ __('Remember your password?') }}
                        <a
                            wire:navigate
                            href="{{ route('login') }}"
                            class="text-primary uppercase underline transition hover:text-black dark:hover:text-white"
                        >
                            {{ __('SIGN IN') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
