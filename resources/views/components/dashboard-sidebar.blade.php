<div class="w-1/6 border-r border-gray-300 pr-4 dark:border-gray-600">
    <nav class="space-y-2">
        <button
            @click="activeTab = 'api-keys'"
            :class="activeTab === 'api-keys' ? 'text-primary-500 font-semibold' : 'hover:font-semibold'"
            class="block"
        >
            {{ __('API Keys') }}
        </button>
        <button
            @click="activeTab = 'license-keys'"
            :class="activeTab === 'license-keys' ? 'text-primary-500 font-semibold' : 'hover:font-semibold'"
            class="block"
        >
            {{ __('License Keys') }}
        </button>
    </nav>
</div>
