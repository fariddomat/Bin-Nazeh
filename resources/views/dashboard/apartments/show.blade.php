<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.show') @lang('site.dashboard.apartments')
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.project_id')</label>
                <p class="text-gray-900">
                    @isset($apartment->project)
                        {{ $apartment->project->name ?? '—' }}
                    @else
                        {{ $apartment->project_id ?? '—' }}
                    @endisset
                </p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.type')</label>
                <p class="text-gray-900">{{ $apartment->type ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.appendix')</label>
                <p class="text-gray-900">{{ $apartment->appendix ? 'Yes' : 'No' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.code')</label>
                <p class="text-gray-900">{{ $apartment->code ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.room_count')</label>
                <p class="text-gray-900">{{ $apartment->room_count ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.area')</label>
                <p class="text-gray-900">{{ $apartment->area ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.about')</label>
                <p class="text-gray-900">{{ $apartment->about ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.price')</label>
                <p class="text-gray-900">{{ $apartment->price ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.price_bank')</label>
                <p class="text-gray-900">{{ $apartment->price_bank ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.details')</label>
                <p class="text-gray-900">{!! $apartment->details ?? '—' !!}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.img')</label>
                @isset($apartment->img)
                    <img src="{{ Storage::url($apartment->img) }}" alt="img" class="mt-2 w-48 h-48 rounded">
                @else
                    <p class="text-gray-900">—</p>
                @endisset
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.virtual_location')</label>
                <p class="text-gray-900">{{ $apartment->virtual_location ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.youtube')</label>
                <p class="text-gray-900">{{ $apartment->youtube ?? '—' }}</p>
            </div>

        </div>
    </div>
</x-app-layout>
