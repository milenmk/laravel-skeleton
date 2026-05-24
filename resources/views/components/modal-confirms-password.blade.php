@props ([
    'title' => __('Confirm Password'),
    'content' => __('For your security, please confirm your password to continue.'),
    'button' => __('Confirm')
])

@php
    $confirmableId = md5($attributes->wire('then'));
@endphp

<span
    {{ $attributes->wire('then') }}
    x-data
    x-ref="span"
    x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')"
    x-on:password-confirmed.window="
        setTimeout(
            () =>
                $event.detail.id === '{{ $confirmableId }}' &&
                $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })),
            250,
        )
    "
>
    {{ $slot }}
</span>

@once
    <div
        x-data="{ open: @entangle('confirmingPassword') }"
        x-on:close.stop="open = false"
        x-on:keydown.escape.window="open = false"
        class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60"
        :class="open && '!block'"
    >
        <div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">
            <div
                x-show="open"
                x-transition
                x-transition.duration.300
                class="panel my-8 w-full max-w-lg overflow-hidden rounded-lg border-0 p-0"
            >
                <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                    <h5 class="text-lg font-bold">{{ $title }}</h5>
                    <button type="button" class="text-white-dark hover:text-dark" @click="open = false">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24px"
                            height="24px"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="h-6 w-6"
                        >
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="p-5">
                    <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                        <p>{{ $content }}</p>
                    </div>

                    <div
                        class="mt-4"
                        x-data="{}"
                        x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)"
                    >
                        <x-form.form-field
                            fieldName="password"
                            :fieldLabel="__('Password')"
                            autocomplete="current-password"
                            fieldType="password"
                            :placeholder="__('Enter Password')"
                            svgIcon="lock"
                            :required="true"
                            x-ref="confirmable_password"
                            wire:model="confirmablePassword"
                            wire:keydown.enter="confirmPassword"
                        />
                    </div>

                    <div class="mt-8 flex items-center justify-end">
                        <button
                            type="button"
                            class="btn btn-outline-danger"
                            wire:click="stopConfirmingPassword"
                            wire:loading.attr="disabled"
                        >
                            {{ __('Cancel') }}
                        </button>

                        <button
                            type="button"
                            dusk="confirm-password-button"
                            wire:click="confirmPassword"
                            wire:loading.attr="disabled"
                            class="btn btn-gradient border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)] ltr:ml-4 rtl:mr-4"
                        >
                            {{ $button }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endonce
