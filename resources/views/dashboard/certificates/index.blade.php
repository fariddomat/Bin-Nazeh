<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Certificate</h1>
        <a href="{{ route('dashboard.certificates.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded shadow" wire:navigate>➕ @lang('site.add') Certificate</a>

        <div class="overflow-x-auto mt-4">
            <x-autocrud::table
                :columns="['id', 'name']"
                :data="$certificates"
                routePrefix="dashboard.certificates"
                :show="true"
                :edit="true"
                :delete="true"
                :restore="true"
            />
        </div>
    </div>
</x-app-layout>
