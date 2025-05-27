<x-site-layout>
    <!-- Hero Section (Parallax) -->


    <!-- Blog Content Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <div class="pt-12 pb-12 mx-auto">
                <!-- Main Image -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                    class="relative p-4 mb-8 opacity-0 scale-95">
                    <div class="gold-border"></div>
                    <img src="{{ $blog->image ? Storage::url($blog->image) : asset('images/blog-placeholder.jpg') }}"
                        alt="{{ $blog->image_alt ?? $blog->title }}"
                        class="w-full h-96 object-cover rounded-lg shadow-md relative z-10">
                </div>
                <!-- Content -->
                <div x-intersect="$el.classList.add('animate-item', 'slide-in-left')"
                    class="opacity-0 translate-x-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        {{ $blog->title }}
                    </h2>
                    <p class="text-gray-600 text-sm mb-4">
                        بقلم {{ $blog->author_name }} | {{ $blog->author_title }} | {{ $blog->created_at->format('Y-m-d') }}
                    </p>
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <!-- Content Table with Image -->
                        @if ($blog->content_table)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                                <!-- Content Table -->
                                <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                                    class="opacity-0 scale-95">
                                    {!! $blog->content_table !!}
                                </div>
                                <!-- Image -->
                                <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                                    class="relative p-4 opacity-0 scale-95">
                                    <div class="gold-border"></div>
                                    <img src="{{ $blog->index_image ? Storage::url( $blog->index_image) : ($blog->image ? Storage::url($blog->image) : asset('images/blog-placeholder.jpg')) }}"
                                        alt="{{ $blog->index_image_alt ?? $blog->image_alt ?? $blog->title }}"
                                        class="w-full h-64 object-cover rounded-lg shadow-md relative z-10">
                                </div>
                            </div>
                        @endif
                        <!-- First Paragraph -->
                        @if ($blog->first_paragraph)
                            <p>{!! $blog->first_paragraph !!}</p>
                        @endif
                        <!-- Description -->
                        @if ($blog->description)
                            <div>{!! $blog->description !!}</div>
                        @else
                            <p>لا يوجد محتوى متاح لهذا المقال.</p>
                        @endif
                        <!-- Social Share Buttons -->
                        <div class="mt-8 flex flex-wrap gap-4">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}"
                                class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-all duration-300"
                                target="_blank">
                                <i class="fab fa-x-twitter mr-2"></i> شارك على تويتر
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                class="flex items-center px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-800 transition-all duration-300"
                                target="_blank">
                                <i class="fab fa-facebook-f mr-2"></i> شارك على فيسبوك
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                class="flex items-center px-4 py-2 bg-blue-800 text-white rounded-md hover:bg-blue-900 transition-all duration-300"
                                target="_blank">
                                <i class="fab fa-linkedin-in mr-2"></i> شارك على لينكدإن
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . url()->current()) }}"
                                class="flex items-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-all duration-300"
                                target="_blank">
                                <i class="fab fa-whatsapp mr-2"></i> شارك على واتساب
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">مقالات ذات صلة</h2>
            @if ($relatedBlogs->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($relatedBlogs as $index => $relatedBlog)
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            x-intersect:delay="{{ $index * 200 }}"
                            class="blog-card bg-white rounded-lg shadow-md overflow-hidden opacity-0 scale-95 hover:scale-105 hover:shadow-xl transition-all duration-300">
                            <!-- Image with Gold Border -->
                            <div class="relative p-4">
                                <div class="gold-border"></div>
                                <img src="{{ $relatedBlog->image ? Storage::url('images/' . $relatedBlog->image) : asset('images/blog-placeholder.jpg') }}"
                                    alt="{{ $relatedBlog->image_alt ?? $relatedBlog->title }}"
                                    class="w-full h-64 object-cover rounded-lg relative z-10">
                            </div>
                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $relatedBlog->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{!! \Illuminate\Support\Str::limit(strip_tags($relatedBlog->introduction), 100) !!}</p>
                                <p class="text-gray-500 text-sm mb-4">{{ $relatedBlog->created_at->format('Y-m-d') }}</p>
                                <a wire:navigate href="{{ route('blogs.show', $relatedBlog->slug) }}"
                                    class="text-blue-600 hover:underline">اقرأ المزيد</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-600 py-8">
                    <p>لا توجد مقالات ذات صلة متاحة حاليًا</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">استكشف المزيد من المقالات</h2>
            <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                زر مدونتنا للحصول على المزيد من الرؤى العقارية أو تواصل مع بن نازح لاستشارات مخصصة.
            </p>
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale', 'animate-pulse-once')"
                class="opacity-0 scale-95">
                <a wire:navigate href="{{ route('blogs.index') }}"
                    class="inline-block px-8 py-4 bg-white text-black font-semibold rounded-md border border-gray-300 hover:bg-orange-500 hover:text-white transition-all duration-300 mr-4">
                    تصفح المدونة
                </a>
                <a wire:navigate href="{{ route('contact') }}"
                    class="inline-block px-8 py-4 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 transition-all duration-300">
                    تواصل معنا
                </a>
            </div>
        </div>
    </section>

    <!-- Custom Animations and Styles -->
    <style>
        @keyframes text-slide-in {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes slide-in-right {
            from { transform: translateX(100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slide-in-left {
            from { transform: translateX(-100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes fade-in-slide-up {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fade-in-scale {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        @keyframes slide-in-up {
            from { transform: translateY(10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes pulse-once {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .animate-text-slide-in {
            animation: text-slide-in 0.8s ease-in-out forwards;
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.8s ease-in-out forwards;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.8s ease-in-out forwards;
        }

        .animate-section.fade-in-slide-up {
            animation: fade-in-slide-up 0.8s ease-in-out forwards;
        }

        .animate-item.fade-in-scale {
            animation: fade-in-scale 0.8s ease-in-out forwards;
        }

        .animate-slide-in-up {
            animation: slide-in-up 0.8s ease-in-out forwards;
        }

        .animate-pulse-once {
            animation: pulse-once 1s ease-in-out;
        }

        /* Gold Gradient Border */
        .gold-border {
            position: absolute;
            inset: 0;
            z-index: 5;
        }

        .gold-border::before,
        .gold-border::after {
            content: '';
            position: absolute;
            background: linear-gradient(to right, #FFD700, #FBBF24);
        }

        .gold-border::before {
            width: 30px;
            height: 2px;
            top: 10px;
            left: 10px;
        }

        .gold-border::after {
            width: 30px;
            height: 2px;
            bottom: 10px;
            right: 10px;
        }

        .gold-border::before:nth-child(2),
        .gold-border::after:nth-child(2) {
            width: 2px;
            height: 30px;
            background: linear-gradient(to bottom, #FFD700, #FBBF24);
        }

        .gold-border::before:nth-child(2) {
            top: 10px;
            right: 10px;
        }

        .gold-border::after:nth-child(2) {
            bottom: 10px;
            left: 10px;
        }

        /* Parallax */
        .parallax-bg {
            will-change: transform;
        }

        /* Blog Card Hover */
        .blog-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        /* Prose Styling for Content */
        .prose {
            max-width: 100%;
        }

        .prose p {
            margin-bottom: 1.5rem;
        }

        /* RTL Adjustments */
        [dir="rtl"] .slide-in-left {
            animation: slide-in-right 0.8s ease-in-out forwards;
        }

        [dir="rtl"] .slide-in-right {
            animation: slide-in-left 0.8s ease-in-out forwards;
        }

        [dir="rtl"] .gold-border::before {
            left: auto;
            right: 10px;
        }

        [dir="rtl"] .gold-border::after {
            right: auto;
            left: 10px;
        }

        [dir="rtl"] .gold-border::before:nth-child(2) {
            right: auto;
            left: 10px;
        }

        [dir="rtl"] .gold-border::after:nth-child(2) {
            left: auto;
            right: 10px;
        }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .blog-image {
                height: 16rem;
            }
        }

        /* Disable Parallax on Mobile */
        @media (max-width: 768px) {
            .parallax-bg {
                background-attachment: scroll !important;
            }
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            .animate-section, .animate-item {
                animation: none !important;
                transform: none !important;
                opacity: 1 !important;
            }
            .blog-card:hover {
                transform: none !important;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
            }
        }
    </style>

    <!-- Alpine.js and Parallax Script -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.directive('intersect', (el, { value, expression }, { evaluate, cleanup }) => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const delay = parseInt(el.getAttribute('x-intersect:delay') || '0', 10);
                            setTimeout(() => {
                                evaluate(expression);
                            }, delay);
                            observer.unobserve(el);
                        }
                    });
                }, { threshold: 0.1 });
                observer.observe(el);
                cleanup(() => observer.disconnect());
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const parallaxSections = document.querySelectorAll('[data-parallax]');
            parallaxSections.forEach(section => {
                const bg = section.querySelector('.parallax-bg');
                window.addEventListener('scroll', () => {
                    const rect = section.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        const offset = window.pageYOffset - section.offsetTop;
                        bg.style.transform = `translateY(${offset * 0.3}px)`;
                    }
                });
            });
        });
    </script>
</x-site-layout>
