<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Info</h1>
        @if ($infos->count() == 0)
            <a href="{{ route('dashboard.infos.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded shadow"
                wire:navigate>➕ @lang('site.add') Info</a>
        @endif

        <div class="overflow-x-auto mt-4">
            <x-autocrud::table :columns="['id', 'name']" :data="$infos" routePrefix="dashboard.infos" :show="true"
                :edit="true" />
        </div>
    </div>
</x-app-layout>
