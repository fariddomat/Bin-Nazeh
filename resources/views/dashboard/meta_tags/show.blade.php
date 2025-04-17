<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.show') @lang('site.dashboard.meta_tags')
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.page_route')</label>
                <p class="text-gray-900">{{ $metaTag->page_route ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.meta_title')</label>
                <p class="text-gray-900">{{ $metaTag->meta_title ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.meta_description')</label>
                <p class="text-gray-900">{{ $metaTag->meta_description ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.canonical_link')</label>
                <p class="text-gray-900">{{ $metaTag->canonical_link ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.schema_markup')</label>
                <p class="text-gray-900">{{ $metaTag->schema_markup ?? '—' }}</p>
            </div>
            <a href="{{ route('dashboard.meta_tags.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded shadow hover:bg-gray-700">
                @lang('site.back')
            </a>
        </div>
    </div>
</x-app-layout>