<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.create') @lang('site.dashboard.careers')
        </h1>

        <form action="{{ route('dashboard.careers.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.name')</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded p-2">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.email')</label>
                <input type="text" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded p-2">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.phone')</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 rounded p-2">
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.block_number')</label>
                <input type="number" name="block_number" value="{{ old('block_number') }}" class="w-full border border-gray-300 rounded p-2" >
                @error('block_number')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.city')</label>
                <input type="text" name="city" value="{{ old('city') }}" class="w-full border border-gray-300 rounded p-2">
                @error('city')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.project_id')</label>
                <select name="project_id" class="w-full border border-gray-300 rounded p-2">
                    <option value="">@lang('site.select_project_id')</option>
                    @foreach ($projects as $option)
                        <option value="{{ $option->id }}" {{ old('project_id') == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                    @endforeach
                </select>
                @error('project_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.wish')</label>
                <select name="wish" class="w-full border border-gray-300 rounded p-2">
                    <option value="">@lang('site.select_wish')</option>
                    <option value="استثمار" {{ old('wish') == 'استثمار' ? 'selected' : '' }}>استثمار</option>
                    <option value="سكن" {{ old('wish') == 'سكن' ? 'selected' : '' }}>سكن</option>
                    <option value="اخرى" {{ old('wish') == 'اخرى' ? 'selected' : '' }}>اخرى</option>

                </select>
                @error('wish')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.other_wish')</label>
                <input type="text" name="other_wish" value="{{ old('other_wish') }}" class="w-full border border-gray-300 rounded p-2">
                @error('other_wish')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.notes')</label>
                <textarea name="notes" class="w-full border border-gray-300 rounded p-2">{{ old('notes') }}</textarea>
                @error('notes')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                @lang('site.create')
            </button>
        </form>
    </div>
</x-app-layout>