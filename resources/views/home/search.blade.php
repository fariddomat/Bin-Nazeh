<x-site-layout>
    <section class="py-16 bg-gray-100">
        <div class="container">
            <h1 class="text-4xl font-bold text-gray-900 mb-8">نتائج البحث عن: {{ $query }}</h1>
            <p class="text-gray-600 mb-6">نطاق البحث:
                {{ $scope === 'all' ? 'الكل' : ($scope === 'projects' ? 'المشاريع' : 'الأخبار') }}</p>

            @if (empty($results['projects']) && empty($results['blogs']))
                <p class="text-gray-600">لم يتم العثور على نتائج مطابقة.</p>
            @else
                <!-- Projects -->
                @if (!empty($results['projects']))
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">المشاريع</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($results['projects'] as $project)
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $project->name }}</h3>
                                <p class="text-gray-600">{{ Str::limit($project->description, 100) }}</p>
                                <a href="{{ route('projects.show', $project->slug) }}"
                                    class="text-orange-500 hover:underline">عرض التفاصيل</a>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Blogs -->
                @if (!empty($results['blogs']))
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 mt-8">الأخبار</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($results['blogs'] as $blog)
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $blog->title }}</h3>
                                <p class="text-gray-600">{{ Str::limit($blog->content, 100) }}</p>
                                <a href="{{ route('blogs.show', $blog->slug) }}"
                                    class="text-orange-500 hover:underline">اقرأ المزيد</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </section>
</x-site-layout>
