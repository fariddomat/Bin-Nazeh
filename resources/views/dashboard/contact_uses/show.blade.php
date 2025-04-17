<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.show') @lang('site.dashboard.contact_uses')
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.name')</label>
                <p class="text-gray-900">{{ $contactUs->name ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.email')</label>
                <p class="text-gray-900">{{ $contactUs->email ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.phone')</label>
                <p class="text-gray-900">{{ $contactUs->phone ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.project_id')</label>
                <p class="text-gray-900">
                    @isset($contactUs->project)
                        {{ $contactUs->project->name ?? '—' }}
                    @else
                        {{ $contactUs->project_id ?? '—' }}
                    @endisset
                </p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.message')</label>
                <p class="text-gray-900">{{ $contactUs->message ?? '—' }}</p>
            </div>
            <a href="{{ route('dashboard.contact_uses.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded shadow hover:bg-gray-700">
                @lang('site.back')
            </a>
        </div>
    </div>
</x-app-layout>