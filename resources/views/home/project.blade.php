<x-site-layout>
    <!-- Hero Section (Parallax) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[75vh] overflow-hidden opacity-0 translate-y-10"
        data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg"
            style="background-image: url('{{ $project->cover_img ? asset('images/' . $project->cover_img) : ($project->img ? asset('images/' . $project->img) : asset('images/coming-soon.jpg')) }}')">
            <!-- Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-transparent"></div>
            <!-- Centered Title -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-white">
                <h1 class="text-4xl md:text-6xl font-bold animate-text-slide-in">
                    {{ $project->name }}
                </h1>
                <p class="text-lg md:text-xl mt-4 animate-slide-in-up">
                    تجربة سكنية فاخرة في قلب {{ $project->address ?? 'الرياض' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Description Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
                عن المشروع
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Text -->
                <div x-intersect="$el.classList.add('animate-item', 'slide-in-left')"
                    class="opacity-0 translate-x-10">
                    <p class="text-gray-600 text-lg leading-relaxed">
                        {!! nl2br(e($project->details ?? 'لا توجد تفاصيل متاحة لهذا المشروع.')) !!}
                    </p>
                </div>
                <!-- Image -->
                <div x-intersect="$el.classList.add('animate-item', 'slide-in-right')"
                    class="opacity-0 -translate-x-10 relative p-4">
                    <div class="gold-border"></div>
                    <img src="{{ $project->img ? asset('images/' . $project->img) : asset('images/coming-soon.jpg') }}"
                        alt="{{ $project->name }}"
                        class="w-full h-96 object-cover rounded-lg relative z-10">
                </div>
            </div>
        </div>
    </section>

    <!-- Images Slider Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
                معرض الصور
            </h2>
            <div x-data="{
                currentSlide: 0,
                slides: @json($project->images ?? []),
                zoomedImage: null
            }" class="relative">
                <!-- Slider -->
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-in-out"
                        :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
                        @if (!empty($project->images))
                            {{-- @foreach ($project->images as $image)
                                <div class="w-full flex-shrink-0">
                                    <img src="{{ asset('images/' . $image) }}"
                                        alt="{{ $project->name }} Image"
                                        class="w-full h-96 object-cover rounded-lg cursor-pointer hover:scale-105 transition-transform duration-300"
                                        @click="zoomedImage = '{{ asset('images/' . $image) }}'">
                                </div>
                            @endforeach --}}
                        @else
                            <div class="w-full flex-shrink-0">
                                <img src="{{ asset('images/coming-soon.jpg') }}"
                                    alt="No Images Available"
                                    class="w-full h-96 object-cover rounded-lg">
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Navigation Buttons -->
                {{-- @if (!empty($project->images) && count($project->images) > 1)
                    <button @click="currentSlide = currentSlide > 0 ? currentSlide - 1 : slides.length - 1"
                        class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-orange-500 text-white p-2 rounded-full hover:bg-orange-600">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button @click="currentSlide = currentSlide < slides.length - 1 ? currentSlide + 1 : 0"
                        class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-orange-500 text-white p-2 rounded-full hover:bg-orange-600">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                @endif --}}
                <!-- Zoom Modal -->
                <div x-show="zoomedImage"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50"
                    @click="zoomedImage = null">
                    <img :src="zoomedImage" class="max-w-[90%] max-h-[90%] object-contain" @click.stop>
                </div>
            </div>
        </div>
    </section>

    <!-- Google Map & Virtual Tour Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
                الموقع والجولة الافتراضية
            </h2>
            <div class="relative h-96 rounded-lg overflow-hidden">
                <!-- Google Map -->
                <iframe
                    class="w-full h-full"
                    src="{{ $project->address_location ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3623.677552346104!2d46.6752957!3d24.7135517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjTCsDQyJzQ4LjgiTiA0NsKwNDAnMzEuMSJF!5e0!3m2!1sen!2sus!4v1631234567890' }}"
                    frameborder="0"
                    allowfullscreen
                    loading="lazy">
                </iframe>
                <!-- Virtual Tour Overlay -->
                @if ($project->virtual_location)
                    <a href="{{ $project->virtual_location }}"
                        target="_blank"
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-orange-500 text-white px-6 py-3 rounded-md font-semibold hover:bg-orange-600 transition-all duration-300">
                        جولة افتراضية
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Details Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
                تفاصيل المشروع
            </h2>
            <div class="max-w-2xl mx-auto">
                <ul class="text-gray-600 text-lg space-y-4">
                    <li><strong>الموقع:</strong> {{ $project->address ?? 'غير محدد' }}</li>
                    <li><strong>اسم المخطط:</strong> {{ $project->scheme_name ?? 'غير محدد' }}</li>
                    <li><strong>عدد الطوابق:</strong> {{ $project->floors_count ?? 'غير محدد' }}</li>
                    <li><strong>تاريخ البناء:</strong> {{ $project->date_of_build ? $project->date_of_build : 'غير محدد' }}</li>
                    <li><strong>نسبة الإنجاز:</strong> {{ $project->status_percent ?? 0 }}%</li>
                    <li><strong>الحالة:</strong>
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
                            @default
                                غير محدد
                        @endswitch
                    </li>
                    @if ($project->address_location)
                        <li>
                            <strong>موقع المشروع:</strong>
                            <a href="{{ $project->address_location }}" target="_blank"
                                class="text-blue-600 hover:underline">عرض الخريطة</a>
                        </li>
                    @else
                        <li><strong>موقع المشروع:</strong> غير محدد</li>
                    @endif
                </ul>
            </div>
        </div>
    </section>

    <!-- Apartments Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
                الشقق المتوفرة
            </h2>
            @if (!empty($project->apartments))
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($project->apartments as $index => $apartment)
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            x-intersect:delay="{{ $index * 200 }}"
                            class="bg-white rounded-lg shadow-md p-6 text-center opacity-0 scale-95 hover:scale-105 hover:shadow-xl transition-all duration-300">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                {{ $apartment['type'] ?? 'غير محدد' }}
                            </h3>
                            <p class="text-gray-600 mb-2"><strong>المساحة:</strong> {{ $apartment['size'] ?? 'غير محدد' }}</p>
                            <p class="text-gray-600 mb-2"><strong>السعر:</strong> {{ $apartment['price'] ?? 'غير محدد' }}</p>
                            <p class="text-gray-600 mb-4"><strong>التوفر:</strong> {{ $apartment['availability'] ?? 'غير محدد' }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-600 py-8">
                    <p>لا توجد شقق متاحة لهذا المشروع حاليًا</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Extra Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
                مميزات إضافية
            </h2>
            <div class="max-w-2xl mx-auto">
                @if (!empty($project->extras))
                    <ul class="text-gray-600 text-lg space-y-4">
                        @foreach ($project->extras as $extra)
                            <li><i class="fas fa-check-circle text-orange-500 mr-2"></i> {{ $extra }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600 text-lg text-center">لا توجد مميزات إضافية متاحة لهذا المشروع.</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                هل أنت مهتم بهذا المشروع؟
            </h2>
            <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                تواصل مع بن نازح للحصول على مزيد من المعلومات أو لطلب استشارة.
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

        @keyframes slide-in-left {
            from { transform: translateX(-100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slide-in-right {
            from { transform: translateX(100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
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

        .animate-item.slide-in-left {
            animation: slide-in-left 0.8s ease-in-out forwards;
        }

        .animate-item.slide-in-right {
            animation: slide-in-right 0.8s ease-in-out forwards;
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

        /* Slider Image Hover */
        .slider-image {
            transition: transform 0.3s ease-in-out;
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

        [dir="rtl"] .slide-in-left {
            animation: slide-in-right 0.8s ease-in-out forwards;
        }

        [dir="rtl"] .slide-in-right {
            animation: slide-in-left 0.8s ease-in-out forwards;
        }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .project-image {
                height: 16rem;
            }
            .map-container {
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
            .slider-image:hover, .project-card:hover {
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
