<x-site-layout>
    <!-- Hero Image Slider -->
    <section class="relative h-screen">
        <div x-data="{
            slides: [
                { image: '{{ asset('images/slide1.jpg') }}', text: 'مرحباً بكم في بن نازح', description: 'نقدم حلولاً عقارية مبتكرة تلبي تطلعاتكم.' },
                { image: '{{ asset('images/slide2.jpg') }}', text: 'مستقبل التطوير العقاري', description: 'مشاريع مستدامة بتصاميم عصرية.' },
                { image: '{{ asset('images/slide3.jpg') }}', text: 'حقق أحلامك معنا', description: 'جودة وتميز في كل مشروع.' }
            ],
            currentSlide: 0,
            init() {
                setInterval(() => {
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                }, 10000); // Change slide every 10 seconds
            }
        }" class="relative h-full">
            <!-- Slides -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentSlide === index"
                    class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000"
                    :class="{ 'opacity-100': currentSlide === index, 'opacity-0': currentSlide !== index }"
                    :style="{ 'background-image': `url(${slide.image})` }">
                    <!-- Dark Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

                    <!-- Main Text with Fade-In Slide Effect -->
                    <div
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-white animate-text-slide-in">
                        <h1 class="text-4xl md:text-6xl font-bold" x-text="slide.text"></h1>
                    </div>

                    <!-- Description (Bottom Right) -->
                    <div class="absolute bottom-8 right-8 text-white max-w-sm animate-slide-in-right">
                        <p class="text-lg md:text-xl" x-text="slide.description"></p>
                    </div>

                    <!-- Explore Button (Bottom Left) -->
                    <div class="absolute bottom-8 left-8 animate-slide-in-left">
                        <a href="#"
                            class="inline-block px-6 py-3 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition-colors duration-300">
                            استكشف المزيد
                        </a>
                    </div>
                </div>
            </template>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="bg-white py-16">
        <div class="container text-center">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-12">شركائنا</h2>

            <!-- Continuous Logo Slider -->
            <div class="overflow-hidden">
                <div class="flex animate-continuous-slide" x-data="{ pause: false }" @mouseenter="pause = true"
                    @mouseleave="pause = false">
                    <!-- Logos (Repeated for seamless loop) -->
                    <div class="flex flex-shrink-0">
                        <img src="{{ asset('images/partner1.png') }}" alt="Partner 1" class="h-16 mx-6">
                        <img src="{{ asset('images/partner2.png') }}" alt="Partner 2" class="h-16 mx-6">
                        <img src="{{ asset('images/partner3.png') }}" alt="Partner 3" class="h-16 mx-6">
                        <img src="{{ asset('images/partner4.png') }}" alt="Partner 4" class="h-16 mx-6">
                        <img src="{{ asset('images/partner5.png') }}" alt="Partner 5" class="h-16 mx-6">
                    </div>
                    <!-- Duplicate Logos for Continuous Effect -->
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

    <!-- Video Section -->
    <section class="relative h-screen bg-gray-900">
        <video class="w-full h-full object-cover" autoplay muted loop playsinline>
            <source src="{{ asset('videos/placeholder-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>

    <!-- Services Section -->
    <section class="relative py-16 bg-cover bg-center"
        style="background-image: url('{{ asset('images/services-bg.jpg') }}')">
        <!-- Lightened Overlay -->
        <div class="absolute inset-0 bg-white bg-opacity-50"></div>

        <div class="container relative z-10">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">خدماتنا</h2>

            <!-- Services Slider -->
            <div class="relative">
                <div x-data="{
                    currentIndex: 0,
                    cardWidth: 320, // w-80 ≈ 320px
                    cardCount: 5, // Total services
                    cardsPerView: 3,
                    maxIndex() { return this.cardCount - this.cardsPerView; },
                    next() { if (this.currentIndex < this.maxIndex()) this.currentIndex++; },
                    prev() { if (this.currentIndex > 0) this.currentIndex--; }
                }" class="overflow-hidden">
                    <!-- Slider Container -->
                    <div class="flex transition-transform duration-500"
                        :style="{ 'transform': `translateX(-${currentIndex * cardWidth}px)` }">
                        <!-- Service 1 -->
                        <div class="service-card flex-shrink-0 w-80 bg-white rounded-lg shadow-lg p-6 text-center mx-3">
                            <i class="fas fa-building text-4xl text-gray-900 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">التطوير العقاري</h3>
                            <p class="text-gray-600 mb-4">نقدم حلول تطوير عقاري مبتكرة تلبي احتياجات السوق الحديث.</p>
                            <a href="#" class="text-blue-600 hover:underline">عرض المزيد</a>
                        </div>
                        <!-- Service 2 -->
                        <div class="service-card flex-shrink-0 w-80 bg-white rounded-lg shadow-lg p-6 text-center mx-3">
                            <i class="fas fa-drafting-compass text-4xl text-gray-900 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">التصميم المعماري</h3>
                            <p class="text-gray-600 mb-4">تصاميم معمارية عصرية تجمع بين الجمال والوظيفية.</p>
                            <a href="#" class="text-blue-600 hover:underline">عرض المزيد</a>
                        </div>
                        <!-- Service 3 -->
                        <div class="service-card flex-shrink-0 w-80 bg-white rounded-lg shadow-lg p-6 text-center mx-3">
                            <i class="fas fa-hard-hat text-4xl text-gray-900 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">إدارة المشاريع</h3>
                            <p class="text-gray-600 mb-4">إدارة شاملة للمشاريع لضمان الجودة والتسليم في الوقت المحدد.
                            </p>
                            <a href="#" class="text-blue-600 hover:underline">عرض المزيد</a>
                        </div>
                        <!-- Service 4 -->
                        <div class="service-card flex-shrink-0 w-80 bg-white rounded-lg shadow-lg p-6 text-center mx-3">
                            <i class="fas fa-leaf text-4xl text-gray-900 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">الحلول المستدامة</h3>
                            <p class="text-gray-600 mb-4">حلول صديقة للبيئة لمستقبل مستدام.</p>
                            <a href="#" class="text-blue-600 hover:underline">عرض المزيد</a>
                        </div>
                        <!-- Service 5 -->
                        <div class="service-card flex-shrink-0 w-80 bg-white rounded-lg shadow-lg p-6 text-center mx-3">
                            <i class="fas fa-handshake text-4xl text-gray-900 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">الاستشارات العقارية</h3>
                            <p class="text-gray-600 mb-4">استشارات مهنية لاتخاذ قرارات استثمارية مدروسة.</p>
                            <a href="#" class="text-blue-600 hover:underline">عرض المزيد</a>
                        </div>
                    </div>

                    <!-- Navigation Arrows -->
                    <button x-on:click="prev()" x-bind:class="{ 'opacity-50 cursor-not-allowed': currentIndex === 0 }"
                        class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-3 shadow-lg text-gray-900 hover:bg-gray-200">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button x-on:click="next()"
                        x-bind:class="{ 'opacity-50 cursor-not-allowed': currentIndex >= maxIndex() }"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-3 shadow-lg text-gray-900 hover:bg-gray-200">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
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

        @keyframes continuous-slide {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-text-slide-in {
            animation: text-slide-in 1s ease-out forwards;
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.8s ease-out forwards;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.8s ease-out forwards;
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

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }

        /* RTL Adjustments for Slider */
     
    </style>
</x-site-layout>
