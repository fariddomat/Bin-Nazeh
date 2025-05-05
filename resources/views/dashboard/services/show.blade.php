<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.show') @lang('site.dashboard.services')
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.name')</label>
                <p class="text-gray-900">{{ $service->name ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.slug')</label>
                <p class="text-gray-900">{{ $service->slug ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.description')</label>
                <p class="text-gray-900">{{ $service->description ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.icon')</label>
                <p class="text-gray-900">{{ $service->icon ?? '—' }}</p>

            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.img')</label>
                @isset($service->img)
                    <img src="{{ Storage::url($service->img) }}" alt="img" class="mt-2 w-48 h-48 rounded">
                @else
                    <p class="text-gray-900">—</p>
                @endisset
            </div>
            <a href="{{ route('dashboard.services.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded shadow hover:bg-gray-700">
                @lang('site.back')
            </a>
        </div>
    </div>
</x-app-layout>
