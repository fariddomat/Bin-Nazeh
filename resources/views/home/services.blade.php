<x-site-layout>
    <!-- Hero Section (Parallax) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[95vh] overflow-hidden opacity-0 translate-y-10" data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg"
            style="background-image: url('{{ asset('images/sections/Register interest hero.jpg') }}')">
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
                            <h1 class="text-4xl md:text-6xl font-bold animate-text-slide-in">خدماتنا</h1>
                            <p class="text-lg md:text-xl mt-4 animate-slide-in-up">حلول عقارية مبتكرة لتلبية تطلعاتكم
                            </p>
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

    <!-- Introduction Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">خدماتنا المميزة</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Text -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in')" class="">
                    <h3 class="text-2xl font-bold text-orange-500 mb-4">نقدم التميز في كل خدمة</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        في بن نازح، نقدم مجموعة شاملة من الخدمات العقارية التي تجمع بين الابتكار، الجودة، والاستدامة.
                        من التطوير العقاري إلى الاستشارات، نحن هنا لتحقيق رؤيتكم باحترافية عالية.
                    </p>
                </div>
                <!-- Image with Gold Border -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in')"
                    class="relative p-4">
                    <div class="gold-border"></div>
                    <img src="{{ asset('images/sections/Register interest section.jpg') }}" alt="Services Introduction"
                        class="w-full h-96 object-cover rounded-lg shadow-md relative z-10">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">خدماتنا</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($services as $index => $service)
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                        :x-intersect:delay="{{ $index * 200 }}"
                        class="service-card bg-white rounded-lg shadow-md p-6 text-center opacity-0 scale-95 hover:scale-105 hover:shadow-xl transition-all duration-300">
                        <i class="{{ $service->icon ?? 'fas fa-cog' }} text-4xl text-orange-500 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $service->name }}</h3>
                        <p class="text-gray-600 mb-4">{!! \Illuminate\Support\Str::limit(strip_tags($service->description), 100) !!}</p>
                        <a wire:navigate href="{{ route('services.show', $service->slug) }}" class="text-blue-600 hover:underline">عرض
                            المزيد</a>
                    </div>
                @endforeach
            </div>
            @if ($services->isEmpty())
                <div class="text-center text-gray-600 py-8">
                    <p>لا توجد خدمات متاحة حالياً</p>
                </div>
            @endif
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

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
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
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .animate-text-slide-in {
            animation: text-slide-in 0.8s ease-in-out forwards;
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-in-out forwards;
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
            animation: pulse-once 1s ease-in-out forwards;
        }

        /* Gold Border (Disconnected Corners) */
        .gold-border {
            position: absolute;
            inset: 0;
            z-index: 5;
        }

        .gold-border::before,
        .gold-border::after {
            content: '';
            position: absolute;
            background: #FFD700;
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

        /* Service Card Hover */
        .service-card {
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
            .intro-image {
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

            .service-card:hover {
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
