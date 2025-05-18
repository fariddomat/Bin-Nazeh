<x-site-layout>
    <!-- Hero Section (Parallax) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[95vh] overflow-hidden opacity-0 translate-y-10" data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg"
            style="background-image: url('{{ asset('images/sections/Project hero.jpg') }}')">
            <!-- Dark Overlay with Gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-transparent"></div>
            <!-- Centered Title -->
            <div x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
                class="mt-32 py-16 opacity-0 translate-y-10">
                <div class="container">
                    <div class="relative max-w-3xl mx-auto border-2 border-orange-500 rounded-lg p-8 shadow-lg">
                        <!-- Decorative Icon -->
                        <i
                            class="fas fa-building text-5xl text-orange-500 absolute -top-6 left-1/2 transform -translate-x-1/2 px-4"></i>
                        <div class="text-center text-white">
                            <h1 class="text-4xl md:text-6xl font-bold animate-text-slide-in">مشاريعنا -
                                {{ $category->name }}</h1>
                            <p class="text-lg md:text-xl mt-4 animate-slide-in-up">اكتشف مجموعتنا المميزة من المشاريع
                                العقارية المصممة بعناية</p>
                        </div>
                        <!-- Centered Button with Pulse -->
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale', 'animate-pulse-once')"
                            class="mt-8 text-center opacity-0 scale-95">
                            <a href="#mission"
                                class="inline-block px-8 py-4 bg-white text-black font-semibold rounded-md border border-gray-300 hover:bg-orange-500 hover:text-white transition-colors duration-300">
                                استكشف المزيد
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects List Section (Material Design Cards) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
                قائمة المشاريع
            </h2>
            @if ($projects->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($projects as $index => $project)
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            x-intersect:delay="{{ ($index % 3) * 200 }}"
                            class="project-card bg-white shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden material-card"
                            :class="{ 'rounded-tl-3xl rounded-br-3xl rounded-tr-md rounded-bl-md': '{{ $index % 2 }}'
                                === '0', 'rounded-tr-3xl rounded-bl-3xl rounded-tl-md rounded-br-md': '{{ $index % 2 }}'
                                !== '0' }">
                            <!-- Image -->
                            <div class="relative">
                                <img src="{{ $project->img ? Storage::url($project->img) : asset('images/coming-soon.jpg') }}"
                                    alt="{{ $project->name }}"
                                    class="w-full h-64 object-cover rounded-t-inherit hover:scale-105 transition-all duration-300">
                                <!-- Status Badge -->
                                @if ($project->status === 'sold')
                            <div class="absolute z-50 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45">
                                <img src="{{ asset('sell.png') }}" alt="مباع"
                                    class="w-60 h-60 object-contain">
                            </div>
                        @else
                            <span class="absolute z-50 top-4 left-4 px-2 py-1 rounded text-white text-sm font-semibold"
                                :class="{
                                    'bg-green-500': '{{ $project->status }}' === 'available',
                                    'bg-orange-500': '{{ $project->status }}' === 'under_construction',
                                    'bg-blue-500': '{{ $project->status }}' === 'ready'
                                }">
                                {{ $project->status_label }}
                            </span>
                        @endif
                            </div>
                            <!-- Details -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">
                                    {{ $project->name }}
                                </h3>
                                <div class="mt-4 text-center">
                                    <a wire:navigate href="{{ route('projects.show', $project->slug) }}"
                                        class="inline-block px-6 py-3 bg-blue-900 text-white font-semibold rounded-md hover:bg-orange-500 transition-all duration-300">
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
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                مستعد لاستكشاف المزيد؟
            </h2>
            <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                تواصل مع فريق المبيعات لمعرفة المزيد عن مشاريعنا العقارية المبتكرة!
            </p>
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale', 'animate-pulse-once')"
                class="opacity-0 scale-95">
                <a wire:navigate href="{{ route('contact') }}"
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

        /* Material Card Styling */
        .material-card {
            position: relative;
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .material-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        /* Inherit border radius for image */
        .material-card img.rounded-t-inherit {
            border-top-left-radius: inherit;
            border-top-right-radius: inherit;
        }

        /* Parallax */
        .parallax-bg {
            willOverride will-change: transform;
            background-attachment: fixed;
        }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .project-card {
                border-radius: 1rem !important;
                /* Simplify for mobile */
            }

            .h-64 {
                height: 16rem;
            }
        }

        @media (max-width: 768px) {
            .parallax-bg {
                background-attachment: scroll !important;
            }
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {

            .animate-section,
            .animate-item,
            .material-card {
                animation: none !important;
                transform: none !important;
                opacity: 1 !important;
            }

            .material-card:hover {
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
