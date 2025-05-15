<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.show')
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.project_id')</label>
                <p class="text-gray-900">
                    @isset($projectPdf2->project)
                        {{ $projectPdf2->project->name ?? '—' }}
                    @else
                        {{ $projectPdf2->project_id ?? '—' }}
                    @endisset
                </p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.file')</label>
                @isset($projectPdf2->file)
                    <p class="text-gray-900">
                        <a href="{{ Storage::url($projectPdf2->file) }}" target="_blank" class="text-blue-500 hover:underline">@lang('site.view_file')</a>
                    </p>
                @else
                    <p class="text-gray-900">—</p>
                @endisset
            </div>
            <a href="{{ route('dashboard.project_pdf2s.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded shadow hover:bg-gray-700">
                @lang('site.back')
            </a>
        </div>
    </div>
</x-app-layout>
