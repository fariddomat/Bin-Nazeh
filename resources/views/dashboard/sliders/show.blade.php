<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.show') @lang('site.dashboard.sliders')
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.title')</label>
                <p class="text-gray-900">{{ $slider->title ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.description')</label>
                <p class="text-gray-900">{{ $slider->description ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.img')</label>
                @isset($slider->img)
                    <img src="{{ Storage::url($slider->img) }}" alt="img" class="mt-2 w-48 h-48 rounded">
                @else
                    <p class="text-gray-900">—</p>
                @endisset
            </div>
            <a href="{{ route('dashboard.sliders.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded shadow hover:bg-gray-700">
                @lang('site.back')
            </a>
        </div>
    </div>
</x-app-layout>