<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Apartment</h1>
        <a href="{{ route('dashboard.apartments.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded shadow" wire:navigate>➕ @lang('site.add') Apartment</a>

        <div class="overflow-x-auto mt-4">
            <x-autocrud::table
                :columns="['id', 'project_id', 'type', 'appendix', 'code', 'room_count', 'area', 'about', 'price', 'price_bank', 'details', 'img', 'virtual_location', 'youtube']"
                :data="$apartments"
                routePrefix="dashboard.apartments"
                :show="true"
                :edit="true"
                :delete="true"
                :restore="true"
            />
        </div>
    </div>
</x-app-layout>