<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.edit') @lang('site.dashboard.infos')
        </h1>

        <form action="{{ route('dashboard.infos.update', $info->id) }}" method="POST"
            class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.name')</label>
                <input type="text" name="name" value="{{ old('name', $info->name) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.description')</label>
                <textarea name="description" class="w-full border border-gray-300 rounded p-2">{{ old('description', $info->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.location')</label>
                <input type="text" name="location" value="{{ old('location', $info->location) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('location')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.location_link')</label>
                <textarea name="location_link" class="w-full border border-gray-300 rounded p-2">{{ old('location_link', $info->location_link) }}</textarea>
                @error('location_link')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.email')</label>
                <input type="text" name="email" value="{{ old('email', $info->email) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.phone_1')</label>
                <input type="text" name="phone_1" value="{{ old('phone_1', $info->phone_1) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('phone_1')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.phone_2')</label>
                <input type="text" name="phone_2" value="{{ old('phone_2', $info->phone_2) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('phone_2')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.logo')</label>
                <input type="file" name="logo" accept="image/*" class="w-full border border-gray-300 rounded p-2">
                @isset($info->logo)
                    <img src="{{ Storage::url($info->logo) }}" alt="logo" class="bg-gray-300 mt-2 w-32 h-32 rounded">
                    @endisset @error('logo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.logo_2')</label>
                <input type="file" name="logo_2" accept="image/*" class="w-full border border-gray-300 rounded p-2">
                @isset($info->logo_2)
                    <img src="{{ Storage::url($info->logo_2) }}" alt="logo_2" class="bg-gray-300 mt-2 w-32 h-32 rounded">
                    @endisset @error('logo_2')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                @lang('site.update')
            </button>
        </form>
    </div>
</x-app-layout>
