<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.create') @lang('site.dashboard.meta_tags')
        </h1>

        <form action="{{ route('dashboard.meta_tags.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.page_route')</label>
                <input type="text" name="page_route" value="{{ old('page_route') }}" class="w-full border border-gray-300 rounded p-2">
                @error('page_route')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.meta_title')</label>
                <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="w-full border border-gray-300 rounded p-2">
                @error('meta_title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.meta_description')</label>
                <textarea name="meta_description" class="w-full border border-gray-300 rounded p-2">{{ old('meta_description') }}</textarea>
                @error('meta_description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.canonical_link')</label>
                <input type="text" name="canonical_link" value="{{ old('canonical_link') }}" class="w-full border border-gray-300 rounded p-2">
                @error('canonical_link')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.schema_markup')</label>
                <textarea name="schema_markup" class="w-full border border-gray-300 rounded p-2">{{ old('schema_markup') }}</textarea>
                @error('schema_markup')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                @lang('site.create')
            </button>
        </form>
    </div>
</x-app-layout>