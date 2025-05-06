<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.edit') @lang('site.dashboard.apartments')
        </h1>

        <form action="{{ route('dashboard.projects.apartments.update', [$project, $apartment->id]) }}" method="POST"
            class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.type')</label>
                <input type="text" name="type" value="{{ old('type', $apartment->type) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="appendix" value="1" class="mr-2"
                        {{ $apartment->appendix ? 'checked' : '' }}>
                    @lang('site.appendix')
                </label>
                @error('appendix')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.code')</label>
                <input type="text" name="code" value="{{ old('code', $apartment->code) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('code')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.room_count')</label>
                <input type="number" name="room_count" value="{{ old('room_count', $apartment->room_count) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('room_count')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.area')</label>
                <input type="number" name="area" value="{{ old('area', $apartment->area) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('area')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.about')</label>
                <textarea name="about" class="w-full border border-gray-300 rounded p-2">{{ old('about', $apartment->about) }}</textarea>
                @error('about')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.price')</label>
                <input type="number" name="price" value="{{ old('price', $apartment->price) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.price_bank')</label>
                <input type="number" name="price_bank" value="{{ old('price_bank', $apartment->price_bank) }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('price_bank')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.details')</label>
                <textarea name="details" class="w-full border border-gray-300 rounded p-2">{{ old('details', $apartment->details) }}</textarea>
                @error('details')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.img')</label>
                <input type="file" name="img" accept="image/*" class="w-full border border-gray-300 rounded p-2">
                @isset($apartment->img)
                    <img src="{{ Storage::url($apartment->img) }}" alt="img" class="mt-2 w-32 h-32 rounded">
                    @endisset @error('img')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.virtual_location')</label>
                <textarea name="virtual_location" class="w-full border border-gray-300 rounded p-2">{{ old('virtual_location', $apartment->virtual_location) }}</textarea>
                @error('virtual_location')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.youtube')</label>
                <textarea name="youtube" class="w-full border border-gray-300 rounded p-2">{{ old('youtube', $apartment->youtube) }}</textarea>
                @error('youtube')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                @lang('site.update')
            </button>
        </form>
    </div>
</x-app-layout>
