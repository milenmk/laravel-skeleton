@section('Title', __('Two-Factor Authentication'))

<x-guest-layout>
    <div class="dark:bg-dark-custom relative flex items-center justify-center px-6 sm:px-16">
        <div
            class="relative mt-10 mb-10 w-full max-w-[750px] rounded-md bg-[linear-gradient(60deg,#f1eeff_0%,rgba(255,255,255,0)_25%,rgba(255,255,255,0)_75%,#e6e1ff_100%)] p-2 dark:bg-[linear-gradient(60deg,#2f227c_0%,rgba(14,23,38,0)_18.66%,rgba(14,23,38,0)_51.04%,rgba(14,23,38,0)_80.07%,#1c1357_100%)]"
        >
            <div
                class="relative flex flex-col justify-center rounded-md bg-white/60 px-6 py-20 backdrop-blur-lg dark:bg-black/50"
            >
                <div class="mx-auto w-full max-w-[440px]">
                    <h1 class="text-primary text-3xl !leading-snug font-extrabold uppercase md:text-4xl">
                        {{ __('Two-Factor Authentication') }}
                    </h1>
                    @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('two-factor.login') }}" x-data="{ recovery: false }">
                        @csrf

                        <div class="mt-4" x-show="! recovery">
                            <x-form.form-field
                                fieldName="code"
                                :fieldLabel="__('Code')"
                                fieldType="numeric"
                                autocomplete="one-time-code"
                                svgIcon="lock"
                                x-ref="code"
                                autofocus
                            />
                        </div>

                        <div class="mt-4" x-cloak x-show="recovery">
                            <x-form.form-field
                                fieldName="recovery_code"
                                :fieldLabel="__('Recovery Code')"
                                fieldType="numeric"
                                autocomplete="one-time-code"
                                svgIcon="lock"
                                x-ref="recovery_code"
                                autofocus
                            />
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <button
                                type="button"
                                class="btn btn-gradient border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]"
                                x-show="!recovery"
                                x-on:click="
                                    recovery = true
                                    $nextTick(() => {
                                        $refs.recovery_code.focus()
                                    })
                                "
                            >
                                {{ __('Use a recovery code') }}
                            </button>

                            <button
                                type="button"
                                class="btn btn-gradient border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]"
                                x-cloak
                                x-show="recovery"
                                x-on:click="
                                    recovery = false
                                    $nextTick(() => {
                                        $refs.code.focus()
                                    })
                                "
                            >
                                {{ __('Use an authentication code') }}
                            </button>

                            <button class="btn btn-primary uppercase">{{ __('Sign In') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
