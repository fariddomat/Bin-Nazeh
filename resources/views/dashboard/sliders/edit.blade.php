<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.edit') @lang('site.dashboard.sliders')
        </h1>

        <form action="{{ route('dashboard.sliders.update', $slider->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.title')</label>
                <input type="text" name="title" value="{{ old('title', $slider->title) }}" class="w-full border border-gray-300 rounded p-2">
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.description')</label>
                <textarea name="description" class="w-full border border-gray-300 rounded p-2">{{ old('description', $slider->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.img')</label>
                <input type="file" name="img" accept="image/*" class="w-full border border-gray-300 rounded p-2">                @isset($slider->img)
                    <img src="{{ Storage::url($slider->img) }}" alt="img" class="mt-2 w-32 h-32 rounded">
                @endisset                @error('img')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                @lang('site.update')
            </button>
        </form>
    </div>
</x-app-layout>