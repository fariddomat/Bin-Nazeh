<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.show') @lang('site.dashboard.project_pdfs')
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.project_id')</label>
                <p class="text-gray-900">
                    @isset($projectPdf->project)
                        {{ $projectPdf->project->name ?? '—' }}
                    @else
                        {{ $projectPdf->project_id ?? '—' }}
                    @endisset
                </p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.file')</label>
                @isset($projectPdf->file)
                    <p class="text-gray-900">
                        <a href="{{ Storage::url($projectPdf->file) }}" target="_blank" class="text-blue-500 hover:underline">@lang('site.view_file')</a>
                    </p>
                @else
                    <p class="text-gray-900">—</p>
                @endisset
            </div>
           
        </div>
    </div>
</x-app-layout>
