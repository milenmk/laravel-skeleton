<div class="w-1/6 border-r border-gray-300 pr-4 dark:border-gray-600">
    <nav class="space-y-2">
        <button
            @click="activeTab = 'profile'"
            :class="activeTab === 'profile' ? 'text-primary-500 font-semibold' : 'hover:font-semibold'"
            class="block"
        >
            {{ __('Profile') }}
        </button>
        @if (auth()->user()->hasVerifiedEmail())
            <button
                @click="activeTab = 'security'"
                :class="activeTab === 'security' ? 'text-primary-500 font-semibold' : 'hover:font-semibold'"
                class="block"
            >
                {{ __('Security') }}
            </button>
        @endif
    </nav>
</div>
