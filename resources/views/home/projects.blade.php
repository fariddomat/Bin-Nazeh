<x-site-layout>
    <!-- Hero Section (Parallax) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[75vh] overflow-hidden opacity-0 translate-y-10"
        data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg"
            style="background-image: url('{{ $category->img ? asset('images/' . $category->img) : asset('images/projects-hero.jpg') }}')">
            <!-- Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-transparent"></div>
            <!-- Centered Title -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-white">
                <h1 class="text-4xl md:text-6xl font-bold animate-text-slide-in">
                    مشاريعنا - {{ $category->name }}
                </h1>
                <p class="text-lg md:text-xl mt-4 animate-slide-in-up">
                    اكتشف مجموعتنا المميزة من المشاريع العقارية المصممة بعناية
                </p>
            </div>
        </div>
    </section>

    <!-- Projects List Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
                قائمة المشاريع
            </h2>
            @if ($projects->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($projects as $index => $project)
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            x-intersect:delay="{{ $index % 3 * 200 }}"
                            class="project-card bg-white rounded-lg shadow-md overflow-hidden opacity-0 scale-95 hover:scale-105 hover:shadow-xl transition-all duration-300">
                            <!-- Image -->
                            <div class="relative p-4">
                                <div class="gold-border"></div>
                                <img src="{{ $project->img ? asset('images/' . $project->img) : asset('images/coming-soon.jpg') }}"
                                    alt="{{ $project->name }}"
                                    class="w-full h-64 object-cover rounded-lg relative z-10">
                                <!-- Status Badge -->
                                <span class="absolute top-4 left-4 px-2 py-1 rounded text-white text-sm font-semibold"
                                    :class="{
                                        'bg-gray-500': '{{ $project->status }}' === 'not_started',
                                        'bg-orange-500': '{{ $project->status }}' === 'pending',
                                        'bg-green-500': '{{ $project->status }}' === 'done'
                                    }">
                                    @switch($project->status)
                                        @case('not_started')
                                            غير بدأ
                                            @break
                                        @case('pending')
                                            قيد التنفيذ
                                            @break
                                        @case('done')
                                            مكتمل
                                            @break
                                    @endswitch
                                </span>
                            </div>
                            <!-- Details -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">
                                    {{ $project->name }}
                                </h3>
                                <ul class="text-gray-600 text-sm space-y-2">
                                    <li><strong>الموقع:</strong> {{ $project->address ?? 'غير محدد' }}</li>
                                    <li><strong>عدد الطوابق:</strong> {{ $project->floors_count ?? 'غير محدد' }}</li>
                                    @if ($project->address_location)
                                        <li>
                                            <strong>موقع المشروع:</strong>
                                            <a href="{{ $project->address_location }}" target="_blank"
                                                class="text-blue-600 hover:underline">عرض الخريطة</a>
                                        </li>
                                    @else
                                        <li><strong>موقع المشروع:</strong> غير محدد</li>
                                    @endif
                                    <li><strong>اسم المخطط:</strong> {{ $project->scheme_name ?? 'غير محدد' }}</li>
                                    <li><strong>تاريخ البناء:</strong> {{ $project->date_of_build ? $project->date_of_build : 'غير محدد' }}</li>
                                    <li><strong>نسبة الإنجاز:</strong> {{ $project->status_percent ?? 0 }}%</li>
                                </ul>
                                <div class="mt-4 text-center">
                                    <a href="{{ route('projects.show', $project->slug) }}"
                                        class="inline-block px-6 py-3 bg-white text-black font-semibold rounded-md border border-gray-300 hover:bg-orange-500 hover:text-white transition-all duration-300">
                                        عرض التفاصيل
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-600 py-8">
                    <p>لا توجد مشاريع متاحة في هذه الفئة حاليًا</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                مستعد لاستكشاف المزيد؟
            </h2>
            <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                تواصل مع بن نازح لمعرفة المزيد عن مشاريعنا العقارية المبتكرة!
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
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes slide-in-up {
            from { transform: translateY(10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fade-in-slide-up {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fade-in-scale {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        @keyframes pulse-once {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .animate-text-slide-in {
            animation: text-slide-in 0.8s ease-in-out forwards;
        }

        .animate-slide-in-up {
            animation: slide-in-up 0.8s ease-in-out forwards;
        }

        .animate-section.fade-in-slide-up {
            animation: fade-in-slide-up 0.8s ease-in-out forwards;
        }

        .animate-item.fade-in-scale {
            animation: fade-in-scale 0.8s ease-in-out forwards;
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
            width: 40px;
            height: 2px;
            top: 10px;
            left: 10px;
        }

        .gold-border::after {
            width: 40px;
            height: 2px;
            bottom: 10px;
            right: 10px;
        }

        .gold-border::before:nth-child(2),
        .gold-border::after:nth-child(2) {
            width: 2px;
            height: 40px;
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

        /* Project Card Hover */
        .project-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        /* RTL Adjustments */

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
            .project-image {
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
            .project-card:hover {
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

        // Parallax Effect
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
