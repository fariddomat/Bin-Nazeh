<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    livewire:navigate>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bin Nazeh') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('noty/noty.css') }}">
    <script src="{{ asset('noty/noty.min.js') }}" defer></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        /* Header Styles */
        .header {
            transition: all 0.3s ease-in-out;
            background: #000000; /* Black background */
            color: #ffffff; /* White text */
            height: 5rem; /* Increased height */
        }

        .header.scrolled {
            height: 3.5rem; /* Shrink on scroll */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .header.scrolled .header-logo {
            transform: scale(0.8);
        }

        /* Active Link */
        .nav-link.active {
            border-bottom: 2px solid #ffffff;
            font-weight: bold;
        }

        /* Page Load Animation */
        .header {
            animation: slideDown 0.8s ease-out;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* RTL Adjustments */
        html[dir="rtl"] .nav-items {
            flex-direction: row-reverse;
        }

        html[dir="rtl"] .mobile-menu {
            right: 0;
            left: auto;
            transform: translateX(100%);
        }

        html[dir="rtl"] .mobile-menu.open {
            transform: translateX(0);
        }

        /* Mobile Menu */
        .mobile-menu {
            transition: transform 0.3s ease-in-out;
        }

        /* Container */
        .container {
            @apply mx-auto px-4 sm:px-6 lg:px-8;
        }

        /* Footer Styles */
        .footer {
            background: #000000; /* Black background */
            color: #ffffff; /* White text */
        }

        .footer a:hover {
            color: #cccccc; /* Light gray on hover */
        }

        .social-icon {
            border: 2px solid #ffffff; /* White rounded border */
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff; /* White icon */
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .social-icon:hover {
            background-color: #ffffff; /* White background on hover */
            color: #000000; /* Black icon on hover */
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }

            .header.scrolled {
                padding: 0.5rem;
                height: 3rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>

</head>

<body class="bg-gray-100 overflow-x-hidden">
    <div class="flex flex-col min-h-screen" x-data="{ menuOpen: false }">
        <!-- Fixed Header -->
        <header class="header fixed top-0 left-0 right-0 z-50 text-white flex items-center">
            <div class="container flex justify-between items-center">
                <!-- Logo and Name -->
                <div class="flex items-center space-x-2 space-x-reverse">
                    <img src="{{ asset('logo.png') }}" alt="Bin Nazeh Logo"
                        class="header-logo h-12 w-12 transition-transform duration-300" />
                    <span class="text-2xl font-bold">بن نازح</span>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-6 space-x-reverse nav-items" dir="ltr">
                    <a href="#" class="nav-link hover:text-gray-200 transition-colors duration-200 {{ request()->is('/') ? 'active' : '' }}">الرئيسية</a>
                    <a href="#" class="nav-link hover:text-gray-200 transition-colors duration-200">نبذة عنا</a>
                    <a href="#" class="nav-link hover:text-gray-200 transition-colors duration-200">خدماتنا</a>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="nav-link hover:text-gray-200 transition-colors duration-200 flex items-center">
                            المشاريع
                            <i class="fas fa-chevron-down mr-1"></i>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute top-full right-0 mt-2 bg-white text-gray-900 rounded-md shadow-lg w-48">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">جدة</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">الرياض</a>
                        </div>
                    </div>
                    <a href="#" class="nav-link hover:text-gray-200 transition-colors duration-200">سجل اهتمامك</a>
                    <a href="#" class="nav-link hover:text-gray-200 transition-colors duration-200">الأخبار</a>
                    <a href="#" class="nav-link hover:text-gray-200 transition-colors duration-200">تواصل معنا</a>
                </nav>

                <!-- Mobile Menu Button and Search -->
                <div class="flex items-center space-x-4 space-x-reverse">
                    <button class="md:hidden" @click="menuOpen = !menuOpen">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                    <button>
                        <i class="fas fa-search text-xl"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- Mobile Menu -->
        <div class="mobile-menu fixed top-0 right-0 h-full w-64 bg-gray-900 text-white p-6 md:hidden z-50"
            x-show="menuOpen" x-bind:class="{ 'open': menuOpen }">
            <button class="absolute top-4 left-4" @click="menuOpen = false">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <nav class="mt-12 space-y-4">
                <a href="#" class="block hover:text-gray-300 {{ request()->is('/') ? 'font-bold border-r-2 border-white' : '' }}">الرئيسية</a>
                <a href="#" class="block hover:text-gray-300">نبذة عنا</a>
                <a href="#" class="block hover:text-gray-300">خدماتنا</a>
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="block hover:text-gray-300 flex justify-between w-full">
                        المشاريع
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div x-show="open" class="pr-4 space-y-2">
                        <a href="#" class="block hover:text-gray-300">جدة</a>
                        <a href="#" class="block hover:text-gray-300">الرياض</a>
                    </div>
                </div>
                <a href="#" class="block hover:text-gray-300">سجل اهتمامك</a>
                <a href="#" class="block hover:text-gray-300">الأخبار</a>
                <a href="#" class="block hover:text-gray-300">تواصل معنا</a>
            </nav>
        </div>

        <!-- Main Content -->
        <main class="flex-1 pt-20">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="footer py-12">
            <div class="container text-center">
                <!-- Footer Links -->
                <div class="footer-links flex justify-center gap-8 mb-6">
                    <a href="#" class="text-white hover:underline">البحث</a>
                    <a href="#" class="text-white hover:underline">اتصل بنا</a>
                    <a href="#" class="text-white hover:underline">الشروط</a>
                    <a href="#" class="text-white hover:underline">الخصوصية</a>
                </div>

                <!-- Social Media Icons -->
                <div class="flex justify-center gap-4 mb-6">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>

                <!-- Copyright Notice -->
                <div class="text-gray-300">
                    <p>
                        الحقوق محفوظة لـ
                        <a href="https://digitsmark.com" class="underline hover:text-white">digitsmark</a>
                        © 2025
                    </p>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts

    <!-- jQuery and AjaxForm -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <!-- Noty and Livewire Redirect -->
    @extends('layouts._noty')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('redirect', (url) => {
                window.location.href = url;
            });
        });

        // Scroll Effect for Header
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Debug Menu Toggle
        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js initialized');
        });
    </script>
</body>

</html>
