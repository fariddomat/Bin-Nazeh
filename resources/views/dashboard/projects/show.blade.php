<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.show') @lang('site.dashboard.projects')
        </h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Related Resources Links -->
            <div class="mb-4">
                <div class="mt-2 flex flex-wrap gap-4">
                    <a href="{{ route('dashboard.projects.apartments.index', $project) }}"
                        class="inline-block px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                        @lang('site.apartments')
                    </a>
                    <a href="{{ route('dashboard.projects.project_images.index', $project) }}"
                        class="inline-block px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                        @lang('site.images')
                    </a>
                    <a href="{{ route('dashboard.projects.project_pdfs.index', $project) }}"
                        class="inline-block px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                        @lang('site.download_pdf')
                    </a>
                     <a href="{{ route('dashboard.projects.project_pdf2s.index', $project) }}"
                        class="inline-block px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                        التصاميم ثلاثية الابعاد
                    </a>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.name')</label>
                <p class="text-gray-900">{{ $project->name ?? '—' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.slug')</label>
                <p class="text-gray-900">{{ $project->slug ?? '—' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.date_of_build')</label>
                <p class="text-gray-900">{{ $project->date_of_build ? $project->date_of_build : '—' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.address')</label>
                <p class="text-gray-900">{!! $project->address ?? '—' !!}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.address_location')</label>
                <p class="text-gray-900">{{ $project->address_location ?? '—' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.virtual_location')</label>
                <p class="text-gray-900">{{ $project->virtual_location ?? '—' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.scheme_name')</label>
                <p class="text-gray-900">{{ $project->scheme_name ?? '—' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.floors_count')</label>
                <p class="text-gray-900">{{ $project->floors_count ?? '—' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.details')</label>
                <p class="text-gray-900">{!! $project->details ?? '—' !!}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.img')</label>
                @isset($project->img)
                    <img src="{{ Storage::url($project->img) }}" alt="img" class="mt-2 w-48 h-48 rounded">
                @else
                    <p class="text-gray-900">—</p>
                @endisset
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.cover_img')</label>
                @isset($project->cover_img)
                    <img src="{{ Storage::url($project->cover_img) }}" alt="cover_img" class="mt-2 w-48 h-48 rounded">
                @else
                    <p class="text-gray-900">—</p>
                @endisset
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.status')</label>
                <p class="text-gray-900">{{ $project->status ?? '—' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.status_percent')</label>
                <p class="text-gray-900">{{ $project->status_percent ?? '—' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.project_category_id')</label>
                <p class="text-gray-900">
                    @isset($project->projectCategory)
                        {{ $project->projectCategory->name ?? '—' }}
                    @else
                        {{ $project->project_category_id ?? '—' }}
                    @endisset
                </p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.sort_id')</label>
                <p class="text-gray-900">{{ $project->sort_id ?? '—' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.images')</label>
                @if (!empty($project->images))
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach (json_decode($project->images, true) ?? [] as $image)
                            <img src="{{ Storage::url($image) }}" alt="images" class="w-24 h-24 rounded">
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-900">—</p>
                @endif
            </div>



            <a href="{{ route('dashboard.projects.index') }}"
                class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded shadow hover:bg-gray-700">
                @lang('site.back')
            </a>
        </div>
    </div>
</x-app-layout>
