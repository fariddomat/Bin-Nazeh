<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Apartments for {{ $project->name }}</h1>
        <a href="{{ route('dashboard.projects.apartments.create', $project) }}"
           class="px-4 py-2 bg-blue-500 text-white rounded shadow" wire:navigate>
            ➕ @lang('site.add') Apartment
        </a>

        <div class="overflow-x-auto mt-4">
            <x-autocrud::table
                :columns="['id', 'type', 'code', 'area']"
                :data="$apartments"
                routePrefix="dashboard.projects.apartments"
                :parentId="$project->id"
                :show="true"
                :edit="true"
                :delete="true"
                :restore="true"
            />
        </div>
    </div>
</x-app-layout>
