<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">تسجيل الاهتمامات</h1>
        {{-- <a href="{{ route('dashboard.careers.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded shadow" wire:navigate>➕ @lang('site.add') Career</a> --}}
<a href="{{ route('dashboard.careers.export') }}" class="px-4 py-2 bg-green-500 text-white rounded shadow hover:bg-green-600">
                <i class="fas fa-file-csv mr-2"></i> Export
            </a>
        <div class="overflow-x-auto mt-4">
            <x-autocrud::table
                :columns="['id', 'name', 'email', 'project_id']"
                :data="$careers"
                routePrefix="dashboard.careers"
                :show="true"
                :edit="true"
                :delete="true"
                :restore="true"
            />
        </div>
    </div>
</x-app-layout>
