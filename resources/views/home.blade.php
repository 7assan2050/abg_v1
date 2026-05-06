<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ __('site.dir') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ __('site.about_desc') }}">
    <title>{{ __('site.footer_company') }} — {{ __('site.hero_tagline') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .gold-gradient { background: linear-gradient(135deg, #C9A84C 0%, #E8C96A 50%, #C9A84C 100%); }
        .navy-gradient { background: linear-gradient(135deg, #0D1B2A 0%, #1A2D42 100%); }
        .hero-bg { background: linear-gradient(160deg, #0D1B2A 0%, #1A2D42 60%, #243B55 100%); }
        .text-gold { color: #C9A84C; }
        .border-gold { border-color: #C9A84C; }
        .bg-gold { background-color: #C9A84C; }
        .bg-navy { background-color: #0D1B2A; }
        .logo-glow { filter: drop-shadow(0 0 20px rgba(201,168,76,0.4)); }
        .nav-link { @apply text-gray-300 hover:text-yellow-400 transition-colors duration-200 text-sm font-semibold; }

        /* Animated underline for nav */
        .nav-link::after {
            content: '';
            display: block;
            height: 2px;
            background: #C9A84C;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        .nav-link:hover::after { transform: scaleX(1); }

        /* Hero pattern overlay */
        .hero-pattern {
            background-image: radial-gradient(circle at 20% 50%, rgba(201,168,76,0.08) 0%, transparent 50%),
                              radial-gradient(circle at 80% 20%, rgba(201,168,76,0.06) 0%, transparent 40%);
        }

        /* Number counters */
        .stat-card { background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); }

        /* Section alternating */
        .section-light { background: #FAFAFA; }
        .section-white { background: #FFFFFF; }

        /* Gold divider */
        .gold-divider { background: linear-gradient(90deg, transparent, #C9A84C, transparent); height: 1px; }

        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .float-anim { animation: float 4s ease-in-out infinite; }

        /* Scroll reveal fade */
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.7s ease; }
        .revealed { opacity: 1; transform: translateY(0); }

        /* RTL/LTR nav spacing */
        [dir="rtl"] .nav-gap { direction: rtl; }
        [dir="ltr"] .nav-gap { direction: ltr; }
    </style>
</head>
<body class="antialiased text-gray-800 overflow-x-hidden">

{{-- =================== NAVBAR =================== --}}
<nav class="fixed top-0 inset-x-0 z-50 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                <img src="{{ asset('images/abg_logo.png') }}" alt="{{ __('site.footer_company') }}"
                     class="h-12 w-auto logo-glow">
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden lg:flex items-center gap-8 nav-gap">
                <a href="#about" class="nav-link">{{ __('site.nav_about') }}</a>
                <a href="#services" class="nav-link">{{ __('site.nav_services') }}</a>
                <a href="#why" class="nav-link">{{ __('site.nav_why_us') }}</a>
                <a href="#technology" class="nav-link">{{ __('site.nav_technology') }}</a>
                <a href="#quality" class="nav-link">{{ __('site.nav_quality') }}</a>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-4">
                {{-- Language Switcher --}}
                <a href="?lang={{ __('site.lang_code') }}"
                   class="text-xs font-bold border border-yellow-500/50 text-yellow-400 px-3 py-1.5 rounded-full hover:bg-yellow-500/10 transition-colors duration-200">
                    {{ __('site.lang_switch') }}
                </a>

                {{-- CTA --}}
                <a href="#contact"
                   class="hidden sm:inline-flex items-center gap-2 bg-gold text-navy-900 font-bold px-5 py-2 rounded-full text-sm hover:opacity-90 transition-all duration-200 shadow-lg"
                   style="background:#C9A84C; color:#0D1B2A;">
                    {{ __('site.nav_contact') }}
                </a>

                {{-- Mobile Menu Toggle --}}
                <button id="mobile-toggle" class="lg:hidden text-gray-300 hover:text-white" aria-label="Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden lg:hidden pb-4 border-t border-white/10 mt-2">
            <div class="flex flex-col gap-3 pt-4">
                <a href="#about" class="text-gray-300 hover:text-yellow-400 py-2 text-sm font-semibold mobile-nav-link">{{ __('site.nav_about') }}</a>
                <a href="#services" class="text-gray-300 hover:text-yellow-400 py-2 text-sm font-semibold mobile-nav-link">{{ __('site.nav_services') }}</a>
                <a href="#why" class="text-gray-300 hover:text-yellow-400 py-2 text-sm font-semibold mobile-nav-link">{{ __('site.nav_why_us') }}</a>
                <a href="#technology" class="text-gray-300 hover:text-yellow-400 py-2 text-sm font-semibold mobile-nav-link">{{ __('site.nav_technology') }}</a>
                <a href="#quality" class="text-gray-300 hover:text-yellow-400 py-2 text-sm font-semibold mobile-nav-link">{{ __('site.nav_quality') }}</a>
                <a href="#contact" class="text-gray-300 hover:text-yellow-400 py-2 text-sm font-semibold mobile-nav-link">{{ __('site.nav_contact') }}</a>
            </div>
        </div>
    </div>
</nav>

{{-- =================== HERO =================== --}}
<section class="hero-bg hero-pattern relative min-h-screen flex items-center overflow-hidden">
    {{-- Decorative circles --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -end-40 w-96 h-96 rounded-full opacity-5"
             style="background: radial-gradient(circle, #C9A84C, transparent);"></div>
        <div class="absolute bottom-20 -start-20 w-80 h-80 rounded-full opacity-5"
             style="background: radial-gradient(circle, #C9A84C, transparent);"></div>
        <div class="absolute top-1/2 start-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full opacity-[0.03] border border-yellow-400"></div>
        <div class="absolute top-1/2 start-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] rounded-full opacity-[0.02] border border-yellow-400"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            {{-- Text Content --}}
            <div class="text-center lg:text-start" style="{{ app()->getLocale() === 'ar' ? 'text-align: right;' : '' }}">
                <div class="inline-flex items-center gap-2 bg-white/5 border border-yellow-500/20 rounded-full px-4 py-2 mb-8">
                    <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                    <span class="text-yellow-400 text-xs font-bold tracking-widest uppercase">
                        {{ app()->getLocale() === 'ar' ? 'شركة سعودية · الرياض' : 'Saudi Company · Riyadh' }}
                    </span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight mb-6"
                    style="line-height: 1.3;">
                    <span class="block" style="color: #C9A84C;">{{ __('site.hero_tagline') }}</span>
                </h1>

                <p class="text-lg text-gray-300 mb-10 leading-relaxed max-w-lg">
                    {{ __('site.hero_subtitle') }}
                </p>

                <div class="flex flex-wrap gap-4 {{ app()->getLocale() === 'ar' ? 'justify-end lg:justify-start' : 'justify-center lg:justify-start' }}">
                    <a href="#contact"
                       class="inline-flex items-center gap-2 font-bold px-8 py-4 rounded-full text-base transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1"
                       style="background: linear-gradient(135deg, #C9A84C, #E8C96A); color: #0D1B2A;">
                        {{ __('site.hero_cta_primary') }}
                        @if(app()->getLocale() === 'ar')
                        <svg class="w-5 h-5 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                        @else
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                        @endif
                    </a>
                    <a href="#services"
                       class="inline-flex items-center gap-2 font-bold px-8 py-4 rounded-full text-base border-2 text-yellow-400 hover:bg-yellow-400/10 transition-all duration-300"
                       style="border-color: #C9A84C;">
                        {{ __('site.hero_cta_secondary') }}
                    </a>
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-6 mt-16 pt-10 border-t border-white/10">
                    <div class="text-center">
                        <div class="text-3xl font-black" style="color: #C9A84C;">+100</div>
                        <div class="text-gray-400 text-xs mt-1">
                            {{ app()->getLocale() === 'ar' ? 'عميل راضٍ' : 'Happy Clients' }}
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-black" style="color: #C9A84C;">6</div>
                        <div class="text-gray-400 text-xs mt-1">
                            {{ app()->getLocale() === 'ar' ? 'خدمات متكاملة' : 'Integrated Services' }}
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-black" style="color: #C9A84C;">24/7</div>
                        <div class="text-gray-400 text-xs mt-1">
                            {{ app()->getLocale() === 'ar' ? 'دعم متواصل' : 'Continuous Support' }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Logo Float --}}
            <div class="flex items-center justify-center">
                <div class="relative float-anim">
                    <div class="absolute inset-0 rounded-full opacity-20 blur-3xl"
                         style="background: radial-gradient(circle, #C9A84C, transparent);"></div>
                    <img src="{{ asset('images/abg_logo.png') }}" alt="{{ __('site.footer_company') }}"
                         class="relative w-72 h-72 lg:w-96 lg:h-96 object-contain logo-glow">
                </div>
            </div>
        </div>
    </div>

    {{-- Wave bottom --}}
    <div class="absolute bottom-0 inset-x-0">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 80H1440V20C1200 60 960 0 720 20C480 40 240 0 0 20V80Z" fill="#FAFAFA"/>
        </svg>
    </div>
</section>

{{-- =================== FOREWORD QUOTE =================== --}}
<section class="section-light py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="gold-divider w-24 mx-auto mb-10"></div>
        <blockquote class="text-2xl md:text-3xl font-bold text-gray-700 leading-relaxed italic">
            "{{ __('site.foreword_quote') }}"
        </blockquote>
        <div class="gold-divider w-24 mx-auto mt-10"></div>
    </div>
</section>

{{-- =================== ABOUT =================== --}}
<section id="about" class="section-white py-24 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            {{-- Visual --}}
            <div class="relative order-2 lg:order-1">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl"
                     style="background: linear-gradient(135deg, #0D1B2A 0%, #1A2D42 100%); min-height: 480px;">
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-10">
                        <img src="{{ asset('images/abg_logo.png') }}" alt="" class="w-48 h-48 object-contain opacity-80 mb-8 logo-glow">
                        <div class="text-center">
                            <p class="text-yellow-400 font-bold text-lg mb-2">{{ app()->getLocale() === 'ar' ? 'الرياض · المملكة العربية السعودية' : 'Riyadh · Saudi Arabia' }}</p>
                            <p class="text-gray-400 text-sm">{{ app()->getLocale() === 'ar' ? 'شركة سعودية متخصصة في مراكز الاتصال' : 'Saudi Call Center Specialist' }}</p>
                        </div>
                    </div>

                    {{-- Decorative corner --}}
                    <div class="absolute top-0 end-0 w-32 h-32 opacity-10"
                         style="background: radial-gradient(circle at top right, #C9A84C, transparent);"></div>
                    <div class="absolute bottom-0 start-0 w-32 h-32 opacity-10"
                         style="background: radial-gradient(circle at bottom left, #C9A84C, transparent);"></div>
                </div>
            </div>

            {{-- Content --}}
            <div class="order-1 lg:order-2">
                <p class="section-subtitle" style="color: #C9A84C;">{{ __('site.about_subtitle') }}</p>
                <h2 class="section-title" style="color: #0D1B2A; font-size: 2.5rem;">{{ __('site.about_title') }}</h2>
                <p class="text-gray-600 leading-relaxed text-lg mb-10">
                    {{ __('site.about_desc') }}
                </p>

                <div class="grid sm:grid-cols-2 gap-6">
                    {{-- Vision --}}
                    <div class="rounded-2xl p-6 border-s-4" style="border-color: #C9A84C; background: #FEF9E7;">
                        <h3 class="font-black text-lg mb-2" style="color: #0D1B2A;">{{ __('site.vision_title') }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ __('site.vision_desc') }}</p>
                    </div>

                    {{-- Mission --}}
                    <div class="rounded-2xl p-6 border-s-4" style="border-color: #1A2D42; background: #F0F4F8;">
                        <h3 class="font-black text-lg mb-2" style="color: #0D1B2A;">{{ __('site.mission_title') }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ __('site.mission_desc') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- =================== STRENGTHS =================== --}}
<section class="py-24 reveal" style="background: linear-gradient(135deg, #0D1B2A 0%, #1A2D42 100%);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <p class="text-xs font-bold tracking-widest uppercase mb-3" style="color: #C9A84C;">
                {{ app()->getLocale() === 'ar' ? 'ما يميزنا' : 'Our Strengths' }}
            </p>
            <h2 class="text-4xl font-black text-white">{{ __('site.strengths_title') }}</h2>
            <p class="text-gray-400 mt-4 max-w-xl mx-auto">{{ __('site.strengths_subtitle') }}</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $strengths = [
                ['num' => '01', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'title' => __('site.strength_1_title'), 'desc' => __('site.strength_1_desc')],
                ['num' => '02', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'title' => __('site.strength_2_title'), 'desc' => __('site.strength_2_desc')],
                ['num' => '03', 'icon' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z', 'title' => __('site.strength_3_title'), 'desc' => __('site.strength_3_desc')],
                ['num' => '04', 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'title' => __('site.strength_4_title'), 'desc' => __('site.strength_4_desc')],
            ];
            @endphp

            @foreach($strengths as $item)
            <div class="rounded-2xl p-8 border border-white/10 hover:border-yellow-500/30 transition-all duration-300 group hover:-translate-y-1"
                 style="background: rgba(255,255,255,0.04);">
                <div class="text-5xl font-black mb-5 opacity-20 group-hover:opacity-40 transition-opacity" style="color: #C9A84C;">
                    {{ $item['num'] }}
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform"
                     style="background: rgba(201,168,76,0.15);">
                    <svg class="w-6 h-6" fill="none" stroke="#C9A84C" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-black text-white text-lg mb-3">{{ $item['title'] }}</h3>
                <p class="text-gray-400 text-sm leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =================== SERVICES =================== --}}
<section id="services" class="section-light py-24 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <p class="section-subtitle" style="color: #C9A84C;">{{ __('site.services_title') }}</p>
            <h2 class="section-title" style="color: #0D1B2A;">{{ __('site.services_title') }}</h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">{{ __('site.services_subtitle') }}</p>
        </div>

        @php
        $services = [
            [
                'title' => __('site.service_outbound_title'),
                'desc' => __('site.service_outbound_desc'),
                'tag' => 'OUTBOUND',
                'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z',
                'color' => '#0D1B2A',
            ],
            [
                'title' => __('site.service_inbound_title'),
                'desc' => __('site.service_inbound_desc'),
                'tag' => 'INBOUND',
                'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z',
                'color' => '#1A2D42',
            ],
            [
                'title' => __('site.service_leads_title'),
                'desc' => __('site.service_leads_desc'),
                'tag' => 'LEADS',
                'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                'color' => '#243B55',
            ],
            [
                'title' => __('site.service_surveys_title'),
                'desc' => __('site.service_surveys_desc'),
                'tag' => 'SURVEYS',
                'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4',
                'color' => '#2E4D6B',
            ],
            [
                'title' => __('site.service_confirm_title'),
                'desc' => __('site.service_confirm_desc'),
                'tag' => 'CONFIRMATIONS',
                'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                'color' => '#0D1B2A',
            ],
            [
                'title' => __('site.service_collections_title'),
                'desc' => __('site.service_collections_desc'),
                'tag' => 'COLLECTIONS',
                'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'color' => '#1A2D42',
            ],
        ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="card-service">
                <div class="card-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $service['icon'] }}"/>
                    </svg>
                </div>
                <span class="inline-block text-xs font-bold tracking-widest mb-3 px-3 py-1 rounded-full"
                      style="color: {{ $service['color'] }}; background: rgba(201,168,76,0.1);">
                    {{ $service['tag'] }}
                </span>
                <h3 class="font-black text-xl mb-3" style="color: #0D1B2A;">{{ $service['title'] }}</h3>
                <p class="text-gray-500 leading-relaxed">{{ $service['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =================== WHY US =================== --}}
<section id="why" class="py-24 reveal" style="background: linear-gradient(135deg, #C9A84C 0%, #E8C96A 50%, #C9A84C 100%);">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-xs font-bold tracking-widest uppercase mb-4" style="color: #0D1B2A; opacity: 0.7;">
            {{ __('site.why_title') }}
        </p>
        <h2 class="text-4xl md:text-5xl font-black mb-6" style="color: #0D1B2A;">
            {{ __('site.why_promise') }}
        </h2>
        <p class="text-xl leading-relaxed mb-16 max-w-3xl mx-auto" style="color: #1A2D42; font-weight: 500;">
            {{ __('site.why_desc') }}
        </p>

        <div class="grid sm:grid-cols-3 gap-8">
            @foreach([['value_1', '✦'], ['value_2', '✦'], ['value_3', '✦']] as $val)
            <div class="bg-white/20 backdrop-blur-sm rounded-3xl p-10 hover:bg-white/30 transition-all duration-300 hover:-translate-y-1">
                <div class="text-4xl mb-4" style="color: #0D1B2A;">{{ $val[1] }}</div>
                <div class="text-2xl font-black" style="color: #0D1B2A;">{{ __('site.'.$val[0]) }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =================== TECHNOLOGY =================== --}}
<section id="technology" class="section-white py-24 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <div>
                <p class="section-subtitle" style="color: #C9A84C;">{{ __('site.tech_title') }}</p>
                <h2 class="section-title" style="color: #0D1B2A; font-size: 2.5rem;">{{ __('site.tech_title') }}</h2>
                <p class="text-gray-500 mb-10 text-lg">{{ __('site.tech_subtitle') }}</p>

                <div class="grid sm:grid-cols-2 gap-4">
                    @php
                    $techs = ['tech_1','tech_2','tech_3','tech_4','tech_5','tech_6','tech_7','tech_8'];
                    @endphp
                    @foreach($techs as $tech)
                    <div class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-yellow-300 transition-colors group">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform"
                             style="background: rgba(201,168,76,0.15);">
                            <svg class="w-4 h-4" fill="none" stroke="#C9A84C" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">{{ __('site.'.$tech) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Visual --}}
            <div class="relative">
                <div class="rounded-3xl p-10 relative overflow-hidden"
                     style="background: linear-gradient(135deg, #0D1B2A 0%, #243B55 100%);">
                    <div class="absolute top-0 end-0 w-48 h-48 opacity-10"
                         style="background: radial-gradient(circle at top right, #C9A84C, transparent);"></div>

                    <div class="relative z-10 text-center">
                        <div class="w-24 h-24 rounded-full mx-auto mb-8 flex items-center justify-center"
                             style="background: rgba(201,168,76,0.2);">
                            <svg class="w-12 h-12" fill="none" stroke="#C9A84C" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-white mb-3">Cloud Contact Center</h3>
                        <p class="text-gray-400">{{ app()->getLocale() === 'ar' ? 'بنية تحتية سحابية متكاملة' : 'Fully integrated cloud infrastructure' }}</p>

                        <div class="mt-8 grid grid-cols-2 gap-4">
                            @foreach([['ACD', app()->getLocale() === 'ar' ? 'توزيع آلي' : 'Auto Distribution'], ['IVR', app()->getLocale() === 'ar' ? 'رد صوتي' : 'Voice Response'], ['CTI', app()->getLocale() === 'ar' ? 'تكامل هاتفي' : 'Phone Integration'], ['CRM', app()->getLocale() === 'ar' ? 'إدارة علاقات' : 'CRM Integration']] as $tech)
                            <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                                <div class="font-black text-lg mb-1" style="color: #C9A84C;">{{ $tech[0] }}</div>
                                <div class="text-xs text-gray-400">{{ $tech[1] }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- =================== QUALITY =================== --}}
<section id="quality" class="section-light py-24 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <p class="section-subtitle" style="color: #C9A84C;">{{ __('site.quality_title') }}</p>
            <h2 class="section-title" style="color: #0D1B2A;">{{ __('site.quality_title') }}</h2>
            <p class="text-gray-500 mt-4 max-w-xl mx-auto">{{ __('site.quality_subtitle') }}</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @php
            $qualities = [
                ['num' => '1', 'title' => __('site.quality_1_title'), 'desc' => __('site.quality_1_desc'), 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['num' => '2', 'title' => __('site.quality_2_title'), 'desc' => __('site.quality_2_desc'), 'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
                ['num' => '3', 'title' => __('site.quality_3_title'), 'desc' => __('site.quality_3_desc'), 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
            ];
            @endphp

            @foreach($qualities as $q)
            <div class="bg-white rounded-3xl p-10 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 relative overflow-hidden group">
                <div class="absolute -top-4 -end-4 text-8xl font-black opacity-5 group-hover:opacity-10 transition-opacity"
                     style="color: #C9A84C;">{{ $q['num'] }}</div>
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 transition-all duration-300 group-hover:scale-110"
                     style="background: rgba(201,168,76,0.1);">
                    <svg class="w-8 h-8" fill="none" stroke="#C9A84C" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $q['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-black text-xl mb-4" style="color: #0D1B2A;">{{ $q['title'] }}</h3>
                <p class="text-gray-500 leading-relaxed">{{ $q['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =================== CONTACT =================== --}}
<section id="contact" class="py-24 reveal" style="background: linear-gradient(135deg, #0D1B2A 0%, #1A2D42 100%);">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <p class="text-xs font-bold tracking-widest uppercase mb-3" style="color: #C9A84C;">
                {{ __('site.contact_title') }}
            </p>
            <h2 class="text-4xl font-black text-white mb-4">{{ __('site.contact_title') }}</h2>
            <p class="text-gray-400 max-w-xl mx-auto">{{ __('site.contact_subtitle') }}</p>
        </div>

        <div class="rounded-3xl overflow-hidden shadow-2xl" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(201,168,76,0.2);">
            <div class="grid md:grid-cols-2">

                {{-- Info Panel --}}
                <div class="p-10 md:p-14" style="background: rgba(201,168,76,0.08);">
                    <div class="w-20 h-20 rounded-full mb-8 flex items-center justify-center"
                         style="background: rgba(201,168,76,0.15);">
                        <svg class="w-10 h-10" fill="none" stroke="#C9A84C" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>

                    <h3 class="text-2xl font-black text-white mb-1">{{ __('site.contact_name') }}</h3>
                    <p class="mb-8" style="color: #C9A84C; font-weight: 600;">{{ __('site.contact_role') }}</p>

                    <div class="space-y-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                                 style="background: rgba(201,168,76,0.2);">
                                <svg class="w-5 h-5" fill="none" stroke="#C9A84C" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-0.5">{{ __('site.contact_phone_label') }}</div>
                                <a href="tel:{{ __('site.contact_phone') }}"
                                   class="text-white font-bold text-lg hover:text-yellow-400 transition-colors">
                                    {{ __('site.contact_phone') }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                                 style="background: rgba(201,168,76,0.2);">
                                <svg class="w-5 h-5" fill="none" stroke="#C9A84C" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-0.5">{{ __('site.contact_location_label') }}</div>
                                <div class="text-white font-bold text-lg">{{ __('site.contact_location') }}</div>
                            </div>
                        </div>
                    </div>

                    <a href="tel:{{ __('site.contact_phone') }}"
                       class="mt-10 inline-flex items-center gap-2 font-black px-8 py-4 rounded-full transition-all duration-300 shadow-xl hover:-translate-y-1"
                       style="background: linear-gradient(135deg, #C9A84C, #E8C96A); color: #0D1B2A;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ __('site.contact_cta') }}
                    </a>
                </div>

                {{-- Map/Brand Panel --}}
                <div class="p-10 md:p-14 flex flex-col items-center justify-center text-center">
                    <img src="{{ asset('images/abg_logo.png') }}" alt="{{ __('site.footer_company') }}"
                         class="w-40 h-40 object-contain mb-8 logo-glow opacity-90">
                    <h3 class="text-2xl font-black text-white mb-3">{{ __('site.footer_company') }}</h3>
                    <p class="text-gray-400 mb-6">{{ app()->getLocale() === 'ar' ? 'شركة سعودية متخصصة في مراكز الاتصال والتسويق الهاتفي' : 'Saudi Call Center & Telemarketing Specialists' }}</p>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        <span class="text-gray-400 text-sm">
                            {{ app()->getLocale() === 'ar' ? 'متاحون الآن للتواصل' : 'Available now' }}
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- =================== FOOTER =================== --}}
<footer style="background: #080F18;" class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/abg_logo.png') }}" alt="" class="h-10 w-auto opacity-80">
                <span class="text-gray-400 text-sm">{{ __('site.footer_company') }}</span>
            </div>
            <div class="text-center">
                <p class="text-gray-500 text-sm italic">{{ __('site.footer_tagline') }}</p>
            </div>
            <div class="text-gray-600 text-xs">
                © {{ date('Y') }} {{ __('site.footer_company') }} · {{ __('site.footer_rights') }}
            </div>
        </div>
    </div>
</footer>

{{-- =================== SCRIPTS =================== --}}
<script>
    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.style.background = 'rgba(13,27,42,0.97)';
            navbar.style.backdropFilter = 'blur(20px)';
            navbar.style.boxShadow = '0 4px 30px rgba(0,0,0,0.3)';
            navbar.style.borderBottom = '1px solid rgba(201,168,76,0.15)';
        } else {
            navbar.style.background = 'transparent';
            navbar.style.backdropFilter = 'none';
            navbar.style.boxShadow = 'none';
            navbar.style.borderBottom = 'none';
        }
    });

    // Mobile menu
    const toggle = document.getElementById('mobile-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    toggle?.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));

    // Close mobile menu on nav link click
    document.querySelectorAll('.mobile-nav-link').forEach(link => {
        link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                const offset = 80;
                const top = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        });
    });

    // Scroll reveal
    const revealElements = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    revealElements.forEach(el => observer.observe(el));
</script>

</body>
</html>
