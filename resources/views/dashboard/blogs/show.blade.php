<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.show') @lang('site.dashboard.blogs')
        </h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.slug')</label>
                <p class="text-gray-900">{{ $blog->slug ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.blog_category_id')</label>
                <p class="text-gray-900">
                    @isset($blog->blogCategory)
                        {{ $blog->blogCategory->name ?? '—' }}
                    @else
                        {{ $blog->blog_category_id ?? '—' }}
                    @endisset
                </p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.image')</label>
                @isset($blog->image)
                    <img src="{{ Storage::url($blog->image) }}" alt="image" class="mt-2 w-48 h-48 rounded">
                @else
                    <p class="text-gray-900">—</p>
                @endisset
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.image_alt')</label>
                <p class="text-gray-900">{{ $blog->image_alt ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.index_image')</label>
                @isset($blog->index_image)
                    <img src="{{ Storage::url($blog->index_image) }}" alt="index_image" class="mt-2 w-48 h-48 rounded">
                @else
                    <p class="text-gray-900">—</p>
                @endisset
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.index_image_alt')</label>
                <p class="text-gray-900">{{ $blog->index_image_alt ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.showed')</label>
                <p class="text-gray-900">{{ $blog->showed ? 'Yes' : 'No' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.show_at_home')</label>
                <p class="text-gray-900">{{ $blog->show_at_home ? 'Yes' : 'No' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.title')</label>
                <p class="text-gray-900">{{ $blog->title ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.introduction')</label>
                <p class="text-gray-900">{{ $blog->introduction ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.content_table')</label>
                <p class="text-gray-900">{{ $blog->content_table ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.first_paragraph')</label>
                <p class="text-gray-900">{{ $blog->first_paragraph ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.description')</label>
                <p class="text-gray-900">{{ $blog->description ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.author_name')</label>
                <p class="text-gray-900">{{ $blog->author_name ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.author_title')</label>
                <p class="text-gray-900">{{ $blog->author_title ?? '—' }}</p>
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.author_image')</label>
                @isset($blog->author_image)
                    <img src="{{ Storage::url($blog->author_image) }}" alt="author_image" class="mt-2 w-48 h-48 rounded">
                @else
                    <p class="text-gray-900">—</p>
                @endisset
            </div>
            <a href="{{ route('dashboard.blogs.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded shadow hover:bg-gray-700">
                @lang('site.back')
            </a>
        </div>
    </div>
</x-app-layout>