<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.edit') @lang('site.dashboard.abouts')
        </h1>

        <form action="{{ route('dashboard.abouts.update', $about->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.name')</label>
                <input type="text" name="name" value="{{ old('name', $about->name) }}" class="w-full border border-gray-300 rounded p-2">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.discription')</label>
                <textarea name="discription" class="w-full border border-gray-300 rounded p-2">{{ old('discription', $about->discription) }}</textarea>
                @error('discription')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.img')</label>
                <input type="file" name="img" accept="image/*" class="w-full border border-gray-300 rounded p-2">                @isset($about->img)
                    <img src="{{ Storage::url($about->img) }}" alt="img" class="mt-2 w-32 h-32 rounded">
                @endisset                @error('img')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.icon')</label>
                <input type="text" name="icon" value="{{ old('icon', $about->icon) }}" class="w-full border border-gray-300 rounded p-2">
                @error('icon')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.class')</label>
                <input type="text" name="class" value="{{ old('class', $about->class) }}" class="w-full border border-gray-300 rounded p-2">
                @error('class')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.sort_id')</label>
                <input type="number" name="sort_id" value="{{ old('sort_id', $about->sort_id) }}" class="w-full border border-gray-300 rounded p-2" >
                @error('sort_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                @lang('site.update')
            </button>
        </form>
    </div>
</x-app-layout>