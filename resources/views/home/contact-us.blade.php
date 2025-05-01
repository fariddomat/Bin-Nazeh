<x-site-layout>
    <!-- Hero Section (Parallax) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[95vh] overflow-hidden opacity-0 translate-y-10" data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg"
            style="background-image: url('{{ asset('images/sections/Contact us hero.jpg') }}')">
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
                                <h1 class="text-4xl md:text-6xl font-bold animate-text-slide-in">تواصل معنا</h1>
                                <p class="text-lg md:text-xl mt-4 animate-slide-in-up">نحن هنا لدعم تطلعاتك العقارية</p>
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

    <!-- Form and Info Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">أرسل استفسارك</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- Form Column -->
                <div class="relative p-4">
                    <!-- Gold Gradient Border -->
                    <div class="gold-border"></div>
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Form -->
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow-md relative z-10">
                        @csrf
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-gray-600 mb-2">الاسم <span class="text-red-500">*</span></label>
                            <input name="name" id="name" type="text" value="{{ old('name') }}"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-gray-600 mb-2">البريد الإلكتروني <span class="text-red-500">*</span></label>
                            <input name="email" id="email" type="email" value="{{ old('email') }}"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-gray-600 mb-2">رقم الهاتف <span class="text-red-500">*</span></label>
                            <input name="phone" id="phone" type="text" value="{{ old('phone') }}"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Project -->
                        <div>
                            <label for="project_id" class="block text-gray-600 mb-2">المشروع <span class="text-red-500">*</span></label>
                            <select name="project_id" id="project_id"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('project_id') border-red-500 @enderror">
                                <option value="">اختر المشروع</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-gray-600 mb-2">الرسالة <span class="text-red-500">*</span></label>
                            <textarea name="message" id="message" rows="6"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit"
                                class="px-8 py-4 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 transition-all duration-300">
                                أرسل الآن
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Info Column -->
                <div class="relative p-4">
                    <!-- Gold Gradient Border -->
                    <div class="gold-border"></div>
                    <div class="bg-white p-6 rounded-lg shadow-md relative z-10">
                        <h3 x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            class="text-2xl font-bold text-gray-900 mb-4 opacity-0 scale-95">
                            لماذا تتواصل مع بن نازح؟
                        </h3>
                        <p x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            class="text-gray-600 mb-6 opacity-0 scale-95">
                            فريق بن نازح العقارية مكرس لتقديم دعم استثنائي لعملائنا. عندما تتواصل معنا، ستحصل على:
                        </p>
                        <ul x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            class="list-disc list-inside text-gray-600 mb-6 opacity-0 scale-95">
                            <li>ردود سريعة من فريقنا المتخصص خلال 24 ساعة.</li>
                            <li>دعم من خبراء عقاريين للإجابة على استفساراتك.</li>
                            <li>حلول مخصصة تتناسب مع احتياجاتك الاستثمارية أو السكنية.</li>
                            <li>معلومات حصرية عن مشاريعنا القادمة والفرص المتاحة.</li>
                        </ul>
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            class="relative p-4 opacity-0 scale-95">
                            <div class="gold-border"></div>
                            <img src="{{ asset('images/sections/Contact us section.jpg') }}"
                                alt="فريق بن نازح العقارية"
                                class="w-full h-64 object-cover rounded-lg shadow-md relative z-10">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">اكتشف المزيد</h2>
            <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                تصفح مشاريعنا العقارية الفاخرة أو اطلع على مدونتنا للحصول على رؤى عقارية قيمة.
            </p>
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale', 'animate-pulse-once')"
                class="opacity-0 scale-95">
                <a href="{{ route('projects') }}"
                    class="inline-block px-8 py-4 bg-white text-black font-semibold rounded-md border border-gray-300 hover:bg-orange-500 hover:text-white transition-all duration-300 mr-4">
                    تصفح المشاريع
                </a>
                <a href="{{ route('blogs.index') }}"
                    class="inline-block px-8 py-4 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 transition-all duration-300">
                    زر المدونة
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

        /* RTL Adjustments */
        [dir="rtl"] .space-x-4 > * + * {
            margin-left: 0;
            margin-right: 1rem;
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
            .form-container {
                padding: 1rem;
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
