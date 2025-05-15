<x-site-layout>

    <!-- Service Details Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
                {{ $service->name }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Text -->
                <div x-intersect="$el.classList.add('animate-item', 'slide-in-left')"
                    class="opacity-0 translate-x-10">

                    <p class="text-gray-600 text-lg leading-relaxed mb-4">
                        {!! $service->description !!}
                    </p>
                    @if (!empty($service->features))
                        <ul class="text-gray-600 text-lg space-y-2">
                            @foreach ($service->features as $feature)
                                <li><i class="fas fa-check-circle text-orange-500 mr-2"></i> {!! $feature !!}</li>
                            @endforeach
                        </ul>
                    @else

                    @endif
                </div>
                <!-- Image with Gold Gradient Border -->
                <div x-intersect="$el.classList.add('animate-item', 'slide-in-right')"
                    class="opacity-0 -translate-x-10 relative p-4">
                    <div class="gold-border"></div>
                    <img src="{{ $service->img ? Storage::url($service->img) : asset('images/service-details.jpg') }}"
                        alt="{{ $service->name }}"
                        class="w-full h-96 object-cover rounded-lg shadow-md relative z-10">
                </div>
            </div>
        </div>
    </section>

     <!-- Order Service Form Section -->
     <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
     class="bg-white py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
     <div class="container">
         <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
             اطلب الخدمة الآن
         </h2>
         <div class="max-w-2xl mx-auto relative border-2 border-gradient-gold rounded-lg p-8 shadow-lg">
             <!-- Form -->
             <div x-data="{
                 form: { name: '', email: '', phone: '', project_type: '{{ $service->slug }}', message: '', service_id: '{{ $service->id }}' },
                 submitted: false,
                 errors: {}
             }" @submit.prevent="
                 errors = {};
                 if (!form.name) errors.name = 'الاسم مطلوب';
                 if (!form.email || !form.email.includes('@')) errors.email = 'البريد الإلكتروني غير صالح';
                 if (!form.phone) errors.phone = 'رقم الهاتف مطلوب';
                 if (!form.project_type) errors.project_type = 'نوع المشروع مطلوب';
                 if (!form.message) errors.message = 'الرسالة مطلوبة';
                 if (Object.keys(errors).length === 0) {
                     fetch('/api/service-request', {
                         method: 'POST',
                         headers: { 'Content-Type': 'application/json' },
                         body: JSON.stringify(form)
                     }).then(response => {
                         if (response.ok) {
                             submitted = true;
                             form = { name: '', email: '', phone: '', project_type: '{{ $service->slug }}', message: '', service_id: '{{ $service->id }}' };
                         } else {
                             return response.json().then(data => {
                                 if (data.errors) {
                                     errors = { ...errors, ...data.errors };
                                 } else {
                                     errors.submit = 'حدث خطأ أثناء الإرسال';
                                 }
                             });
                         }
                     }).catch(() => {
                         errors.submit = 'حدث خطأ في الاتصال بالخادم';
                     });
                 }
             ">
                 <form class="space-y-6 p-3">
                     <!-- Hidden Service ID -->
                     <input type="hidden" x-model="form.service_id">
                     <!-- Name -->
                     <div>
                         <label for="name" class="block text-gray-900 font-semibold mb-2">الاسم</label>
                         <input id="name" type="text" x-model="form.name"
                             class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300"
                             :class="{ 'border-red-500': errors.name }">
                         <p x-show="errors.name" class="text-red-500 text-sm mt-1" x-text="errors.name"></p>
                     </div>
                     <!-- Email -->
                     <div>
                         <label for="email" class="block text-gray-900 font-semibold mb-2">البريد الإلكتروني</label>
                         <input id="email" type="email" x-model="form.email"
                             class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300"
                             :class="{ 'border-red-500': errors.email }">
                         <p x-show="errors.email" class="text-red-500 text-sm mt-1" x-text="errors.email"></p>
                     </div>
                     <!-- Phone -->
                     <div>
                         <label for="phone" class="block text-gray-900 font-semibold mb-2">رقم الهاتف</label>
                         <input id="phone" type="tel" x-model="form.phone"
                             class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300"
                             :class="{ 'border-red-500': errors.phone }">
                         <p x-show="errors.phone" class="text-red-500 text-sm mt-1" x-text="errors.phone"></p>
                     </div>
                     <!-- Project Type -->
                     {{-- <div>
                         <label for="project_type" class="block text-gray-900 font-semibold mb-2">نوع المشروع</label>
                         <select id="project_type" x-model="form.project_type"
                             class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300"
                             :class="{ 'border-red-500': errors.project_type }">
                             <option value="">اختر نوع المشروع</option>
                             <option value="{{ $service->slug }}" selected>{{ $service->name }}</option>
                             <option value="residential">سكني</option>
                             <option value="commercial">تجاري</option>
                             <option value="industrial">صناعي</option>
                         </select>
                         <p x-show="errors.project_type" class="text-red-500 text-sm mt-1" x-text="errors.project_type"></p>
                     </div> --}}
                     <!-- Message -->
                     <div>
                         <label for="message" class="block text-gray-900 font-semibold mb-2">رسالتك</label>
                         <textarea id="message" x-model="form.message" rows="5"
                             class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300"
                             :class="{ 'border-red-500': errors.message }"></textarea>
                         <p x-show="errors.message" class="text-red-500 text-sm mt-1" x-text="errors.message"></p>
                     </div>
                     <!-- Submit Button -->
                     <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale', 'animate-pulse-once')"
                         class="text-center opacity-0 scale-95">
                         <button type="submit"
                             class="px-8 py-4 bg-white text-black font-semibold rounded-md border border-gray-300 hover:bg-orange-500 hover:text-white transition-all duration-300">
                             إرسال الطلب
                         </button>
                     </div>
                 </form>
                 <!-- Success Message -->
                 <div x-show="submitted" x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="mt-6 text-center text-green-600 font-semibold">
                     تم إرسال طلبك بنجاح! سنتواصل معك قريبًا.
                 </div>
                 <!-- Error Message -->
                 <div x-show="errors.submit" class="mt-6 text-center text-red-500 font-semibold" x-text="errors.submit"></div>
             </div>
         </div>
     </div>
 </section>

    <!-- Related Services Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-orange-500">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
                خدمات أخرى
            </h2>
            @if ($relatedServices->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($relatedServices as $index => $relatedService)
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            :x-intersect:delay="{{ $index * 200 }}"
                            class="service-card bg-white rounded-lg shadow-md p-6 text-center opacity-0 scale-95 hover:scale-105 hover:shadow-xl transition-all duration-300">
                            <i class="{{ $service->icon ?? 'fas fa-cog' }} text-4xl text-orange-500 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $relatedService->name }}</h3>
                            <p class="text-gray-600 mb-4">{!! \Illuminate\Support\Str::limit(strip_tags($relatedService->description), 100) !!}</p>
                            <a href="{{ route('services.show', $relatedService->slug) }}"
                                class="text-blue-600 hover:underline">عرض المزيد</a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-600 py-8">
                    <p>لا توجد خدمات أخرى متاحة حاليًا</p>
                </div>
            @endif
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

        /* Gradient Border for Form */
        .border-gradient-gold {
            background: linear-gradient(to right, #FFD700, #FBBF24);
            padding: 2px;
        }

        .border-gradient-gold > * {
            background: white;
            border-radius: 0.5rem;
        }

        /* Parallax */
        .parallax-bg {
            will-change: transform;
        }

        /* Service Card Hover */
        .service-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        /* Form Input Focus */
        input:focus, textarea:focus, select:focus {
            outline: none;
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
            .service-image {
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
            .service-card:hover {
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
