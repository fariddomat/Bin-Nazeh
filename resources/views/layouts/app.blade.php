<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    livewire:navigate>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/bin nazeh 5.png') }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $metaTitle ?? config('app.name', 'Bin Nazeh') }}">
    <meta property="og:description"
        content="{{ $metaDescription ?? 'بن نازح - شركة رائدة في التطوير العقاري تقدم حلولاً مبتكرة ومستدامة في المملكة العربية السعودية.' }}">
    <meta property="og:image" content="{{ $metaImage ?? asset('logo/bin nazeh 5.png') }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name', 'Bin Nazeh') }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle ?? config('app.name', 'Bin Nazeh') }}">
    <meta name="twitter:description"
        content="{{ $metaDescription ?? 'بن نازح - شركة رائدة في التطوير العقاري تقدم حلولاً مبتكرة ومستدامة في المملكة العربية السعودية.' }}">
    <meta name="twitter:image" content="{{ $metaImage ?? asset('logo/bin nazeh 5.png') }}">

    <title>{{ config('app.name', 'Dashboard') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('noty/noty.css') }}">
    <script src="{{ asset('noty/noty.min.js') }}" defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        html[dir="rtl"] th {
            text-align: right;
        }

        @media (max-width: 768px) {
            html[dir="rtl"] .main-b {
                margin-left: 0 !important;
                margin-right: -16rem !important;
            }

            html[dir="rtl"] .-translate-x-64 {
                --tw-translate-x: +16rem;
            }

        }

        @media (min-width: 768px) {
            html[dir="rtl"] aside {
                left: unset !important;
            }

            html[dir="ltr"] .main-b {
                margin-left: 16rem !important;
                margin-right: 0 !important;
            }

            html[dir="rtl"] .main-b {
                margin-left: 0 !important;
                margin-right: 16rem !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen  overflow-x-hidden" x-data="{ open: false }">
        <!-- Sidebar Overlay (Mobile) -->
        <div class="fixed inset-0 z-40 bg-black bg-opacity-50 md:hidden" x-show="open" @click="open = false"></div>

        <!-- Sidebar -->
        <aside
            class="bg-gray-900 text-white p-5 w-64 md:w-64 md:fixed md:top-0 md:left-0 md:h-screen transition-all duration-300 ease-in-out z-50 overflow-y-auto"
            :class="open ? 'translate-x-0' : '-translate-x-64 md:translate-x-0'">
            <h2 class="text-xl font-bold mb-4">@lang('site.control_panel')</h2>

            <nav class="mt-5 space-y-3">
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    @lang('site.home') <i class="fas fa-home"></i>
                </x-responsive-nav-link>

                <!-- Blog Group -->
                @php
                    $isBlogActive = Str::startsWith(request()->route()->getName(), [
                        'dashboard.blog_categories.',
                        'dashboard.blogs.',
                    ]);
                @endphp
                <details class="group" {{ $isBlogActive ? 'open' : '' }}>
                    <summary
                        class="{{ $isBlogActive ? 'block w-full ps-4 pe-4 py-2 border-l-4 border-white shadow-md text-start text-base font-medium text-white bg-blue-800 dark:bg-blue-800 rounded-md transition duration-200 ease-in-out flex justify-between items-center' : 'cursor-pointer block w-full ps-4 pe-4 py-2 rounded-lg border border-white/20 shadow-md shadow-gray-800/50 transition-all duration-200 hover:bg-gray-700 active:bg-gray-600 border-l-4 border-transparent text-start text-base font-medium text-gray-300 rounded-md transition duration-200 ease-in-out flex justify-between items-center' }}">
                        @lang('site.blog') <i class="fas fa-blog"></i>
                    </summary>
                    <div class="pl-6 space-y-2 py-2">
                        <x-responsive-nav-link href="{{ route('dashboard.blog_categories.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.blog_categories.')">
                            @lang('site.categories') <i class="fas fa-list-alt"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.blogs.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.blogs.')">
                            @lang('site.blogs') <i class="fas fa-newspaper"></i>
                        </x-responsive-nav-link>
                    </div>
                </details>

                <!-- Services Group -->
                @php
                    $isServiceActive = Str::startsWith(request()->route()->getName(), ['dashboard.services.']);
                @endphp
                <details class="group" {{ $isServiceActive ? 'open' : '' }}>
                    <summary
                        class="{{ $isServiceActive ? 'block w-full ps-4 pe-4 py-2 border-l-4 border-white shadow-md text-start text-base font-medium text-white bg-blue-800 dark:bg-blue-800 rounded-md transition duration-200 ease-in-out flex justify-between items-center' : 'cursor-pointer block w-full ps-4 pe-4 py-2 rounded-lg border border-white/20 shadow-md shadow-gray-800/50 transition-all duration-200 hover:bg-gray-700 active:bg-gray-600 border-l-4 border-transparent text-start text-base font-medium text-gray-300 rounded-md transition duration-200 ease-in-out flex justify-between items-center' }}">
                        @lang('site.services') <i class="fas fa-cogs"></i>
                    </summary>
                    <div class="pl-6 space-y-2 py-2">
                        <x-responsive-nav-link href="{{ route('dashboard.services.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.services.')">
                            @lang('site.services') <i class="fas fa-cog"></i>
                        </x-responsive-nav-link>
                    </div>
                </details>

                <!-- Projects Group -->
                @php
                    $isProjectActive = Str::startsWith(request()->route()->getName(), [
                        'dashboard.project_categories.',
                        'dashboard.projects.',
                    ]);
                @endphp
                <details class="group" {{ $isProjectActive ? 'open' : '' }}>
                    <summary
                        class="{{ $isProjectActive ? 'block w-full ps-4 pe-4 py-2 border-l-4 border-white shadow-md text-start text-base font-medium text-white bg-blue-800 dark:bg-blue-800 rounded-md transition duration-200 ease-in-out flex justify-between items-center' : 'cursor-pointer block w-full ps-4 pe-4 py-2 rounded-lg border border-white/20 shadow-md shadow-gray-800/50 transition-all duration-200 hover:bg-gray-700 active:bg-gray-600 border-l-4 border-transparent text-start text-base font-medium text-gray-300 rounded-md transition duration-200 ease-in-out flex justify-between items-center' }}">
                        @lang('site.projects') <i class="fas fa-project-diagram"></i>
                    </summary>
                    <div class="pl-6 space-y-2 py-2">
                        <x-responsive-nav-link href="{{ route('dashboard.project_categories.index') }}"
                            :active="Str::startsWith(request()->route()->getName(), 'dashboard.project_categories.')">
                            @lang('site.categories') <i class="fas fa-list-alt"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.projects.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.projects.')">
                            @lang('site.projects') <i class="fas fa-folder"></i>
                        </x-responsive-nav-link>
                    </div>
                </details>

                <!-- Content Group -->
                @php
                    $isContentActive = Str::startsWith(request()->route()->getName(), [
                        'dashboard.infos.',
                        'dashboard.abouts.',
                        'dashboard.sliders.',
                        'dashboard.counters.',
                        'dashboard.partners.',
                        'dashboard.whies.',
                        'dashboard.certificates.',
                        'dashboard.reviews.',
                    ]);
                @endphp
                <details class="group" {{ $isContentActive ? 'open' : '' }}>
                    <summary
                        class="{{ $isContentActive ? 'block w-full ps-4 pe-4 py-2 border-l-4 border-white shadow-md text-start text-base font-medium text-white bg-blue-800 dark:bg-blue-800 rounded-md transition duration-200 ease-in-out flex justify-between items-center' : 'cursor-pointer block w-full ps-4 pe-4 py-2 rounded-lg border border-white/20 shadow-md shadow-gray-800/50 transition-all duration-200 hover:bg-gray-700 active:bg-gray-600 border-l-4 border-transparent text-start text-base font-medium text-gray-300 rounded-md transition duration-200 ease-in-out flex justify-between items-center' }}">
                        @lang('site.content') <i class="fas fa-file-alt"></i>
                    </summary>
                    <div class="pl-6 space-y-2 py-2">
                        <x-responsive-nav-link href="{{ route('dashboard.infos.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.infos.')">
                            @lang('site.about_me') <i class="fas fa-info"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.abouts.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.abouts.')">
                            @lang('site.abouts') <i class="fas fa-info-circle"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.sliders.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.sliders.')">
                            @lang('site.sliders') <i class="fas fa-images"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.counters.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.counters.')">
                            @lang('site.counters') <i class="fas fa-tachometer-alt"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.partners.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.partners.')">
                            @lang('site.partners') <i class="fas fa-handshake"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.whies.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.whies.')">
                            @lang('site.whies') <i class="fas fa-question-circle"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.certificates.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.certificates.')">
                            @lang('site.certificates') <i class="fas fa-certificate"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.reviews.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.reviews.')">
                            @lang('site.reviews') <i class="fas fa-star"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.facilities.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.facilities.')">
                            @lang('site.facilities') <i class="fas fa-wrench"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.social_media.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.social_media.')">
                            @lang('site.social_media') <i class="fab fa-google"></i>
                        </x-responsive-nav-link>
                    </div>
                </details>

                <!-- Communications Group -->
                @php
                    $isCommActive = Str::startsWith(request()->route()->getName(), [
                        'dashboard.news_letters.',
                        'dashboard.careers.',
                        'dashboard.contact_uses.',
                    ]);
                @endphp
                <details class="group" {{ $isCommActive ? 'open' : '' }}>
                    <summary
                        class="{{ $isCommActive ? 'block w-full ps-4 pe-4 py-2 border-l-4 border-white shadow-md text-start text-base font-medium text-white bg-blue-800 dark:bg-blue-800 rounded-md transition duration-200 ease-in-out flex justify-between items-center' : 'cursor-pointer block w-full ps-4 pe-4 py-2 rounded-lg border border-white/20 shadow-md shadow-gray-800/50 transition-all duration-200 hover:bg-gray-700 active:bg-gray-600 border-l-4 border-transparent text-start text-base font-medium text-gray-300 rounded-md transition duration-200 ease-in-out flex justify-between items-center' }}">
                        @lang('site.communications') <i class="fas fa-envelope"></i>
                    </summary>
                    <div class="pl-6 space-y-2 py-2">
                        <x-responsive-nav-link href="{{ route('dashboard.news_letters.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.news_letters.')">
                            @lang('site.news_letters') <i class="fas fa-newspaper"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.careers.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.careers.')">
                            @lang('site.careers') <i class="fas fa-briefcase"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.contact_uses.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.contact_uses.')">
                            @lang('site.contact_us') <i class="fas fa-address-book"></i>
                        </x-responsive-nav-link>
                    </div>
                </details>

                <!-- SEO Group -->
                {{-- @php
                    $isSeoActive = Str::startsWith(request()->route()->getName(), [
                        'dashboard.meta_tags.',
                        'dashboard.redirects.',
                    ]);
                @endphp
                <details class="group" {{ $isSeoActive ? 'open' : '' }}>
                    <summary
                        class="{{ $isSeoActive ? 'block w-full ps-4 pe-4 py-2 border-l-4 border-white shadow-md text-start text-base font-medium text-white bg-blue-800 dark:bg-blue-800 rounded-md transition duration-200 ease-in-out flex justify-between items-center' : 'cursor-pointer block w-full ps-4 pe-4 py-2 rounded-lg border border-white/20 shadow-md shadow-gray-800/50 transition-all duration-200 hover:bg-gray-700 active:bg-gray-600 border-l-4 border-transparent text-start text-base font-medium text-gray-300 rounded-md transition duration-200 ease-in-out flex justify-between items-center' }}">
                        @lang('site.seo') <i class="fas fa-globe"></i>
                    </summary>
                    <div class="pl-6 space-y-2 py-2">
                        <x-responsive-nav-link href="{{ route('dashboard.meta_tags.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.meta_tags.')">
                            @lang('site.meta_tags') <i class="fas fa-tags"></i>
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('dashboard.redirects.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.redirects.')">
                            @lang('site.redirects') <i class="fas fa-link"></i>
                        </x-responsive-nav-link>
                    </div>
                </details> --}}

                <!-- Pages Group -->
                @php
                    $isPagesActive = Str::startsWith(request()->route()->getName(), [
                        'dashboard.terms.',
                        'dashboard.privacies.index',
                    ]);
                @endphp
                <details class="group" {{ $isPagesActive ? 'open' : '' }}>
                    <summary
                        class="{{ $isPagesActive ? 'block w-full ps-4 pe-4 py-2 border-l-4 border-white shadow-md text-start text-base font-medium text-white bg-blue-800 dark:bg-blue-800 rounded-md transition duration-200 ease-in-out flex justify-between items-center' : 'cursor-pointer block w-full ps-4 pe-4 py-2 rounded-lg border border-white/20 shadow-md shadow-gray-800/50 transition-all duration-200 hover:bg-gray-700 active:bg-gray-600 border-l-4 border-transparent text-start text-base font-medium text-gray-300 rounded-md transition duration-200 ease-in-out flex justify-between items-center' }}">
                        @lang('site.pages') <i class="fas fa-file"></i>
                    </summary>
                    <div class="pl-6 space-y-2 py-2">
                        <x-responsive-nav-link href="{{ route('dashboard.terms.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.terms.')">
                            @lang('site.terms') <i class="fas fa-file-contract"></i>
                        </x-responsive-nav-link>

                        <x-responsive-nav-link href="{{ route('dashboard.privacies.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.privacies.')">
                            @lang('site.privacy') <i class="fas fa-file"></i>
                        </x-responsive-nav-link>

                    </div>
                </details>

                <!-- Users (Superadministrator Only) -->
                @if (auth()->user()->hasRole('superadministrator'))
                    <x-responsive-nav-link href="{{ route('dashboard.users.index') }}" :active="Str::startsWith(request()->route()->getName(), 'dashboard.users.')">
                        @lang('site.users') <i class="fas fa-users"></i>
                    </x-responsive-nav-link>
                @endif

                <!-- Profile -->
                <x-responsive-nav-link href="{{ route('profile') }}" :active="request()->routeIs('profile')">
                    @lang('site.profile') <i class="fas fa-user-cog"></i>
                </x-responsive-nav-link>
            </nav>
        </aside>

        <div class="container main-b flex-1 flex flex-col -ml-64 md:ml-64">

            <!-- Navbar -->
            <header class="bg-blue-800 text-white  shadow p-4 flex justify-between items-center">
                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="md:hidden text-gray-700 text-2xl">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- User Actions -->
                <div class="flex space-x-3 items-center text-lg">
                    {{-- <span class="cursor-pointer hover:text-gray-500pr-2">
                        <i class="fas fa-bell"></i>
                    </span> --}}

                    {{-- <span class="cursor-pointer hover:text-gray-500 pr-2">
                        <i class="fas fa-user"></i> User
                    </span> --}}

                    <!-- Logout Button -->
                    <span class="cursor-pointer hover:text-red-500 pr-2 w-full">
                        <a class="w-full text-start" href="{{ route('dashboard.logout') }}" wire:navigate>
                            <i class="fas fa-sign-out-alt"></i> @lang('site.logout')
                        </a>
                    </span>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include ajaxForm library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    @extends('layouts._noty')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('redirect', (url) => {
                window.location.href = url;
            });
        });
    </script>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        var imageGalleryBrowseUrl = "{{ route('dashboard.imageGallery.browser') }}";
        var imageGalleryUploadUrl = "{{ route('dashboard.imageGallery.uploader') }}";
        $(function() {
            $("textarea").each(function(index) {
                // Skip if the textarea is invalid or hidden (e.g., display: none)
                if (!this || $(this).is(':hidden') || $(this).parents().is(':hidden')) {
                    return true; // Continue to next iteration
                }

                // Assign a unique ID if none exists
                if (!this.id) {
                    this.id = 'textarea-' + index + '-' + Math.random().toString(36).substr(2,
                    9); // Unique ID
                }

                // Initialize CKEditor only if not already initialized
                if (!CKEDITOR.instances[this.id]) {
                    CKEDITOR.replace(this.id, {
                        filebrowserBrowseUrl: imageGalleryBrowseUrl,
                        filebrowserUploadUrl: imageGalleryUploadUrl + "?_token=" +
                            $("meta[name=csrf-token]").attr("content"),
                        removeButtons: "About",
                        contentsLangDirection: $(this).attr('dir') || 'rtl'
                    });
                }
            });
        });
    </script>


</body>

</html>
