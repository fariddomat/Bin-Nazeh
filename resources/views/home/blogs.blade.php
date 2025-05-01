<x-site-layout>

    <!-- Blogs Grid Section -->
    <section id="blogs" x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">مقالاتنا</h2>
            <!-- Category Filter -->
            <div class="mb-8 flex flex-wrap justify-center gap-4">
                <a href="{{ route('blogs.index') }}"
                    class="px-4 py-2 {{ !$category ? 'bg-orange-500 text-white' : 'bg-white text-black' }} rounded-md hover:bg-orange-500 hover:text-white transition-all duration-300">
                    الكل
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('blogs.index', $cat->slug) }}"
                        class="px-4 py-2 {{ $category && $category->slug === $cat->slug ? 'bg-orange-500 text-white' : 'bg-white text-black' }} rounded-md hover:bg-orange-500 hover:text-white transition-all duration-300">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
            <!-- Blogs Grid -->
            @if ($blogs->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($blogs as $index => $blog)
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            x-intersect:delay="{{ ($index % 3) * 200 }}"
                            class="blog-card bg-white rounded-lg shadow-md overflow-hidden opacity-0 scale-95 hover:scale-105 hover:shadow-xl transition-all duration-300">
                            <!-- Image with Gold Border -->
                            <div class="relative p-4">
                                <div class="gold-border"></div>
                                <img src="{{ $blog->image ? asset('images/' . $blog->image) : asset('images/blog-placeholder.jpg') }}"
                                    alt="{{ $blog->image_alt ?? $blog->title }}"
                                    class="w-full h-64 object-cover rounded-lg relative z-10">
                            </div>
                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $blog->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{!! \Illuminate\Support\Str::limit(strip_tags($blog->introduction), 100) !!}</p>
                                <p class="text-gray-500 text-sm mb-4">{{ $blog->created_at->format('Y-m-d') }}</p>
                                <a href="{{ route('blogs.show', $blog->slug) }}"
                                    class="text-blue-600 hover:underline">اقرأ المزيد</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $blogs->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center text-gray-600 py-8">
                    <p>لا توجد مقالات متاحة حاليًا</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Introduction Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">مدونتنا المميزة</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Text -->
                <div x-intersect="$el.classList.add('animate-item', 'slide-in-left')" class="opacity-0 translate-x-10">
                    <h3 class="text-2xl font-bold text-orange-500 mb-4">معلومات عقارية قيمة</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        في مدونة بن نازح، نقدم مقالات غنية بالمعلومات حول السوق العقاري، التصميم، الاستدامة، والاستثمار.
                        نهدف إلى تمكين عملائنا بالمعرفة لاتخاذ قرارات مدروسة.
                    </p>
                </div>
                <!-- Image with Gold Border -->
                <div x-intersect="$el.classList.add('animate-item', 'slide-in-right')"
                    class="opacity-0 -translate-x-10 relative p-4">
                    <div class="gold-border"></div>
                    <img src="{{ asset('images/sections/Contact us section.jpg') }}" alt="Blogs Introduction"
                        class="w-full h-96 object-cover rounded-lg shadow-md relative z-10">
                </div>
            </div>
        </div>
    </section>

    <!-- Why We Blog Section -->
    <section id="why-we-blog" x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gradient-to-r from-gray-50 to-white py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <div class="relative max-w-3xl mx-auto border-2 border-orange-500 rounded-lg p-8 shadow-lg">
                <!-- Decorative Icon -->
                <i
                    class="fas fa-book-open text-5xl text-orange-500 absolute -top-6 left-1/2 transform -translate-x-1/2 bg-white px-4"></i>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mt-8 mb-6">لماذا نكتب</h2>
                <p class="text-gray-600 text-lg leading-relaxed text-center">
                    مدونتنا هي منصة لمشاركة الخبرات والرؤى العقارية. نسعى لتثقيف عملائنا حول أحدث الاتجاهات، النصائح
                    العملية،
                    والفرص الاستثمارية لدعم قراراتهم بثقة.
                </p>
                <!-- Centered Button with Pulse -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale', 'animate-pulse-once')"
                    class="mt-8 text-center opacity-0 scale-95">
                    <a href="#blogs"
                        class="inline-block px-8 py-4 bg-white text-black font-semibold rounded-md border border-gray-300 hover:bg-orange-500 hover:text-white transition-colors duration-300">
                        استكشف المقالات
                    </a>
                </div>
            </div>
        </div>
    </section>



    <!-- Call-to-Action Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">هل أنت مهتم بمعرفة المزيد؟</h2>
            <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                تواصل مع بن نازح للحصول على استشارات عقارية أو لمعرفة المزيد عن خدماتنا ومشاريعنا.
            </p>
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale', 'animate-pulse-once')"
                class="opacity-0 scale-95">
                <a href="{{ route('contact') }}"
                    class="inline-block px-8 py-4 bg-white text-black font-semibold rounded-md border border-gray-300 hover:bg-orange-500 hover:text-white transition-all duration-300">
                    تواصل معنا
                </a>
            </div>
        </div>
    </section>

    <!-- Custom Animations and Styles -->
    <style>
        @keyframes text-slide-in {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slide-in-right {
            from {
                transform: translateX(100px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slide-in-left {
            from {
                transform: translateX(-100px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fade-in-slide-up {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fade-in-scale {
            from {
                transform: scale(0.95);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes slide-in-up {
            from {
                transform: translateY(10px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes pulse-once {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
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

            .animate-section,
            .animate-item {
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
            Alpine.directive('intersect', (el, {
                value,
                expression
            }, {
                evaluate,
                cleanup
            }) => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const delay = parseInt(el.getAttribute('x-intersect:delay') ||
                                '0', 10);
                            setTimeout(() => {
                                evaluate(expression);
                            }, delay);
                            observer.unobserve(el);
                        }
                    });
                }, {
                    threshold: 0.1
                });
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
