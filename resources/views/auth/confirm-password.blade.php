@section('Title', __('Confirm Password'))

<x-guest-layout>
    <div class="dark:bg-dark-custom relative flex items-center justify-center px-6 sm:px-16">
        <div
            class="relative mt-10 mb-10 w-full max-w-[750px] rounded-md bg-[linear-gradient(60deg,#f1eeff_0%,rgba(255,255,255,0)_25%,rgba(255,255,255,0)_75%,#e6e1ff_100%)] p-2 dark:bg-[linear-gradient(60deg,#2f227c_0%,rgba(14,23,38,0)_18.66%,rgba(14,23,38,0)_51.04%,rgba(14,23,38,0)_80.07%,#1c1357_100%)]"
        >
            <div
                class="relative flex flex-col justify-center rounded-md bg-white/60 px-6 py-20 backdrop-blur-lg dark:bg-black/50"
            >
                <div class="mx-auto w-full max-w-[440px]">
                    <div class="mb-10 flex items-center">
                        <div
                            class="flex h-16 w-16 items-end justify-center overflow-hidden rounded-full ltr:mr-4 rtl:ml-4"
                        >
                            <img
                                class="h-16 w-16 rounded-full object-cover saturate-50 group-hover:saturate-100"
                                src="{{ auth()->user()->profile_photo_url }}"
                                alt="{{ auth()->user()->full_name }}"
                            />
                        </div>
                        <div class="flex-1">
                            <h4 class="text-2xl dark:text-white">{{ auth()->user()->full_name }}</h4>
                            <p class="text-white-dark">{{ __('Enter your password to continue') }}</p>
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
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
                            type="submit"
                            class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]"
                        >
                            {{ __('Confirm') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
