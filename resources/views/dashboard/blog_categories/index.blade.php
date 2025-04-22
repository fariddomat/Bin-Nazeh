<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">BlogCategory</h1>
        <a href="{{ route('dashboard.blog_categories.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded shadow" wire:navigate>➕ @lang('site.add') BlogCategory</a>

        <div class="overflow-x-auto mt-4">
            <x-autocrud::table
                :columns="['id', 'slug', 'name']"
                :data="$blogCategories"
                routePrefix="dashboard.blog_categories"
                :show="true"
                :edit="true"
                :delete="true"
                :restore="true"
            />
        </div>
    </div>
</x-app-layout>
