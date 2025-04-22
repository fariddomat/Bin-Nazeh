<x-site-layout>
    <!-- Hero Section (Parallax) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[75vh] overflow-hidden opacity-0 translate-y-10"
        data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg"
            style="background-image: url('{{ asset('images/about-hero.jpg') }}')">
            <!-- Dark Overlay with Gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-transparent"></div>
        </div>
    </section>

    <!-- Who We Are Section (Enhanced Design) -->
    <section id="who-we-are" x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gradient-to-r from-gray-50 to-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <div class="relative max-w-3xl mx-auto border-2 border-orange-500 rounded-lg p-8 shadow-lg">
                <!-- Decorative Icon -->
                <i class="fas fa-building text-5xl text-orange-500 absolute -top-6 left-1/2 transform -translate-x-1/2 bg-white px-4"></i>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mt-8 mb-6">من نحن</h2>
                <p class="text-gray-600 text-lg leading-relaxed text-center">
                    بن نازح هي شركة رائدة في التطوير العقاري، تأسست لتقديم حلول مبتكرة ومستدامة تلبي تطلعات عملائنا.
                    مع فريق من الخبراء، نحن ملتزمون بالجودة والتصميم العصري، نسعى للتميز ورضا العملاء.
                </p>
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
    </section>

    <!-- Mission Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">الرسالة</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Text -->
                <div x-intersect="$el.classList.add('animate-item', 'slide-in-left')"
                    class="opacity-0 translate-x-10">
                    <h3 class="text-2xl font-bold text-orange-500 mb-4">رسالتنا</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        نسعى لإعادة تعريف التطوير العقاري من خلال مشاريع مبتكرة ومستدامة تحسن جودة الحياة وتبني مجتمعات مزدهرة.
                    </p>
                </div>
                <!-- Image with Gold Border -->
                <div x-intersect="$el.classList.add('animate-item', 'slide-in-right')"
                    class="opacity-0 -translate-x-10 relative p-4">
                    <div class="gold-border"></div>
                    <img src="{{ asset('images/mission.jpg') }}" alt="Mission" class="w-full h-96 object-cover rounded-lg shadow-md relative z-10">
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section (Hover Effects) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">قيمنا وأهدافنا</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Vision -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')" x-intersect:delay="0"
                    class="value-card bg-white rounded-lg shadow-md p-6 text-center opacity-0 scale-95 hover:scale-105 hover:shadow-xl transition-all duration-300">
                    <i class="fas fa-eye text-4xl text-orange-500 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">رؤيتنا</h3>
                    <p class="text-gray-600">
                        أن نكون الشركة الرائدة في التطوير العقاري، مع التركيز على الابتكار والاستدامة.
                    </p>
                </div>
                <!-- Success Standards -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')" x-intersect:delay="200"
                    class="value-card bg-white rounded-lg shadow-md p-6 text-center opacity-0 scale-95 hover:scale-105 hover:shadow-xl transition-all duration-300">
                    <i class="fas fa-star text-4xl text-orange-500 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">معايير النجاح</h3>
                    <p class="text-gray-600">
                        تحقيق التميز من خلال الجودة العالية، التسليم في الوقت المحدد، ورضا العملاء.
                    </p>
                </div>
                <!-- Values -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')" x-intersect:delay="400"
                    class="value-card bg-white rounded-lg shadow-md p-6 text-center opacity-0 scale-95 hover:scale-105 hover:shadow-xl transition-all duration-300">
                    <i class="fas fa-heart text-4xl text-orange-500 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">قيمنا</h3>
                    <p class="text-gray-600">
                        النزاهة، الابتكار، التعاون، والالتزام بالمسؤولية تجاه عملائنا ومجتمعنا.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Work Environment Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">بيئة العمل</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Image with Gold Border -->
                <div x-intersect="$el.classList.add('animate-item', 'slide-in-left')"
                    class="opacity-0 translate-x-10 relative p-4">
                    <div class="gold-border"></div>
                    <img src="{{ asset('images/work-environment.jpg') }}" alt="Work Environment" class="w-full h-96 object-cover rounded-lg shadow-md relative z-10">
                </div>
                <!-- Text -->
                <div x-intersect="$el.classList.add('animate-item', 'slide-in-right')"
                    class="opacity-0 -translate-x-10">
                    <h3 class="text-2xl font-bold text-orange-500 mb-4">بيئة عمل محفزة</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        نحن نفخر بتوفير بيئة عمل داعمة تشجع على الإبداع والتعاون، مع التدريب المستمر وفرص التطور المهني.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Responsibility Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">المسؤولية المجتمعية</h2>
            <p class="text-gray-600 text-lg leading-relaxed max-w-3xl mx-auto">
                في بن نازح، نؤمن بأهمية رد الجميل للمجتمع. نسعى لدعم التعليم، حماية البيئة، وتحسين جودة الحياة في مجتمعاتنا.
            </p>
        </div>
    </section>

    <!-- Partners Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-12">شركائنا</h2>
            <div class="overflow-hidden">
                <div class="flex animate-continuous-slide" x-data="{ pause: false }" @mouseenter="pause = true" @mouseleave="pause = false">
                    <div class="flex flex-shrink-0">
                        <img src="{{ asset('images/partner1.png') }}" alt="Partner 1" class="h-16 mx-6">
                        <img src="{{ asset('images/partner2.png') }}" alt="Partner 2" class="h-16 mx-6">
                        <img src="{{ asset('images/partner3.png') }}" alt="Partner 3" class="h-16 mx-6">
                        <img src="{{ asset('images/partner4.png') }}" alt="Partner 4" class="h-16 mx-6">
                        <img src="{{ asset('images/partner5.png') }}" alt="Partner 5" class="h-16 mx-6">
                    </div>
                    <div class="flex flex-shrink-0">
                        <img src="{{ asset('images/partner1.png') }}" alt="Partner 1" class="h-16 mx-6">
                        <img src="{{ asset('images/partner2.png') }}" alt="Partner 2" class="h-16 mx-6">
                        <img src="{{ asset('images/partner3.png') }}" alt="Partner 3" class="h-16 mx-6">
                        <img src="{{ asset('images/partner4.png') }}" alt="Partner 4" class="h-16 mx-6">
                        <img src="{{ asset('images/partner5.png') }}" alt="Partner 5" class="h-16 mx-6">
                    </div>
                </div>
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

        @keyframes continuous-slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
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

        .animate-slide-in-right {
            animation: slide-in-right 0.8s ease-in-out forwards;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.8s ease-in-out forwards;
        }

        .animate-continuous-slide {
            animation: continuous-slide 20s linear infinite;
        }

        .animate-continuous-slide:hover {
            animation-play-state: paused;
        }

        [dir="rtl"] .animate-continuous-slide {
            animation-direction: reverse;
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
            .mission-image,
            .work-environment-image {
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
            .value-card:hover {
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
