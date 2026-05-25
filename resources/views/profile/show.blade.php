@php
    use Laravel\Fortify\Features;
@endphp

@section ('Title', __('Profile'))

<x-app-layout>
    <div class="dark:bg-dark-custom relative flex items-center justify-center px-6 sm:px-16">
        <div
            class="mt-10 mb-10 w-full max-w-6xl rounded-md bg-[linear-gradient(60deg,#f1eeff_0%,rgba(255,255,255,0)_25%,rgba(255,255,255,0)_75%,#e6e1ff_100%)] p-2 dark:bg-[linear-gradient(60deg,#2f227c_0%,rgba(14,23,38,0)_18.66%,rgba(14,23,38,0)_51.04%,rgba(14,23,38,0)_80.07%,#1c1357_100%)]"
        >
            <div class="flex" x-data="{ activeTab: 'profile' }">
                <x-profile-sidebar />
                <div class="flex-1 pl-4">
                    <div x-show="activeTab === 'profile'">
                        <livewire:user:update-profile-information />
                    </div>
                    @if (auth()->user()->hasVerifiedEmail())
                        <div x-show="activeTab === 'security'">
                            @if (Features::enabled(Features::updatePasswords()))
                                <livewire:user:update-profile-password />
                            @endif

                            @if (Features::enabled(Features::twoFactorAuthentication()))
                                <livewire:user:two-factor-authentication-form />
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
