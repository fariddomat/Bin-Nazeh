<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.show') @lang('site.dashboard.counters')
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.name')</label>
                <p class="text-gray-900">{{ $counter->name ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.icon')</label>
                <p class="text-gray-900">{{ $counter->icon ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.value')</label>
                <p class="text-gray-900">{{ $counter->value ?? '—' }}</p>
            </div>
            <a href="{{ route('dashboard.counters.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded shadow hover:bg-gray-700">
                @lang('site.back')
            </a>
        </div>
    </div>
</x-app-layout>