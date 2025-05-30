<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.create') @lang('site.dashboard.blogs')
        </h1>

        <form action="{{ route('dashboard.blogs.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.slug')</label>
                <input type="text" name="slug" value="{{ old('slug') }}" class="w-full border border-gray-300 rounded p-2">
                @error('slug')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.blog_category_id')</label>
                <select name="blog_category_id" class="w-full border border-gray-300 rounded p-2">
                    <option value="">@lang('site.select_blog_category_id')</option>
                    @foreach ($blogCategories as $option)
                        <option value="{{ $option->id }}" {{ old('blog_category_id') == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                    @endforeach
                </select>
                @error('blog_category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.image')</label>
                <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded p-2">                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.image_alt')</label>
                <input type="text" name="image_alt" value="{{ old('image_alt') }}" class="w-full border border-gray-300 rounded p-2">
                @error('image_alt')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.index_image')</label>
                <input type="file" name="index_image" accept="image/*" class="w-full border border-gray-300 rounded p-2">                @error('index_image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.index_image_alt')</label>
                <input type="text" name="index_image_alt" value="{{ old('index_image_alt') }}" class="w-full border border-gray-300 rounded p-2">
                @error('index_image_alt')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="showed" value="1" class="mr-2" >
                    @lang('site.showed')
                </label>
                @error('showed')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="show_at_home" value="1" class="mr-2" >
                    @lang('site.show_at_home')
                </label>
                @error('show_at_home')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.title')</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border border-gray-300 rounded p-2">
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.introduction')</label>
                <textarea name="introduction" class="w-full border border-gray-300 rounded p-2">{{ old('introduction') }}</textarea>
                @error('introduction')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.content_table')</label>
                <textarea name="content_table" class="w-full border border-gray-300 rounded p-2">{{ old('content_table') }}</textarea>
                @error('content_table')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.first_paragraph')</label>
                <textarea name="first_paragraph" class="w-full border border-gray-300 rounded p-2">{{ old('first_paragraph') }}</textarea>
                @error('first_paragraph')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.description')</label>
                <textarea name="description" class="w-full border border-gray-300 rounded p-2">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.author_name')</label>
                <input type="text" name="author_name" value="{{ old('author_name') }}" class="w-full border border-gray-300 rounded p-2">
                @error('author_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.author_title')</label>
                <input type="text" name="author_title" value="{{ old('author_title') }}" class="w-full border border-gray-300 rounded p-2">
                @error('author_title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.author_image')</label>
                <input type="file" name="author_image" accept="image/*" class="w-full border border-gray-300 rounded p-2">                @error('author_image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                @lang('site.create')
            </button>
        </form>
    </div>
</x-app-layout>