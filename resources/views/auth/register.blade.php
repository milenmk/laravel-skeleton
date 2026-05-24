@section ('Title', __('Sign Up'))

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
                            {{ __('Sign Up') }}
                        </h1>
                        <p class="text-white-dark text-base leading-normal font-bold">
                            {{ __('Enter your name, email and password to register') }}
                        </p>
                    </div>

                    <form class="space-y-5" method="POST" action="{{ route('register.store') }}">
                        @csrf

                        <x-form.form-field
                            class="w-full"
                            fieldName="name"
                            :fieldLabel="__('First Name')"
                            fieldType="text"
                            :placeholder="__('Enter Your First Name')"
                            svgIcon="user"
                            :required="true"
                            :value="old('name')"
                            :autofocus="true"
                        />

                        <x-form.form-field
                            class="w-full"
                            fieldName="last_name"
                            :fieldLabel="__('Last Name')"
                            fieldType="text"
                            :placeholder="__('Enter Your Last Name')"
                            svgIcon="user"
                            :required="true"
                            :value="old('last_name')"
                        />

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

                        <x-form.form-field
                            class="w-full"
                            fieldName="password"
                            :fieldLabel="__('Password')"
                            fieldType="password"
                            :placeholder="__('Enter Password')"
                            svgIcon="lock"
                            :required="true"
                        />

                        <x-form.form-field
                            class="w-full"
                            fieldName="password_confirmation"
                            :fieldLabel="__('Confirm Password')"
                            fieldType="password"
                            :placeholder="__('Confirm Password')"
                            svgIcon="lock"
                            :required="true"
                        />

                        <label class="flex cursor-pointer items-center">
                            <input type="checkbox" name="terms" required class="form-checkbox" />
                            <div class="text-white-dark ms-2">
                                {!!
                                    __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' =>
                                            '<a target="_blank" href="' .
                                            route('terms.show') .
                                            '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                            __('Terms of Service') .
                                            '</a>',
                                        'privacy_policy' =>
                                            '<a target="_blank" href="' .
                                            route('policy.show') .
                                            '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                            __('Privacy Policy') .
                                            '</a>',
                                    ])
                                !!}
                            </div>
                        </label>

                        <button
                            class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]"
                        >
                            {{ __('Sign Up') }}
                        </button>
                    </form>

                    <div class="mt-7 text-center text-sm dark:text-white">
                        {{ __('Already have an account?') }}
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
