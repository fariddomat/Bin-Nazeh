<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    livewire:navigate>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $info = \App\Models\Info::first();
    @endphp
    <meta name="description" content="{{ strip_tags($info->description) }} ">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ Storage::url($info->logo_2) }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $metaTitle ?? $info->name }}">
    <meta property="og:description" content="{{ strip_tags($info->description) }} ">
    <meta property="og:image" content="{{ Storage::url($info->logo_2) }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $info->name }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle ?? $info->name }}">
    <meta name="twitter:description" content="{{ strip_tags($info->description) }} ">
    <meta name="twitter:image" content="{{ Storage::url($info->logo_2) }}">

    <title>{{ $info->name }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('noty/noty.css') }}">
    <script src="{{ asset('noty/noty.min.js') }}" defer></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 overflow-x-hidden">
    <!-- Loader -->
    <div x-data="{ isLoading: true }" x-init="setTimeout(() => isLoading = false, 2000)" x-show="isLoading" x-cloak
        class="fixed inset-0 flex items-center justify-center bg-white bg-opacity-90 z-50 transition-opacity duration-500"
        :class="{ 'opacity-100': isLoading, 'opacity-0': !isLoading }">
        <div class="loader w-16 h-16 border-8 border-orange-500 border-t-black rounded-full animate-spin"></div>
    </div>

    <!-- Floating Contact Button -->
    <a href="{{ route('register-interest') }}" class="floating-contact-button" wire:navigate>
        <div class="contact-icon">
            <i class="fas fa-user-plus"></i>
        </div>
        <span class="contact-text">سجل اهتمامك</span>
    </a>

    <div class="flex flex-col min-h-screen" x-data="{ menuOpen: false, searchOpen: false }">
        <!-- Fixed Header -->
        <header class="header fixed top-0 left-0 right-0 z-50 text-white flex items-center justify-center primary-bg">
            <div class="container flex justify-between items-center">
                <!-- Logo and Name -->
                <div class="flex items-center space-x-2 space-x-reverse">
                   <a href="{{ route('home') }}">
                     <img src="{{ asset('logo/bin nazeh 3.png') }}" alt="Bin Nazeh Logo"
                        class="header-logo h-20 md:h-[9rem] w-20 md:w-[9rem] md:pt-8 transition-transform duration-300" />
                   </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-6 space-x-reverse nav-items" dir="ltr">
                    <a href="{{ route('home') }}"
                        class="nav-link hover:text-gray-200 transition-colors duration-200 {{ request()->is('/') ? 'active' : '' }}"
                        wire:navigate aria-label="home">الرئيسية</a>
                    <a href="{{ route('about') }}" class="nav-link hover:text-gray-200 transition-colors duration-200"
                        wire:navigate aria-label="about">نبذة عنا</a>
                    <a href="{{ route('services') }}"
                        class="nav-link hover:text-gray-200 transition-colors duration-200" wire:navigate
                        aria-label="service">خدماتنا</a>
                    <div x-data="{ open: false }" class="relative">
                        <a href="{{ route('project-categories') }}" @mouseover="open = true" @click.away="open = false"
                            class="nav-link hover:text-gray-200 transition-colors duration-500 flex items-center"
                            wire:navigate aria-label="projects"><i class="fas fa-chevron-down mr-1"></i>
                            المشاريع
                        </a>
                        <div x-show="open" @mouseover="open = true" @mouseleave="open = false"
                            class="absolute top-full right-0 mt-2 bg-white text-gray-900 rounded-md shadow-lg w-48">
                            @foreach (\App\Models\ProjectCategory::all() as $item)
                                <a href="{{ route('projects', $item) }}" class="block px-4 py-2 hover:bg-gray-100"
                                    wire:navigate aria-label="project {{ $item->name }}">{{ $item->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('register-interest') }}"
                        class="nav-link hover:text-gray-200 transition-colors duration-200" wire:navigate
                        aria-label="register interest">سجل
                        اهتمامك</a>
                    <a href="{{ route('blogs.index') }}"
                        class="nav-link hover:text-gray-200 transition-colors duration-200" wire:navigate
                        aria-label="blogs">الأخبار</a>
                    <a href="{{ route('contact') }}"
                        class="nav-link hover:text-gray-200 transition-colors duration-200" wire:navigate
                        aria-label="contact">تواصل معنا</a>
                </nav>
                <button class="hidden md:flex " @click="searchOpen = !searchOpen" aria-label="search">
                    <i class="fas fa-search text-xl"></i>
                </button>
                <!-- Mobile Menu Button, Phone, WhatsApp, and Search -->
                <div class="flex items-center space-x-4 space-x-reverse">
                    <!-- Desktop Phone and WhatsApp -->
                    <div class="hidden md:flex flex-col items-end space-y-2">

                        <a href="tel:+966{{ \App\Models\Info::first()->phone_1 }}"
                            class="flex items-center space-x-1 space-x-reverse hover:text-gray-200 transition-colors duration-200"
                            aria-label="phone number">
                            <i class="fas fa-phone-alt text-xl"></i>
                            <span>{{ \App\Models\Info::first()->phone_1 }}</span>
                        </a>
                        <a href="https://wa.me/+966{{ \App\Models\SocialMedia::where('name', 'whatsapp')->first()->link }}"
                            target="_blank"
                            class="flex items-center space-x-1 space-x-reverse hover:text-gray-200 transition-colors duration-200"
                            aria-label="whatsapp">
                            <i class="fab fa-whatsapp text-xl"></i>
                            <span>{{ \App\Models\SocialMedia::where('name', 'whatsapp')->first()->link }}</span>
                        </a>
                    </div>
                    <!-- Mobile Icons -->
                    <div class="flex md:hidden items-center space-x-3 space-x-reverse">

                        <a href="tel:+966{{ \App\Models\Info::first()->phone_1 }}"
                            class="flex items-center hover:text-gray-200 transition-colors duration-200"
                            aria-label="phone number">
                            <i class="fas fa-phone-alt text-xl"></i>
                        </a>
                        <a href="https://wa.me/+966{{ \App\Models\SocialMedia::where('name', 'whatsapp')->first()->link }}"
                            target="_blank"
                            class="flex items-center hover:text-gray-200 transition-colors duration-200"
                            aria-label="whatsapp">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                        <button @click="searchOpen = !searchOpen" aria-label="search">
                            <i class="fas fa-search text-xl"></i>
                        </button>
                        <button @click="menuOpen = !menuOpen" aria-label="menu">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <style>
            /* Ensure consistent spacing and alignment for mobile icons */
            @media (max-width: 767px) {
                .header .container .flex.items-center.space-x-4.space-x-reverse {
                    align-items: center;
                }

                .header .flex.md\:hidden.items-center.space-x-3.space-x-reverse>* {
                    margin-left: 0.75rem;
                    /* Consistent spacing between icons */
                }
            }
        </style>
        <!-- Search Popup -->
        <div x-show="searchOpen" x-cloak
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="bg-white rounded-lg p-6 w-full max-w-xl mx-4 relative"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform scale-95"
                x-transition:enter-end="transform scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="transform scale-100" x-transition:leave-end="transform scale-95">
                <button class="absolute top-4 left-4 text-gray-600 hover:text-gray-800" @click="searchOpen = false"
                    aria-label="search exit">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">ابحث في الموقع</h3>
                <form action="{{ route('search') }}" method="GET" class="space-y-4">
                    <div>
                        <label for="query" class="block text-gray-600 mb-2">كلمة البحث</label>
                        <input type="text" name="query" id="query" placeholder="أدخل كلمة البحث"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="scope" class="block text-gray-600 mb-2">نطاق البحث</label>
                        <select name="scope" id="scope"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="all">الكل</option>
                            <option value="projects">المشاريع</option>
                            <option value="blogs">الأخبار</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit"
                            class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 transition-all duration-300"
                            aria-label="search submit">
                            ابحث الآن
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu fixed top-0 right-0 h-full w-64 bg-gray-900 text-white p-6 md:hidden z-50"
            x-show="menuOpen" x-bind:class="{ 'open': menuOpen }">
            <button class="absolute top-4 left-4" @click="menuOpen = false" aria-label="menu exit">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <nav class="mt-12 space-y-4">
                <a href="{{ route('home') }}"
                    class="block hover:text-gray-300 {{ request()->is('/') ? 'font-bold border-r-2 border-white' : '' }}"
                    wire:navigate aria-label="home">الرئيسية</a>
                <a href="{{ route('about') }}" class="block hover:text-gray-300" wire:navigate
                    aria-label="about">نبذة عنا</a>
                <a href="{{ route('services') }}" class="block hover:text-gray-300" wire:navigate
                    aria-label="services">خدماتنا</a>
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="block hover:text-gray-300 flex justify-between w-full"
                        aria-label="project open">
                        المشاريع
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div x-show="open" class="pr-4 space-y-2">
                        @foreach (\App\Models\ProjectCategory::all() as $item)
                            <a href="{{ route('projects', $item) }}" class="block hover:text-gray-300" wire:navigate
                                aria-label="project {{ $item->name }}">{{ $item->name }}</a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('register-interest') }}" class="block hover:text-gray-300" wire:navigate
                    aria-label="register interest">سجل
                    اهتمامك</a>
                <a href="{{ route('blogs.index') }}" class="block hover:text-gray-300" wire:navigate
                    aria-label="blogs">الأخبار</a>
                <a href="{{ route('contact') }}" class="block hover:text-gray-300" wire:navigate
                    aria-label="contact">تواصل معنا</a>
            </nav>
        </div>

        <!-- Main Content -->
        <main class="flex-1 pt-20">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="footer py-12">
            <div class="container grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Column 1: Logo and Company Info -->
                <div><a href="{{ route('home') }}">
                    <img src="{{ asset('logo/bin nazeh 3.png') }}" alt="Bin Nazeh Logo" class="h-24 w-24 mb-4" /></a>
                    <h3 class="text-xl font-bold mb-2">{{ $info->name }}</h3>
                    <p class="text-gray-300">
                        {{ strip_tags($info->description) }}
                    </p>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">روابط سريعة</h3>
                    <div class="grid grid-cols-1 gap-4">

                        <div>
                            <ul class="space-y-2">
                                <li><a href="{{ route('register-interest') }}" class="hover:text-gray-300"
                                        wire:navigate aria-label="register interest">سجل اهتمامك</a></li>
                                <li><a href="{{ route('project-categories') }}" class="hover:text-gray-300" wire:navigate
                                        aria-label="blogs">آخر مشاريعنا</a></li>
                                 <li><a href="{{ route('privacy') }}" class="hover:text-gray-300" wire:navigate
                                        aria-label="privacy">سياسة الخصوصية</a></li>
                                <li><a href="{{ route('terms') }}" class="hover:text-gray-300" wire:navigate
                                        aria-label="terms">الشروط والأحكام
                                        </a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Column 3: Newsletter -->
                <div>
                    <h3 class="text-xl font-bold mb-4">النشرة البريدية</h3>
                    <p class="text-gray-300 mb-4">اشترك في نشرتنا البريدية للحصول على آخر الأخبار والعروض.</p>
                    <form id="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST"
                        class="space-y-4">
                        @csrf
                        <div class="relative">
                            <input type="text" name="mobile" id="mobile" placeholder="أدخل رقم هاتفك "
                                class="w-full p-3 pr-10 border border-gray-600 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <i
                                class="fas fa-phone absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <button type="submit"
                            class="w-full p-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition-all duration-300"
                            aria-label="newsletter">
                            اشترك الآن
                        </button>
                    </form>
                </div>

                <!-- Column 4: Contact Info -->
                <div>
                    <h3 class="text-xl font-bold mb-4">معلومات التواصل</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><i class="fas fa-phone mr-2"></i> <a
                                href="tel:{{ $info->phone_1 }}">{{ $info->phone_1 }}</a></li>
                        <li><i class="fas fa-envelope mr-2"></i> <a
                                href="mailto:{{ $info->email }}">{{ $info->email }}</a></li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> <a href="https://maps.app.goo.gl/A4gsfTKovA1jVgni8"> {{ $info->location }}</a></li>
                    </ul>
                    <div class="mt-4 flex space-x-4 space-x-reverse">
                        @foreach (\App\Models\SocialMedia::all() as $item)
                            <a href="{{ $item->link }}" class="hover:text-gray-300"
                                aria-label="{{ $item->name }}"><i class="fab {{ $item->icon }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    @extends('layouts._noty')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('redirect', (url) => {
                window.location.href = url;
            });
        });

        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js initialized');
        });

        // Newsletter Form Submission with AJAX
        $(document).ready(function() {
            $('#newsletter-form').ajaxForm({
                beforeSubmit: function() {
                    // Disable button to prevent multiple submissions
                    $('#newsletter-form button').prop('disabled', true).text('جارٍ الإرسال...');
                },
                success: function(response) {
                    $('#newsletter-form button').prop('disabled', false).text('اشترك الآن');
                    new Noty({
                        type: response.success ? 'success' : 'error',
                        text: response.message,
                        timeout: 3000,
                    }).show();
                    if (response.success) {
                        $('#newsletter-form')[0].reset();
                    }
                },
                error: function(response) {
                    $('#newsletter-form button').prop('disabled', false).text('اشترك الآن');
                    new Noty({
                        type: 'error',
                        text: response.message,
                        timeout: 3000,
                    }).show();
                }
            });
        });
    </script>
</body>

</html>
