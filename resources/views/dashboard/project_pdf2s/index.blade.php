<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Project 3D for {{ $project->name }}</h1>
        <a href="{{ route('dashboard.projects.project_pdf2s.create', $project) }}"
           class="px-4 py-2 bg-blue-500 text-white rounded shadow" wire:navigate>
            ➕ @lang('site.add') Project 3D
        </a>

        <div class="overflow-x-auto mt-4">
            <x-autocrud::table
                :columns="['id', 'file']"
                :data="$projectPdf2s"
                routePrefix="dashboard.projects.project_pdfs"
                :parentId="$project->id"
                :show="true"
                :edit="true"
                :delete="true"
                :restore="true"
            />
        </div>
    </div>
</x-app-layout>
