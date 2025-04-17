<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.show') @lang('site.dashboard.careers')
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.name')</label>
                <p class="text-gray-900">{{ $career->name ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.email')</label>
                <p class="text-gray-900">{{ $career->email ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.phone')</label>
                <p class="text-gray-900">{{ $career->phone ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.block_number')</label>
                <p class="text-gray-900">{{ $career->block_number ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.city')</label>
                <p class="text-gray-900">{{ $career->city ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.project_id')</label>
                <p class="text-gray-900">
                    @isset($career->project)
                        {{ $career->project->name ?? '—' }}
                    @else
                        {{ $career->project_id ?? '—' }}
                    @endisset
                </p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.wish')</label>
                <p class="text-gray-900">{{ $career->wish ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.other_wish')</label>
                <p class="text-gray-900">{{ $career->other_wish ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.notes')</label>
                <p class="text-gray-900">{{ $career->notes ?? '—' }}</p>
            </div>
            <a href="{{ route('dashboard.careers.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded shadow hover:bg-gray-700">
                @lang('site.back')
            </a>
        </div>
    </div>
</x-app-layout>