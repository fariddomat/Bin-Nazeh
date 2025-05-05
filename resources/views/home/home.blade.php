<x-site-layout>
    <!-- Hero Image Slider -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[89vh] opacity-0 translate-y-10 overflow-x-hidden">
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
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-white animate-text-slide-in">
                        <h1 class="text-4xl md:text-6xl font-bold" x-text="slide.text"></h1>
                    </div>
                    <!-- Description (Bottom Right) -->
                    <div class="absolute bottom-8 right-8 text-white max-w-sm animate-slide-in-right">
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
        offset: 0,
        pause: false,
        scrollWidth: 0,
        track: null,
        shouldScroll: {{ count($partners) > 6 ? 'true' : 'false' }},
        start() {
            if (!this.shouldScroll) return;

            this.track = this.$refs.track;
            this.scrollWidth = this.track.scrollWidth / 2;

            const move = () => {
                if (!this.pause) {
                    this.offset += 0.5; // Slower, smoother scroll
                    if (this.offset >= this.scrollWidth) {
                        this.offset = 0;
                    }
                    this.track.style.transform = `translateX(-${this.offset}px)`;
                }
                requestAnimationFrame(move);
            };
            move();
        }
    }" x-init="start()" class="bg-gradient-to-b from-gray-900 to-gray-800 py-16 overflow-hidden">
        <div class="container mx-auto px-4 text-center">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-12 tracking-tight transition-all duration-500 ease-in-out transform hover:scale-105">
                شركاؤنا
            </h2>

            <div class="relative overflow-hidden w-full">
                <div x-ref="track"
                     @mouseenter="pause = true"
                     @mouseleave="pause = false"
                     class="flex justify-self-center w-max will-change-transform transition-transform duration-300 ease-out"
                     :class="{ 'justify-center flex-wrap gap-8': !shouldScroll, 'gap-12': shouldScroll }"
                     :style="shouldScroll ? `transform: translateX(-${offset}px)` : ''">
                    @if (count($partners) > 6)
                        <!-- Repeat logos twice for infinite scroll -->
                        @for ($i = 0; $i < 2; $i++)
                            @foreach ($partners as $partner)
                                <img src="{{ Storage::url($partner->img) }}"
                                     alt="{{ $partner->name ?? 'Partner' }}"
                                     class="w-40 md:w-48 h-16 mx-4 object-contain grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300">
                            @endforeach
                        @endfor
                    @else
                        <!-- Show logos statically, centered -->
                        @foreach ($partners as $partner)
                            <img src="{{ Storage::url($partner->img) }}"
                                 alt="{{ $partner->name ?? 'Partner' }}"
                                 class="w-40 md:w-72 h-40 md:h-72 mx-4 rounded-md grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300">
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-scale')"
        class="relative h-screen bg-gray-900 opacity-0 scale-95">
        <video x-ref="video" class="w-full h-full object-cover" autoplay muted loop playsinline loading="lazy">
            <source src="{{ asset('videos/intro.mp4') }}" type="video/mp4">
            متصفحك لا يدعم تشغيل الفيديو.
        </video>

        <!-- Mute/Unmute Button -->
        <div x-data="{ isMuted: true }" class="absolute bottom-4 right-4 z-10">
            <button @click="isMuted = !isMuted; $refs.video.muted = isMuted"
                class="flex items-center justify-center w-12 h-12 bg-orange-500 text-white rounded-full hover:bg-orange-600 transition-all duration-300 focus:outline-none"
                :class="{ 'bg-orange-600': !isMuted }" aria-label="mute">
                <i x-show="isMuted" class="fas fa-volume-mute text-xl"></i>
                <i x-show="!isMuted" class="fas fa-volume-up text-xl"></i>
            </button>
        </div>
    </section>

    {{-- Project Steps Section --}}
    <section x-data="stepSlider({{ Js::from($steps) }})" x-init="init()" @resize.window="updateChunking()"
        @mouseenter="stopAutoSlide()" @mouseleave="startAutoSlide()"
        class="relative py-20 bg-fixed bg-center bg-cover opacity-0 translate-y-10 animate-section fade-in-slide-up"
        style="background-image: url('{{ asset('images/sections/Project hero.jpg') }}')"
        x-intersect="$el.classList.add('opacity-100', 'translate-y-0')">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-white bg-opacity-60 backdrop-blur-sm"></div>

        <div class="container relative z-10">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-center text-gray-900 mb-14">
                مراحل تطوير المشروع العقاري في بن نازح
            </h2>

            <!-- Step Groups -->
            <div class="relative">
                <template x-for="(group, index) in chunkedSteps" :key="index">
                    <div x-show="currentChunk === index" x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-500"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="grid gap-8 sm:grid-cols-1 md:grid-cols-3">
                        <template x-for="(step, stepIndex) in group" :key="stepIndex">
                            <div class="text-center bg-white bg-opacity-80 rounded-lg p-6 shadow-md">
                                <div class="flex items-center justify-center mb-4">
                                    <div
                                        class="w-16 h-16 bg-orange-500 text-white flex items-center justify-center rounded-full text-2xl">
                                        <i :class="`fas ${step.icon}`"></i>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2" x-text="step.name"></h3>
                                <p class="text-gray-600 text-base leading-relaxed" x-text="step.description"></p>
                            </div>
                        </template>
                    </div>
                </template>

                <!-- Navigation Arrows -->
                <div class="absolute top-1/2 left-0 transform -translate-y-1/2 z-20">
                    <button @click="prevChunk"
                        class="bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700 transition">
                        <i class="fas fa-chevron-right transform rotate-180"></i>
                    </button>
                </div>
                <div class="absolute top-1/2 right-0 transform -translate-y-1/2 z-20">
                    <button @click="nextChunk"
                        class="bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700 transition">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <!-- Dots -->
            <div class="flex justify-center mt-10 space-x-2">
                <template x-for="(group, index) in chunkedSteps" :key="index">
                    <button @click="currentChunk = index"
                        :class="{
                            'bg-orange-500 w-4 h-4': currentChunk === index,
                            'bg-gray-400 w-3 h-3': currentChunk !== index
                        }"
                        class="rounded-full transition-all duration-300 focus:outline-none"></button>
                </template>
            </div>
        </div>
    </section>

    <!-- Alpine.js Script -->
    <script>
        function stepSlider(stepsFromLaravel) {
            return {
                steps: stepsFromLaravel,
                chunkedSteps: [],
                currentChunk: 0,
                interval: null,
                init() {
                    this.updateChunking();
                    this.startAutoSlide();
                },
                updateChunking() {
                    const chunkSize = window.innerWidth >= 768 ? 3 : 1;
                    this.chunkedSteps = [];
                    for (let i = 0; i < this.steps.length; i += chunkSize) {
                        this.chunkedSteps.push(this.steps.slice(i, i + chunkSize));
                    }
                    this.currentChunk = 0;
                },
                startAutoSlide() {
                    this.interval = setInterval(() => {
                        this.nextChunk();
                    }, 8000);
                },
                stopAutoSlide() {
                    clearInterval(this.interval);
                    this.interval = null;
                },
                nextChunk() {
                    this.currentChunk = (this.currentChunk + 1) % this.chunkedSteps.length;
                },
                prevChunk() {
                    this.currentChunk = (this.currentChunk - 1 + this.chunkedSteps.length) % this.chunkedSteps.length;
                }
            };
        }
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
        class="bg-gradient-to-b from-gray-900 to-gray-800 g bg py-16 opacity-0 translate-y-10">
        <div class="container">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-white text-center mb-12">مشاريعنا</h2>
            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($projects as $index => $project)
                    <div x-intersect="$el.classList.add('animate-item', '{{ $index % 2 === 0 ? 'slide-in-left' : 'slide-in-right' }}')"
                        :x-intersect:delay="{{ $index * 200 }}"
                        class="relative bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 opacity-0 {{ $index % 2 === 0 ? 'translate-x-10' : '-translate-x-10' }}">
                        <!-- Image -->
                        <div class="relative">
                            <img src="{{ Storage::url($project->img) }}" alt="{{ $project->name }}"
                                class="w-full h-48 object-cover rounded-t-lg">
                            <!-- Status Badge -->
                            <span class="absolute z-50 top-4 left-4 px-2 py-1 rounded text-white text-sm font-semibold"
                                :class="{
                                    'bg-gray-500': '{{ $project->status }}'
                                    === 'not_started',
                                    'bg-orange-500': '{{ $project->status }}'
                                    === 'pending',
                                    'bg-green-500': '{{ $project->status }}'
                                    === 'done'
                                }">
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
                                @endswitch
                            </span>
                            <!-- Sold Overlay (Conditional) -->
                            <div x-data="{ isSold: {{ $project->is_sold ? 'true' : 'false' }} }" x-show="isSold"
                                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-t-lg">
                                <span class="text-white text-2xl font-bold">تم البيع</span>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $project->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $project->projectCategory->name }}</p>
                            <a wire:navigate href="{{ route('projects.show', $project->slug) }}"
                                class="inline-block px-6 py-3 bg-orange-500 text-white font-semibold rounded-md border border-orange-300 hover:bg-orange-800 transition-colors duration-300"
                                aria-label="project {{ $project->slug }}">
                                استكشف
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Explore More Button -->
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-slide-up')" x-intersect:delay="600"
                class="text-center mt-12 opacity-0 translate-y-10">
                <a wire:navigate href="{{ route('project-categories') }}"
                    class="inline-block px-8 py-4 secondary-bg text-white font-semibold rounded-md hover:bg-orange-800 transition-colors duration-300"
                    aria-label="projects">
                    استكشف المزيد من المشاريع
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
                        class="relative flex items-start bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 p-6 opacity-0 scale-95 guarantee-item">
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
        class="bg-gradient-to-b from-gray-900 to-gray-800  py-16 opacity-0 translate-y-10 overflow-x-hidden">
        <div class="container">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-white text-center mb-12">آراء العملاء</h2>

            <!-- Reviews Slider -->
            <div dir="ltr"
                x-data='{
            reviews: @json($reviews, JSON_UNESCAPED_SLASHES),
            currentIndex: 0,
            reviewsPerPage: 3,
            cardWidth: 320,
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
            }
        }'
                class="relative review-slider" @mouseenter="pause = true" @mouseleave="pause = false" wire:ignore>

                <!-- Slider Container -->
                <div class="flex transition-transform duration-500 flex-nowrap"
                    :style="{ 'transform': `translateX(-${currentIndex * cardWidth * reviewsPerPage}px)` }">
                    <template x-for="(review, index) in reviews" :key="index">
                        <div x-intersect="$el.classList.add('animate-item', 'slide-in-up')"
                            :x-intersect:delay="index % reviewsPerPage * 200"
                            class="flex-shrink-0 w-80 bg-white rounded-lg shadow-md p-6 text-center mx-3 opacity-0 translate-y-10">
                            <img :src="review.icon" alt="Reviewer"
                                class="w-16 h-16 rounded-full mx-auto mb-4 object-cover">
                            <h3 class="text-xl font-bold text-gray-900 mb-2" x-text="review.name"></h3>
                            <p class="text-gray-600 italic mb-2" x-text="review.title"></p>
                            <p class="text-gray-700" x-text="review.description"></p>
                        </div>
                    </template>
                </div>

                <!-- Navigation Dots -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in-slide-up')" x-intersect:delay="600"
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
        class="bg-gray-100 py-16 opacity-0 translate-y-10">
        <div class="container">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">المميزات</h2>
            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach ($counters as $index => $counter)
                    <div x-intersect.once="$el.classList.add('animate-item', 'fade-in-scale'); $dispatch('start-count', { id: $el.id })"
                        id="feature-{{ $index + 1 }}" x-data="{ count: 0 }"
                        x-on:start-count.window="if ($event.detail.id === 'feature-{{ $index + 1 }}') { let start = 0; const end = parseInt($el.dataset.count); const duration = 2000; const interval = duration / end; const timer = setInterval(() => { if (start < end) { start++; count = start; } else { clearInterval(timer); } }, interval); }"
                        class="bg-white rounded-lg shadow-md p-6 text-center opacity-0 scale-95"
                        data-count="{{ $counter->value }}">
                        <i class="{{ $counter->icon }} text-4xl text-gray-900 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $counter->name }}</h3>
                        <p class="text-3xl font-semibold text-orange-500" x-text="count"></p>
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
                        class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 opacity-0 translate-y-10">
                        <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}"
                            class="w-full h-48 object-cover rounded-t-lg blog-image">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $blog->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ $blog->created_at->format('d F Y') }}</p>
                            <p class="text-gray-700 mb-4">{!! \Illuminate\Support\Str::limit(strip_tags($blog->introduction), 100) !!}</p>
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
