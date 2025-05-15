<x-site-layout>
    <!-- Hero Section (Parallax) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[95vh] overflow-hidden opacity-0 translate-y-10" data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg"
            style="background-image: url('{{ $project->cover_img ? Storage::url($project->cover_img) : ($project->img ? asset('images/' . $project->img) : asset('images/coming-soon.jpg')) }}')">
            <!-- Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-transparent"></div>
            <!-- Centered Title -->
            <div x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
                class="mt-32 py-16 opacity-0 translate-y-10">
                <div class="container">
                    <div class="relative max-w-3xl mx-auto border-2 border-orange-500 rounded-lg p-8 shadow-lg">
                        <!-- Decorative Icon -->
                        <i
                            class="fas fa-building text-5xl text-orange-500 absolute -top-6 left-1/2 transform -translate-x-1/2 px-4"></i>
                        <div class="text-center text-white">
                            <h1 class="text-4xl md:text-6xl font-bold animate-text-slide-in"> {{ $project->name }}
                            </h1>
                            <p class="text-lg md:text-xl mt-4 animate-slide-in-up"> تجربة سكنية فاخرة
                            </p>
                        </div>
                        <!-- Centered Button with Pulse -->
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale', 'animate-pulse-once')"
                            class="mt-8 text-center opacity-0 scale-95">
                            <a href="{{ route('contact') }}"
                                class="inline-block px-8 py-4 bg-white text-black font-semibold rounded-md border border-gray-300 hover:bg-orange-500 hover:text-white transition-colors duration-300">
                                استكشف المزيد
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Details Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-50 py-16 opacity-0 translate-y-10" id="details">
        <div class="container px-4 sm:px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12">
                <i class="fas fa-info-circle text-orange-500 mr-2"></i> عن المشروع
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Details with Icons -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in')" class="opacity-0">
                    <ul class="text-gray-700 text-base sm:text-lg space-y-4">
                        <li>
                            <i class="fas fa-map-marker-alt text-orange-500 mr-2"></i>
                            <strong>الموقع:</strong> {!! $project->address ?? 'غير محدد' !!}
                        </li>
                        <li>
                            <i class="fas fa-drafting-compass text-orange-500 mr-2"></i>
                            <strong>اسم المخطط:</strong> {{ $project->scheme_name ?? 'غير محدد' }}
                        </li>
                        <li>
                            <i class="fas fa-building text-orange-500 mr-2"></i>
                            <strong>عدد الأدوار:</strong> {{ $project->floors_count ?? 'غير محدد' }}
                        </li>
                        <li>
                            <i class="fas fa-calendar-alt text-orange-500 mr-2"></i>
                            <strong>تاريخ البناء:</strong>
                            {{ $project->date_of_build ? $project->date_of_build : 'غير محدد' }}
                        </li>
                        <li>
                            <i class="fas fa-chart-line text-orange-500 mr-2"></i>
                            <strong>نسبة الإنجاز:</strong> {{ $project->status_percent ?? 0 }}%
                        </li>
                        <li>
                            <i class="fas fa-check-circle text-orange-500 mr-2"></i>
                            <strong>الحالة:</strong>
                            @switch($project->status)
                                @case('not_started')
                                    لم يبدأ
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
                                <i class="fas fa-map text-orange-500 mr-2"></i>
                                <strong>موقع المشروع:</strong>
                                @if ($project->address_location)
                                    <a href="{{ $project->address_location }}" target="_blank"
                                        class="text-blue-600 hover:underline">عرض الخريطة</a>
                                @else
                                    غير محدد
                                @endif
                            </li>
                        @endif
                    </ul>
                    <!-- PDF Download Button -->

                </div>
                <!-- Image -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in')" class="opacity-0 relative">
                    <div class="mb-6">
                        <div class="flex flex-wrap gap-4">
                            @if ($project->projectPdfs->isNotEmpty())
                                @foreach ($project->projectPdfs as $index => $pdf)
                                    <a href="{{ Storage::url($pdf->file) }}" download
                                        class="inline-block px-6 py-3 bg-blue-900 text-white font-semibold rounded-lg hover:bg-orange-500 transition-all duration-300">
                                        <i class="fas fa-file-pdf mr-2"></i> تحميل البروشور #{{ $index + 1 }}
                                    </a>
                                @endforeach
                            @else

                            @endif
                            @if ($project->projectPdf2s->isNotEmpty())
                                @foreach ($project->projectPdf2s as $index => $pdf)
                                    <a href="{{ Storage::url($pdf->file) }}" download
                                        class="inline-block px-6 py-3 bg-blue-900 text-white font-semibold rounded-lg hover:bg-orange-500 transition-all duration-300">
                                        <i class="fas fa-file-pdf mr-2"></i> تحميل تصميم ثلاثي الأبعاد #{{ $index + 1 }}
                                    </a>
                                @endforeach
                            @else

                            @endif
                        </div>
                    </div>
                    <div class="relative rounded-lg overflow-hidden shadow-lg">
                        <img src="{{ $project->img ? Storage::url($project->img) : asset('images/coming-soon.jpg') }}"
                            alt="{{ $project->name }}"
                            class="w-full h-64 md:h-80 object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Details Section (Restored) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12">
                <i class="fas fa-file-alt text-orange-500 mr-2"></i> تفاصيل المشروع
            </h2>
            <div class="max-w-2xl mx-auto">
                <p class="text-gray-600 text-lg leading-relaxed">
                    {!! $project->details ?? 'لا توجد تفاصيل متاحة لهذا المشروع.' !!}
                </p>
            </div>
        </div>
    </section>

    <!-- Apartments Section (Expandable with All Fields) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-50 py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12">
                <i class="fas fa-home text-orange-500 mr-2"></i> نماذج الوحدات السكنية
            </h2>
            @if ($project->apartments->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($project->apartments as $index => $apartment)
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            x-intersect:delay="{{ $index * 200 }}" x-data="{ expanded: false }"
                            class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-all duration-300">
                            <!-- Collapsed View -->
                            <div class="flex justify-between items-center cursor-pointer" @click="expanded = !expanded">
                                <h3 class="text-xl font-bold text-gray-900">
                                    <i class="fas fa-building text-orange-500 mr-2"></i>
                                    {{ $apartment->type ?? 'غير محدد' }}
                                </h3>
                                <i class="fas fa-chevron-down text-orange-500 transition-transform duration-300"
                                    :class="{ 'rotate-180': expanded }"></i>
                            </div>
                            <div class="text-gray-600 mt-2 space-y-2">
                                <p>
                                    <i class="fas fa-key text-orange-500 mr-2"></i>
                                    رمز النموذج: {{ $apartment->code ?? 'غير محدد' }}
                                </p>
                                <p>
                                    <i class="fas fa-ruler-combined text-orange-500 mr-2"></i>
                                    المساحة: {{ $apartment->area ?? 'غير محدد' }} م²
                                </p>
                                <p>
                                    <i class="fas fa-money-bill-wave text-orange-500 mr-2"></i>
                                    السعر: {{ $apartment->price ? number_format($apartment->price, 2) : 'غير محدد' }}
                                    ريال
                                </p>
                            </div>
                            <!-- Expanded View -->
                            <div x-show="expanded" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 max-h-0"
                                x-transition:enter-end="opacity-100 max-h-screen"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 max-h-screen"
                                x-transition:leave-end="opacity-0 max-h-0"
                                class="mt-4 text-gray-600 border-t border-gray-200 pt-4 space-y-4">
                                @if ($apartment->about)
                                    <p>
                                        <i class="fas fa-align-left text-orange-500 mr-2"></i>
                                        <strong>حول الشقة:</strong> {!! $apartment->about ?? 'لا يوجد وصف متاح' !!}
                                    </p>
                                @endif
                                <p>
                                    <i class="fas fa-file-alt text-orange-500 mr-2"></i>
                                    <strong>التفاصيل:</strong> {!! $apartment->details ?? 'لا توجد تفاصيل متاحة' !!}
                                </p>
                                <p>
                                    <i class="fas fa-bed text-orange-500 mr-2"></i>
                                    <strong>عدد الغرف:</strong> {{ $apartment->room_count ?? 'غير محدد' }}
                                </p>
                                <p>
                                    <i class="fas fa-plus-circle text-orange-500 mr-2"></i>
                                    <strong>ملحق:</strong> {{ $apartment->appendix ? 'نعم' : 'لا' }}
                                </p>
                                @if ($apartment->price_bank && $apartment->price_bank > 0)
                                    <p>
                                        <i class="fas fa-university text-orange-500 mr-2"></i>
                                        <strong>سعر البنك:</strong>
                                        {{ $apartment->price_bank ? number_format($apartment->price_bank, 2) : 'غير محدد' }}
                                        ريال
                                    </p>
                                @endif
                                <!-- Apartment Image -->
                                <div>
                                    <i class="fas fa-image text-orange-500 mr-2"></i>
                                    <strong>صورة الشقة:</strong>
                                    @if ($apartment->img)
                                        <img src="{{ Storage::url($apartment->img) }}"
                                            alt="{{ $apartment->type }} Image"
                                            class="mt-2 w-full h-auto object-cover rounded-lg">
                                    @else
                                        <span class="text-gray-500">لا توجد صورة متاحة</span>
                                    @endif
                                </div>
                                <!-- Virtual Tour -->

                                <!-- YouTube Video -->
                                <div>
                                    <i class="fab fa-youtube text-orange-500 mr-2"></i>
                                    <strong>فيديو يوتيوب:</strong>
                                    @if ($apartment->youtube)
                                        <div class="mt-2">
                                            <iframe class="w-full h-48 rounded-lg"
                                                src="{{ str_replace('watch?v=', 'embed/', $apartment->youtube) }}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    @else
                                        <span class="text-gray-500">لا يوجد فيديو متاح</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-600 py-8">
                    <p><i class="fas fa-exclamation-circle mr-2"></i> لا توجد شقق متاحة لهذا المشروع حاليًا</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Image Gallery Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12">
                <i class="fas fa-images text-orange-500 mr-2"></i> معرض الصور
            </h2>
            <div x-data="{ zoomedImage: null }">
                @if ($project->projectImages->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($project->projectImages as $index => $image)
                            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                                x-intersect:delay="{{ $index * 100 }}"
                                class="relative rounded-lg overflow-hidden shadow-md opacity-0 scale-95">
                                <img src="{{ Storage::url($image->img) }}" alt="{{ $project->name }} Image"
                                    class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300 cursor-pointer"
                                    @click="zoomedImage = '{{ Storage::url($image->img) }}'">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-gray-600 py-8">
                        <p><i class="fas fa-exclamation-circle mr-2"></i> لا توجد صور متاحة لهذا المشروع</p>
                    </div>
                @endif
                <!-- Zoom Modal -->
                <div x-show="zoomedImage" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50"
                    @click="zoomedImage = null">
                    <img :src="zoomedImage" class="max-w-[90%] max-h-[90%] object-contain" @click.stop>
                </div>
            </div>
        </div>
    </section>

    <!-- Location & Virtual Tour Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-50 py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12">
                <i class="fas fa-map-marked-alt text-orange-500 mr-2"></i> الموقع والجولة الافتراضية
            </h2>
            <div class="relative h-96 rounded-lg overflow-hidden shadow-lg">
                <iframe class="w-full h-full"
                    src="{{ $project->address_location ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3623.677552346104!2d46.6752957!3d24.7135517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjTCsDQyJzQ4LjgiTiA0NsKwNDAnMzEuMSJF!5e0!3m2!1sen!2sus!4v1631234567890' }}"
                    frameborder="0" allowfullscreen loading="lazy">
                </iframe>
                @if ($project->virtual_location)
                    <a href="{{ $project->virtual_location }}" target="_blank"
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition-all duration-300">
                        <i class="fas fa-vr-cardboard mr-2"></i> جولة افتراضية
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                <i class="fas fa-question-circle text-orange-500 mr-2"></i> هل أنت مهتم بهذا المشروع؟
            </h2>
            <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                تواصل مع فريق المبيعات للحصول على مزيد من المعلومات أو لطلب استشارة.
            </p>
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale', 'animate-pulse-once')"
                class="opacity-0 scale-95">
                <a href="{{ route('contact') }}"
                    class="inline-block px-8 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition-all duration-300">
                    <i class="fas fa-phone-alt mr-2"></i> تواصل معنا
                </a>
            </div>
        </div>
    </section>

    <!-- Custom Styles -->
    <style>
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

        .animate-section.fade-in-slide-up {
            animation: fade-in-slide-up 0.8s ease-in-out forwards;
        }

        .animate-item.fade-in {
            animation: fade-in 0.8s ease-in-out forwards;
        }

        .animate-item.fade-in-scale {
            animation: fade-in-scale 0.8s ease-in-out forwards;
        }

        .animate-pulse-once {
            animation: pulse-once 1s ease-in-out;
        }

        /* Parallax */
        .parallax-bg {
            will-change: transform;
            background-attachment: fixed;
        }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .h-80 {
                height: 16rem;
            }

            .h-64 {
                height: 14rem;
            }

            .h-96 {
                height: 20rem;
            }

            .h-48 {
                height: 12rem;
            }

            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .text-base {
                font-size: 0.875rem;
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
            .animate-item {
                animation: none !important;
                transform: none !important;
                opacity: 1 !important;
            }

            img:hover,
            div:hover {
                transform: none !important;
            }
        }

        table {

            max-width: -webkit-fill-available;
        }

        /* Responsive Table Styles */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            /* Smooth scrolling on iOS */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 16px;
            text-align: right;
            /* RTL support */
            border-bottom: 1px solid #e5e7eb;
            font-size: 1rem;
        }

        th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #1f2937;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tr:hover {
            background-color: #f3f4f6;
        }
    </style>


    <style>
        /* Guarantees Section */
        .guarantees-section {
            padding: 3rem 0;
            background-color: #f9fafb;
            /* Light gray background */
            text-align: center;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            /* Dark gray */
            margin-bottom: 2rem;
        }

        .guarantees-list {
            display: grid;
            grid-template-columns: 1fr;
            /* 1 column on mobile */
            gap: 1rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .guarantees-list li {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            background-color: #ffffff;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 1.125rem;
            color: #374151;
            /* Dark gray text */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .guarantees-list li:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .guarantees-list li i {
            color: #f97316;
            /* Theme orange */
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }

        /* RTL Support */
        html[dir="rtl"] .guarantees-list li {
            justify-content: flex-end;
        }

        html[dir="rtl"] .guarantees-list li i {
            margin-right: 0;
            margin-left: 0.75rem;
        }

        /* Responsive Design */
        @media (min-width: 640px) {
            .guarantees-list {
                grid-template-columns: repeat(2, 1fr);
                /* 2 columns on small screens */
            }
        }

        @media (min-width: 1024px) {
            .guarantees-list {
                grid-template-columns: repeat(3, 1fr);
                /* 3 columns on desktop */
            }

            .section-title {
                font-size: 2.5rem;
            }

            .guarantees-list li {
                font-size: 1.25rem;
            }
        }
    </style>
    <!-- Alpine.js and Parallax Script -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.directive('intersect', (el, {
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
