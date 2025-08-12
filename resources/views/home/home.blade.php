<x-site-layout>
    <!-- Hero Image Slider -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[85vh] md:h-[89vh] opacity-0 translate-y-10 overflow-x-hidden">
        <div x-data='{
            slides: @json($sliders, JSON_UNESCAPED_SLASHES),
            currentSlide: 0,
            init() {
                if (this.slides.length > 0) {
                    setInterval(() => {
                        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                    }, 10000); // Change slide every 10 seconds
                }
            }
        }'
            class="relative h-full" wire:ignore>
            <!-- Debug -->
            <div x-show="false" x-text="JSON.stringify(slides)"></div>
            <!-- Slides -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentSlide === index"
                    class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000"
                    :class="{ 'opacity-100': currentSlide === index, 'opacity-0': currentSlide !== index }"
                    :style="{ 'background-image': `url(${slide.image})` }">
                    <!-- Dark Overlay -->
                    <div class="absolute inset-0" style="background: #173c4d78"></div>
                    <!-- Main Text with Fade-In Slide Effect -->
                    <div
                        class="absolute top-1/2  transform -translate-x-1/2 -translate-y-1/2 text-center text-white animate-text-slide-in" style="width: 100%">
                        <h1 class="text-4xl md:text-6xl font-bold" x-text="slide.text" style="text-align: center; width: 100%"></h1>
                    </div>
                    <!-- Description (Bottom Right) -->
                    <div class="absolute bottom-32 md:bottom-8 right-8 text-white max-w-sm animate-slide-in-right">
                        <p class="text-lg md:text-xl" x-text="slide.description"></p>
                    </div>
                    <!-- Explore Button (Bottom Left) -->
                    <div class="absolute bottom-8 left-8 animate-slide-in-left">
                        <a wire:navigate href="{{ route('about') }}"
                            class="inline-block px-6 py-3 bg-white text-black font-semibold rounded-md hover:bg-gray-200 transition-colors duration-300"
                            aria-label="home">
                            استكشف المزيد
                        </a>
                    </div>
                </div>
            </template>
            <div x-show="slides.length === 0"
                class="absolute inset-0 flex items-center justify-center text-white bg-gray-900">
                <p>لا توجد صور متاحة</p>
            </div>
        </div>
    </section>


    {{-- Partners Section --}}
    <section x-data="{
        pause: false,
        direction: 'right-to-left',
        toggleDirection() {
            console.log('Toggling direction from:', this.direction);
            this.direction = this.direction === 'right-to-left' ? 'left-to-right' : 'right-to-left';
        }
    }" class="relative bg-gradient-to-b from-gray-900 to-gray-800 py-12 overflow-hidden"
        style="background-image: url({{ asset('pattern.jpg') }}); background-size: 100px 100px;">
        <div class="container mx-auto px-4 text-center">
            <!-- Title -->
            <h2
                class="text-3xl md:text-4xl font-bold text-black mb-10 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                شركاؤنا
            </h2>

            <!-- Slider -->
            <div class="relative overflow-hidden">
                <div x-ref="track" @mouseenter="pause = true" @mouseleave="pause = false" @touchstart="pause = true"
                    @touchend="pause = false"
                    :class="{
                        'animate-slide-right-to-left': direction === 'right-to-left' && !pause,
                        'animate-slide-left-to-right': direction === 'left-to-right' && !pause
                    }"
                    class="flex w-max gap-8 md:gap-12">
                    <!-- Triplicate content for seamless looping -->
                    @foreach ([1, 2, 3] as $cycle)
                        @foreach ($partners as $index => $partner)
                            <div class="flex-shrink-0">
                                <img src="{{ Storage::url($partner->img) }}" alt="{{ $partner->name ?? 'Partner' }}"
                                    class="w-full max-w-[100px] sm:max-w-[140px] md:max-w-32 lg:max-w-32 h-full rounded-md border grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300"
                                    :class="{
                                        'rounded-tl-3xl rounded-br-3xl rounded-tr-md rounded-bl-md': '{{ $index % 2 }}'
                                        === '0',
                                        'rounded-tr-3xl rounded-bl-3xl rounded-tl-md rounded-br-md': '{{ $index % 2 }}'
                                        !== '0'
                                    }">
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <style>
        /* CSS animations for bidirectional scrolling */
        .animate-slide-right-to-left {
            animation: slide-right-to-left 20s linear infinite;
        }

        .animate-slide-left-to-right {
            animation: slide-left-to-right 20s linear infinite;
        }

        @keyframes slide-right-to-left {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-33.333%);
            }

            /* Move by 1/3 due to triplicated content */
        }

        @keyframes slide-left-to-right {
            0% {
                transform: translateX(-33.333%);
            }

            100% {
                transform: translateX(0);
            }
        }

        /* Pause animation when needed */
        [x-ref="track"] {
            will-change: transform;
        }
    </style>

    <script>
        // JavaScript to toggle direction at the end of each animation cycle
        document.addEventListener('alpine:init', () => {
            Alpine.data('slider', () => ({
                pause: false,
                direction: 'right-to-left',
                init() {
                    console.log('Slider initialized'); // Debug
                    const track = this.$refs.track;
                    if (!track) {
                        console.error('Track not found');
                        return;
                    }
                    track.addEventListener('animationiteration', () => {
                        if (!this.pause) {
                            console.log('Animation iteration, toggling direction'); // Debug
                            this.direction = this.direction === 'right-to-left' ?
                                'left-to-right' : 'right-to-left';
                        }
                    });
                }
            }));
        });
    </script>
    <!-- Video Section -->
    {{-- <section x-intersect="$el.classList.add('animate-section', 'fade-in-scale')"
        class="relative h-screen max-h-[100vh] bg-gray-900 opacity-0 scale-95">
        <video x-ref="video" class="w-full h-full object-cover" autoplay muted loop playsinline loading="lazy">
            <source src="{{ asset('videos/intro.mp4') }}" type="video/mp4">
            متصفحك لا يدعم تشغيل الفيديو.
        </video>

        <div x-data="{ isMuted: true }" class="absolute bottom-4 right-4 z-10">
            <button @click="isMuted = !isMuted; $refs.video.muted = isMuted"
                class="flex items-center justify-center w-12 h-12 bg-orange-500 text-white rounded-full hover:bg-orange-600 transition-all duration-300 focus:outline-none"
                :class="{ 'bg-orange-600': !isMuted }" aria-label="mute">
                <i x-show="isMuted" class="fas fa-volume-mute text-xl"></i>
                <i x-show="!isMuted" class="fas fa-volume-up text-xl"></i>
            </button>
        </div>
    </section> --}}

   {{-- Project Steps Section --}}
    @php
        $index = 0;
    @endphp
    <section x-data="cardSlider({{ Js::from($steps) }})" x-init="init()" @resize.window="updateSlider()"
        class="relative py-20 bg-fixed bg-center bg-cover opacity-0 translate-y-10 animate-section fade-in-slide-up"
        style="background-image: url('{{ asset('images/sections/Project hero.jpg') }}')"
        x-intersect="$el.classList.add('opacity-100', 'translate-y-0')" dir="rtl">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-white bg-opacity-60 backdrop-blur-sm"></div>

        <div class="container relative z-10 px-4 md:px-6">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-center text-gray-900 mb-14">
                مراحل تطوير المشروع العقاري في بن نازح
            </h2>

            <!-- Slider -->
            <div class="relative overflow-hidden" x-ref="slider">
                <div class="flex w-max gap-6 md:gap-8 transition-transform duration-300 ease-out"
                    :style="`transform: translateX(${translateX}px)`" x-ref="track" style="direction: ltr;">
                    <!-- Duplicate steps for seamless looping -->
                    <template x-for="cycle in [1, 2, 3]" :key="cycle">
                        <template x-for="(step, stepIndex) in steps" :key="stepIndex">
                            <div class="flex-shrink-0 w-[280px] md:w-[320px] text-center bg-white bg-opacity-80 rounded-lg p-6 shadow-md transition-transform duration-300"
                                :class="{
                                    'scale-105 z-10': isActive(stepIndex, cycle),
                                    'scale-95 opacity-80': !isActive(stepIndex, cycle),
                                    'rounded-tl-3xl rounded-br-3xl rounded-tr-md rounded-bl-md': '{{ $index % 2 }}' === '0',
                                    'rounded-tr-3xl rounded-bl-3xl rounded-tl-md rounded-br-md': '{{ $index % 2 }}' !== '0'
                                }">
                                <div class="flex items-center justify-center mb-4">
                                    <div
                                        class="w-16 h-16 bg-orange-500 text-white flex items-center justify-center rounded-full text-2xl">
                                        <i :class="`fas ${step.icon}`"></i>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2" x-text="step.name"></h3>
                                <p class="text-gray-600 text-base leading-relaxed" style="text-align: justify;"
                                    x-text="step.description"></p>
                            </div>
                        </template>
                    </template>
                </div>
            </div>

            <!-- Dots -->
            <div class="flex justify-center mt-10 space-x-2 space-x-reverse">
                <template x-for="(step, index) in steps" :key="index">
                    <button @click="goToCard(index)"
                        :class="{
                            'bg-orange-500 w-4 h-4': Math.abs(currentIndex % steps.length - index) < 0.5,
                            'bg-gray-400 w-3 h-3': Math.abs(currentIndex % steps.length - index) >= 0.5
                        }"
                        class="rounded-full transition-all duration-300 focus:outline-none"></button>
                </template>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cardSlider', (steps) => ({
                steps: steps,
                currentIndex: steps.length, // Start in the second cycle
                cardWidth: 280, // Default for mobile
                gap: 24, // Gap between cards (6 * 4 for rem to px)
                translateX: 0,
                isDragging: false,
                startX: 0,
                startTranslateX: 0,
                velocity: 0,
                lastTime: 0,
                autoSlideInterval: null,

                init() {
                    this.updateSlider();
                    this.startAutoSlide();
                },

                updateSlider() {
                    const slider = this.$refs.slider;
                    const track = this.$refs.track;
                    this.cardWidth = window.innerWidth >= 768 ? 320 : 280; // Adjust for md breakpoint
                    this.gap = window.innerWidth >= 768 ? 32 : 24; // Adjust gap for md breakpoint
                    this.translateX = this.currentIndex * (this.cardWidth + this.gap);
                    track.style.transform = `translateX(${this.translateX}px)`;
                    this.snapToNearestCard();
                },

                isActive(stepIndex, cycle) {
                    const totalSteps = this.steps.length;
                    const offset = (cycle - 1) * totalSteps;
                    const normalizedIndex = (stepIndex + offset) % totalSteps;
                    return Math.abs(this.currentIndex % totalSteps - normalizedIndex) < 0.5;
                },

                startDrag(event) {
                    this.isDragging = true;
                    this.startX = event.pageX || (event.touches && event.touches[0].pageX);
                    this.startTranslateX = this.translateX;
                    this.velocity = 0;
                    this.lastTime = Date.now();
                    this.stopAutoSlide();
                    this.$refs.track.style.transition = 'none';
                },

                handleDrag(event) {
                    if (!this.isDragging) return;
                    event.preventDefault(); // Prevent text selection on drag
                    const currentX = event.pageX || (event.touches && event.touches[0].pageX);
                    const diff = this.startX - currentX; // Positive diff means drag left (visual right in RTL)
                    this.translateX = this.startTranslateX + diff; // RTL: drag left increases translateX
                    this.$refs.track.style.transform = `translateX(${this.translateX}px)`;

                    // Calculate velocity for inertia
                    const currentTime = Date.now();
                    const timeDelta = currentTime - this.lastTime;
                    if (timeDelta > 0) {
                        this.velocity = (diff / timeDelta) * 1000; // Pixels per second
                        this.lastTime = currentTime;
                    }
                },

                endDrag() {
                    if (!this.isDragging) return;
                    this.isDragging = false;
                    this.$refs.track.style.transition = 'transform 0.3s ease-out';

                    // Apply inertia
                    const inertia = this.velocity * 0.1; // Adjust multiplier for inertia strength
                    this.translateX += inertia;
                    this.snapToNearestCard();

                    this.startAutoSlide();
                },

                snapToNearestCard() {
                    const totalSteps = this.steps.length;
                    const cardDistance = this.cardWidth + this.gap;
                    this.currentIndex = Math.round(this.translateX / cardDistance);

                    // Handle seamless looping
                    if (this.currentIndex < 0) {
                        this.currentIndex = totalSteps * 2 - 1; // Move to last card of second cycle
                        this.translateX = this.currentIndex * cardDistance;
                        this.$refs.track.style.transition = 'none';
                        this.$refs.track.style.transform = `translateX(${this.translateX}px)`;
                        this.$nextTick(() => {
                            this.$refs.track.style.transition = 'transform 0.3s ease-out';
                        });
                    } else if (this.currentIndex >= totalSteps * 2) {
                        this.currentIndex = totalSteps; // Move to start of second cycle
                        this.translateX = this.currentIndex * cardDistance;
                        this.$refs.track.style.transition = 'none';
                        this.$refs.track.style.transform = `translateX(${this.translateX}px)`;
                        this.$nextTick(() => {
                            this.$refs.track.style.transition = 'transform 0.3s ease-out';
                        });
                    } else {
                        this.translateX = this.currentIndex * cardDistance;
                        this.$refs.track.style.transform = `translateX(${this.translateX}px)`;
                    }
                },

                nextCard() {
                    this.currentIndex++; // Reversed direction: increment instead of decrement
                    this.translateX = this.currentIndex * (this.cardWidth + this.gap);
                    this.snapToNearestCard();
                },

                goToCard(index) {
                    this.currentIndex = index + this.steps.length; // Start in second cycle
                    this.translateX = this.currentIndex * (this.cardWidth + this.gap);
                    this.$refs.track.style.transform = `translateX(${this.translateX}px)`;
                    this.snapToNearestCard();
                },

                startAutoSlide() {
                    if (!this.autoSlideInterval) {
                        this.autoSlideInterval = setInterval(() => {
                            this.nextCard();
                        }, 8000); // Auto-slide every 8 seconds
                    }
                },

                stopAutoSlide() {
                    if (this.autoSlideInterval) {
                        clearInterval(this.autoSlideInterval);
                        this.autoSlideInterval = null;
                    }
                }
            }));
        });
    </script>


    <!-- Services Section -->
    {{-- <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative py-16  opacity-0 translate-y-10 bg-no-repeat bg-cover
                    bg-fixed parallax-bg"
        style="background-image: url('{{ asset('images/sections/Project hero.jpg') }}')">
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
                    cardCount: {{ count($services) }},
                    cardsPerView: 3,
                    maxIndex() { return this.cardCount - this.cardsPerView; },
                    next() { if (this.currentIndex < this.maxIndex()) this.currentIndex++; },
                    prev() { if (this.currentIndex > 0) this.currentIndex--; }
                }" class="overflow-hidden">
                    <!-- Slider Container -->
                    <div class="flex transition-transform duration-500"
                        :style="{ 'transform': `translateX(-${currentIndex * cardWidth}px)` }">
                        @foreach ($services as $index => $service)
                            <div x-intersect="$el.classList.add('animate-item', 'slide-in-up')"
                                :x-intersect:delay="{{ $index * 200 }}"
                                class="service-card flex-shrink-0 w-80 bg-white rounded-lg shadow-lg p-6 text-center mx-3 opacity-0 translate-y-10">
                                <i class="{{ $service->icon }} text-4xl text-gray-900 mb-4"></i>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $service->name }}</h3>
                                <p class="text-gray-600 mb-4">{!! \Illuminate\Support\Str::limit(strip_tags($service->description), 100) !!}</p>
                                <a href="{{ route('services.show', $service->slug) }}"
                                    class="text-blue-600 hover:underline" aria-label="service {{ $service->slug }}">عرض
                                    المزيد</a>
                            </div>
                        @endforeach
                    </div>
                    <!-- Navigation Arrows -->
                    <button x-on:click="prev()" x-bind:class="{ 'opacity-50 cursor-not-allowed': currentIndex === 0 }"
                        class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-3 shadow-lg text-gray-900 hover:bg-gray-200"
                        aria-label="prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button x-on:click="next()"
                        x-bind:class="{ 'opacity-50 cursor-not-allowed': currentIndex >= maxIndex() }"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-3 shadow-lg text-gray-900 hover:bg-gray-200"
                        aria-label="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section> --}}

  <!-- Projects Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative bg-gradient-to-b from-gray-900 to-gray-800 py-16 opacity-0 translate-y-10" dir="rtl">
        <div class="container px-4 md:px-6">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-white text-center mb-12">مشاريعنا</h2>
            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($projects as $index => $project)
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                        x-intersect:delay="{{ ($index % 3) * 200 }}"
                        class="project-card bg-white shadow-md hover:shadow-2xl hover:scale-105 transition-all duration-300 overflow-hidden material-card"
                        :class="{
                            'rounded-tl-3xl rounded-br-3xl rounded-tr-md rounded-bl-md': '{{ $index % 2 }}' === '0',
                            'rounded-tr-3xl rounded-bl-3xl rounded-tl-md rounded-br-md': '{{ $index % 2 }}' !== '0'
                        }">
                        <!-- Image -->
                        <div class="relative">
                            <img src="{{ $project->img ? Storage::url($project->img) : asset('images/coming-soon.jpg') }}"
                                alt="{{ $project->name }}"
                                class="w-full h-64 object-cover rounded-t-inherit hover:scale-105 transition-all duration-300">
                            <!-- Status Badge -->
                            @if ($project->status === 'sold')
                                <div class="absolute z-50 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45">
                                    <img src="{{ asset('sell.png') }}" alt="مباع" class="w-60 h-60 object-contain">
                                </div>
                            @else
                                  <div class="absolute z-50 top-4 left-4 w-[50%] h-auto mb-4 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden" dir="ltr">
                                    <div class="h-full transition-all duration-300 ext-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full bg-orange-500"

                                         style="width:
                                    {{ $project->status_percent }}%">{{ $project->status_percent }}%</div>

                                </div>
                            @endif
                        </div>
                        <!-- Details -->
                        <div class="p-6 flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900">
                                @isset($project->logo)
                                    <img src="{{ Storage::url($project->logo) }}" class="h-16" alt="{{ $project->name }}">
                                @else
                                    {{ $project->name }}
                                @endisset
                            </h3>
                            <a wire:navigate href="{{ route('projects.show', $project->slug) }}"
                                class="inline-block px-4 py-2 bg-black text-white text-sm font-semibold rounded-md hover:bg-orange-500 transition-all duration-300">
                                عرض التفاصيل
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Explore More Button -->
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-slide-up')" x-intersect:delay="600"
                class="text-center mt-6 md:mt-12 opacity-0 translate-y-10">
                <a wire:navigate href="{{ route('project-categories') }}"
                    class="inline-block px-8 py-4 secondary-bg text-white font-semibold rounded-md hover:bg-orange-800 transition-colors duration-300"
                    aria-label="projects">
                    اكتشف المزيد من المشاريع
                </a>
            </div>
        </div>
    </section>
    <!-- Guarantees Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">الضمانات</h2>
            <!-- Guarantees Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($facilities as $index => $facility)
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                        :x-intersect:delay="{{ $index * 200 }}"
                        class="relative flex items-start bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 p-6 opacity-0 scale-95 guarantee-item border border-orange-500">
                        <i class="{{ $facility->icon }} text-4xl text-gray-900 mr-4"></i>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $facility->title }}</h3>
                            <p class="text-gray-600">{{ $facility->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gradient-to-b from-gray-900 to-gray-800 py-8 sm:py-4 lg:py-6 opacity-0 translate-y-10 overflow-x-hidden px-4">
        <div class="custom-container overflow-hidden mx-4 mb-4">
            <!-- Title -->
            <h2
                class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white text-center mb-8 sm:mb-10 lg:mb-12">
                آراء العملاء
            </h2>

            <!-- Reviews Slider -->
            <div dir="ltr"
                x-data='{
            reviews: @json($reviews, JSON_UNESCAPED_SLASHES),
            currentIndex: 0,
            reviewsPerPage: window.innerWidth < 640 ? 1 : window.innerWidth < 1024 ? 2 : 3,
            cardWidth: window.innerWidth < 640 ? window.innerWidth * 0.9 : window.innerWidth < 1024 ? window.innerWidth * 0.45 : 320,
            pause: false,
            maxIndex() { return Math.ceil(this.reviews.length / this.reviewsPerPage) - 1; },
            next() { this.currentIndex = (this.currentIndex + 1) % (this.maxIndex() + 1); },
            init() {
                if (this.reviews.length > 0) {
                    setInterval(() => {
                        if (!this.pause) {
                            this.next();
                        }
                    }, 5000);
                }
                window.addEventListener("resize", () => {
                    this.reviewsPerPage = window.innerWidth < 640 ? 1 : window.innerWidth < 1024 ? 2 : 3;
                    this.cardWidth = window.innerWidth < 640 ? window.innerWidth * 0.9 : window.innerWidth < 1024 ? window.innerWidth * 0.45 : 320;
                });
            }
        }'
                class="relative review-slider" @mouseenter="pause = true" @mouseleave="pause = false"
                @touchstart="pause = true" @touchend="pause = false" wire:ignore>

                <!-- Slider or Grid Container -->
                <div x-show="reviews.length > 3" class="flex transition-transform duration-500 flex-nowrap"
                    :style="{ 'transform': `translateX(-${currentIndex * cardWidth * reviewsPerPage}px)` }">
                    <template x-for="(review, index) in reviews" :key="index">
                        <div x-intersect="$el.classList.add('animate-item', 'slide-in-up')"
                            :x-intersect:delay="index % reviewsPerPage * 200"
                            class="flex-shrink-0 w-[90vw] sm:w-[45vw] lg:w-80 bg-white rounded-lg shadow-md p-4 sm:p-6 text-center mx-2 sm:mx-3 opacity-0 translate-y-10 material-card"
                            :class="{
                                'rounded-tl-3xl rounded-br-3xl rounded-tr-md rounded-bl-md': index % 2 ===
                                    0,
                                'rounded-tr-3xl rounded-bl-3xl rounded-tl-md rounded-br-md': index % 2 !== 0
                            }">
                            <img :src="review.icon" alt="Reviewer"
                                class="w-12 h-12 sm:w-16 sm:h-16 rounded-full mx-auto mb-4 object-cover">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2" x-text="review.name"></h3>
                            {{-- <p class="text-sm sm:text-base text-gray-600 italic mb-2" x-text="review.title"></p> --}}
                            <p class="text-sm sm:text-base text-gray-700" x-text="review.description"></p>
                        </div>
                    </template>
                </div>

                <!-- Grid for 3 or fewer reviews -->
                <div x-show="reviews.length <= 3"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    <template x-for="(review, index) in reviews" :key="index">
                        <div x-intersect="$el.classList.add('animate-item', 'slide-in-up')"
                            :x-intersect:delay="index * 200"
                            class="w-full bg-white rounded-lg shadow-md p-4 sm:p-6 text-center opacity-0 translate-y-10 material-card"
                            :class="{
                                'rounded-tl-3xl rounded-br-3xl rounded-tr-md rounded-bl-md': index % 2 ===
                                    0,
                                'rounded-tr-3xl rounded-bl-3xl rounded-tl-md rounded-br-md': index % 2 !== 0
                            }">
                            <img :src="review.icon" alt="Reviewer"
                                class="w-12 h-12 sm:w-16 sm:h-16 rounded-full mx-auto mb-4 object-cover">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2" x-text="review.name"></h3>
                            {{-- <p class="text-sm sm:text-base text-gray-600 italic mb-2" x-text="review.title"></p> --}}
                            <p class="text-sm sm:text-base text-gray-700" x-text="review.description"></p>
                        </div>
                    </template>
                </div>

                <!-- Navigation Dots (only for slider) -->
                <div x-show="reviews.length > 3" x-intersect="$el.classList.add('animate-item', 'fade-in-slide-up')"
                    x-intersect:delay="600"
                    class="flex justify-center mt-6 space-x-2 space-x-reverse opacity-0 translate-y-10">
                    <template x-for="index in Math.ceil(reviews.length / reviewsPerPage)" :key="index">
                        <span @click="currentIndex = index - 1"
                            class="w-3 h-3 rounded-full cursor-pointer transition-colors duration-300"
                            :class="{ 'bg-gray-900': currentIndex === index - 1, 'bg-gray-300': currentIndex !== index - 1 }"></span>
                    </template>
                </div>

                <!-- Fallback Message -->
                <div x-show="reviews.length === 0" class="text-center text-gray-300 py-8">
                    <p>لا توجد آراء متاحة</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Features Section (Counters) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10" dir="rtl">
        <div class="container px-4 sm:px-6">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">احصائياتنا</h2>
            <!-- Features Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($counters as $index => $counter)
                    <div x-intersect.once="$el.classList.add('animate-item', 'fade-in-scale'); $dispatch('start-count', { id: $el.id })"
                        id="feature-{{ $index + 1 }}" x-data="{ count: 0 }"
                        x-on:start-count.window="if ($event.detail.id === 'feature-{{ $index + 1 }}') { let start = 0; const end = parseInt($el.dataset.count); const duration = 1000; const interval = duration / end; const timer = setInterval(() => { if (start < end) { start++; count = start; } else { clearInterval(timer); } }, interval); }"
                        class="bg-white rounded-lg shadow-md hover:shadow-2xl hover:scale-105 p-6 text-center opacity-0 scale-95 transition-all duration-300"
                        data-count="{{ $counter->value }}">
                        <div
                            class="flex md:flex-col items-center md:items-center justify-center md:justify-start space-x-3 md:space-x-0 md:space-y-4">
                            <i class="{{ $counter->icon }} px-2 text-3xl sm:text-4xl text-gray-900"></i>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900">{{ $counter->name }}</h3>
                        </div>
                        <p class="text-2xl sm:text-3xl font-semibold text-orange-500 mt-4" x-text="count"></p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Blogs Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">المدونات</h2>
            <!-- Blogs Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($blogs as $index => $blog)
                    <div x-intersect="$el.classList.add('animate-item', 'slide-in-up')"
                        :x-intersect:delay="{{ $index * 200 }}"
                        class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 opacity-0 translate-y-10 material-card"
                        :class="{
                            'rounded-tl-3xl rounded-br-3xl rounded-tr-md rounded-bl-md': '{{ $index % 2 }}'
                            === '0',
                            'rounded-tr-3xl rounded-bl-3xl rounded-tl-md rounded-br-md': '{{ $index % 2 }}'
                            !== '0'
                        }">
                        <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}"
                            class="w-full h-48 object-cover rounded-t-lg blog-image">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $blog->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ $blog->created_at->format('d F Y') }}</p>
                            <p class="text-gray-700 mb-4" style="text-align: justify">{!! \Illuminate\Support\Str::limit(strip_tags($blog->introduction), 100) !!}</p>
                            <a wire:navigate href="{{ route('blogs.show', $blog->slug) }}"
                                class="inline-block px-6 py-3 bg-orange-500 text-white font-semibold rounded-md border border-gray-300 hover:bg-orange-500 hover:text-white transition-colors duration-300"
                                aria-label="blog {{ $blog->slug }}">
                                استكشف
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- View All Button -->
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-slide-up')" x-intersect:delay="600"
                class="text-center mt-12 opacity-0 translate-y-10">
                <a wire:navigate href="{{ route('blogs.index') }}"
                    class="inline-block px-8 py-4 bg-black text-white font-semibold rounded-md hover:bg-gray-800 transition-colors duration-300"
                    aria-label="blogs">
                    عرض الكل
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

        @keyframes continuous-slide {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
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
                transform: translateY(10px);
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

        @keyframes spin {
            to {
                transform: rotate(360deg);
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

        .animate-section.fade-in-slide-up {
            animation: fade-in-slide-up 0.7s ease-out forwards;
        }

        .animate-section.slide-in-left {
            animation: slide-in-left 0.7s ease-out forwards;
        }

        .animate-section.fade-in-scale {
            animation: fade-in-scale 0.7s ease-out forwards;
        }

        .animate-item.slide-in-up {
            animation: slide-in-up 0.7s ease-out forwards;
        }

        .animate-item.slide-in-left {
            animation: slide-in-left 0.7s ease-out forwards;
        }

        .animate-item.slide-in-right {
            animation: slide-in-right 0.7s ease-out forwards;
        }

        .animate-item.fade-in-scale {
            animation: fade-in-scale 0.7s ease-out forwards;
        }

        .animate-item.fade-in-slide-up {
            animation: fade-in-slide-up 0.7s ease-out forwards;
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        .service-card:hover,
        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        /* RTL Adjustments */
        [dir="rtl"] .slider-container {
            direction: ltr;
            /* Ensure transform works consistently */
        }

        [dir="rtl"] .project-badge {
            left: auto;
            right: 1rem;
            /* Adjust badge position in RTL */
        }

        [dir="rtl"] .guarantee-item .fas {
            margin-right: 0;
            margin-left: 1rem;
            /* Adjust icon spacing in RTL */
        }

        [dir="rtl"] .review-slider {
            direction: ltr;
            /* Ensure slider direction consistency */
        }

        [dir="rtl"] .slide-in-left {
            animation: slide-in-right 0.7s ease-out forwards;
            /* Reverse for RTL */
        }

        [dir="rtl"] .slide-in-right {
            animation: slide-in-left 0.7s ease-out forwards;
            /* Reverse for RTL */
        }

        [dir="rtl"] .fa-map-marker-alt,
        [dir="rtl"] .fa-phone,
        [dir="rtl"] .fa-envelope {
            margin-right: 0;
            margin-left: 0.5rem;
            /* Adjust icon spacing in RTL */
        }

        [dir="rtl"] .blog-image {
            border-top-right-radius: 0;
            border-top-left-radius: 0.5rem;
            /* Adjust image border radius in RTL */
        }

        /* material card */
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

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .blog-image {
                height: 10rem;
                /* Smaller image height on mobile */
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
        }
    </style>

    <!-- Alpine.js Intersection Observer -->
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
                            if (el.hasAttribute('x-intersect.once')) {
                                observer.unobserve(el);
                            }
                        }
                    });
                }, {
                    threshold: 0.1
                });
                observer.observe(el);
                cleanup(() => observer.disconnect());
            });
        });
    </script>
</x-site-layout>
