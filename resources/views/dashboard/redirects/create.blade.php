<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.create') @lang('site.dashboard.redirects')
        </h1>

        <form action="{{ route('dashboard.redirects.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.source_url')</label>
                <input type="text" name="source_url" value="{{ old('source_url') }}" class="w-full border border-gray-300 rounded p-2">
                @error('source_url')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.destination_url')</label>
                <input type="text" name="destination_url" value="{{ old('destination_url') }}" class="w-full border border-gray-300 rounded p-2">
                @error('destination_url')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.status_code')</label>
                <input type="number" name="status_code" value="{{ old('status_code') }}" class="w-full border border-gray-300 rounded p-2" >
                @error('status_code')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                @lang('site.create')
            </button>
        </form>
    </div>
</x-app-layout>