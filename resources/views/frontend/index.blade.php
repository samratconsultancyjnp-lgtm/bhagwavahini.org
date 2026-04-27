@extends('frontend.layout')

@section('content')

<!-- Hero Section -->
<div class="relative h-[88vh] min-h-[580px] flex items-center overflow-hidden">
    @if(isset($sliders) && $sliders->count() > 0)
        @foreach($sliders as $key => $slider)
            <div class="absolute inset-0 slider-item {{ $key == 0 ? 'active' : '' }}" id="slider-{{ $key }}">
                <!-- Background Image with Ken Burns Zoom -->
                <img src="{{ Storage::url($slider->image_path) }}" alt="{{ $slider->title }}"
                     class="absolute inset-0 w-full h-full object-cover z-0 transform scale-105 hero-img-{{ $key }}">

                <!-- Rich Gradient Overlay -->
                <div class="absolute inset-0 z-10" style="background: linear-gradient(105deg, rgba(0,0,0,0.88) 0%, rgba(0,0,0,0.55) 50%, rgba(0,0,0,0.15) 100%);"></div>
                <div class="absolute inset-0 z-10 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>

                <!-- Saffron Accent Glow (bottom-left atmospheric) -->
                <div class="absolute bottom-0 left-0 w-[500px] h-[300px] z-10 pointer-events-none" style="background: radial-gradient(ellipse at 0% 100%, rgba(255,153,51,0.18) 0%, transparent 70%);"></div>

                <!-- Content -->
                <div class="relative z-20 h-full flex items-center">
                    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 w-full pb-20">
                        <div class="max-w-3xl">

                            <!-- Eyebrow Label -->
                            <div class="flex items-center gap-3 mb-6 banner-animate-1">
                                <span class="block h-[3px] w-10 rounded-full" style="background: #FF9933; box-shadow: 0 0 12px rgba(255,153,51,0.9);"></span>
                                <span class="text-xs font-black tracking-[0.35em] uppercase" style="color: #FF9933; text-shadow: 0 0 20px rgba(255,153,51,0.6);">
                                    राष्ट्रहित सर्वोपरि — Bhagva Dal
                                </span>
                            </div>

                            <!-- Main Title -->
                            <h1 class="font-black text-white mb-3 banner-animate-2" style="font-size: clamp(2rem, 4.5vw, 4rem); line-height: 1.0; letter-spacing: -0.03em; text-shadow: 0 4px 30px rgba(0,0,0,0.7);">
                                {{ $slider->title }}
                            </h1>

                            <!-- Saffron Gradient Sub-Title -->
                            <p class="font-extrabold mb-4 banner-animate-2" style="font-size: clamp(1rem, 1.8vw, 1.5rem); background: linear-gradient(90deg, #FF9933, #FFCC33); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; letter-spacing: -0.01em;">
                                नए भारत का संकल्प — संकल्प से सिद्धि तक
                            </p>

                            <!-- Description -->
                            <p class="text-gray-300 mb-8 leading-relaxed banner-animate-3" style="font-size: clamp(0.9rem, 1.3vw, 1.1rem); max-width: 520px; font-weight: 500;">
                                {{ $slider->description }}
                            </p>

                            <!-- CTA Buttons -->
                            <div class="flex flex-col sm:flex-row flex-wrap items-center gap-4 md:gap-5 banner-animate-4">
                                <!-- Primary Glowing Button -->
                                <a href="{{ route('join') }}"
                                   class="hero-cta-primary group relative inline-flex items-center justify-center gap-3 font-black uppercase tracking-tight text-white overflow-hidden transition-all duration-500 w-full sm:w-auto"
                                   style="font-size: 1rem; padding: 14px 30px; border-radius: 100px; background: linear-gradient(135deg, #FF9933 0%, #E68A2E 100%); box-shadow: 0 0 30px rgba(255,153,51,0.45), 0 8px 32px rgba(0,0,0,0.3);">
                                    <span class="relative z-10">अभी जुड़ें</span>
                                    <span class="relative z-10 hidden sm:inline">(Join Now)</span>
                                    <svg class="w-5 h-5 relative z-10 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    <!-- Shine sweep -->
                                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: linear-gradient(105deg, transparent 30%, rgba(255,255,255,0.25) 50%, transparent 70%); animation: none;"></div>
                                </a>

                                <!-- Secondary Ghost Button -->
                                <a href="{{ route('about') }}"
                                   class="hero-cta-secondary group inline-flex items-center justify-center gap-3 font-bold text-white transition-all duration-500 w-full sm:w-auto"
                                   style="font-size: 1rem; padding: 14px 30px; border-radius: 100px; border: 2px solid rgba(255,255,255,0.3); backdrop-filter: blur(8px); background: rgba(255,255,255,0.05);">
                                    <span>अधिक जानें</span>
                                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Slider Dots -->
        <div class="absolute bottom-20 left-1/2 -translate-x-1/2 z-50 flex items-center gap-2">
            @foreach($sliders as $key => $s)
                <button onclick="goToSlider({{ $key }})"
                        class="slider-dot transition-all duration-500 rounded-full"
                        style="{{ $key == 0 ? 'width:28px; height:8px; background:#FF9933; box-shadow: 0 0 10px rgba(255,153,51,0.7);' : 'width:8px; height:8px; background:rgba(255,255,255,0.35);' }}">
                </button>
            @endforeach
        </div>

    @else
        <!-- Fallback Static Hero -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero.png') }}" alt="Bhagva Rally" class="w-full h-full object-cover">
            <div class="absolute inset-0" style="background: linear-gradient(105deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.5) 55%, transparent 100%);"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 w-full">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-4 md:mb-6">
                    <span class="block h-[3px] w-8 md:w-10 rounded-full" style="background:#FF9933; box-shadow:0 0 12px rgba(255,153,51,0.9);"></span>
                    <span class="text-[10px] md:text-xs font-black tracking-[0.2em] md:tracking-[0.35em] uppercase" style="color:#FF9933;">राष्ट्रहित सर्वोपरि — Bhagva Dal</span>
                </div>
                <h1 class="font-black text-white mb-3 md:mb-4 leading-tight md:leading-none" style="font-size: clamp(2rem, 5.5vw, 5rem); letter-spacing: -0.03em; text-shadow: 0 4px 30px rgba(0,0,0,0.6);">
                    नए भारत के <br><span style="background: linear-gradient(90deg,#FF9933,#FFCC33); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">सशक्त निर्माण</span> का संकल्प
                </h1>
                <p class="text-gray-300 mb-8 md:mb-10 leading-relaxed text-sm md:text-lg" style="max-width: 560px; font-weight:500;">
                    हमारा विज़न है — एक ऐसा भारत जहाँ संस्कृति, धर्म, और राष्ट्रप्रेम के मूल्यों का सम्मान हो।
                </p>
                <div class="flex flex-col sm:flex-row flex-wrap gap-4 md:gap-5">
                    <a href="{{ route('join') }}" class="hero-cta-primary group inline-flex items-center justify-center gap-3 font-black uppercase tracking-tight text-white transition-all duration-500 w-full sm:w-auto" style="font-size:1rem; padding:14px 30px; border-radius:100px; background:linear-gradient(135deg,#FF9933 0%,#E68A2E 100%); box-shadow:0 0 30px rgba(255,153,51,0.45),0 8px 32px rgba(0,0,0,0.3);">
                        अभी जुड़ें (Join Now)
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('about') }}" class="hero-cta-secondary group inline-flex items-center justify-center gap-3 font-bold text-white transition-all duration-500 w-full sm:w-auto" style="font-size:1rem; padding:14px 30px; border-radius:100px; border:2px solid rgba(255,255,255,0.3); backdrop-filter:blur(8px); background:rgba(255,255,255,0.05);">
                        अधिक जानें
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] z-40 pointer-events-none">
        <svg class="relative block w-[calc(100%+1.3px)] h-[60px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C58.47,122.3,172.24,69,213.81,54.43Z" style="fill:#f9fafb;"></path>
        </svg>
    </div>
</div>

<style>
    /* Slider Transitions */
    .slider-item {
        opacity: 0;
        z-index: 0;
        transition: opacity 1.2s ease-in-out;
        pointer-events: none;
    }
    .slider-item.active {
        opacity: 1;
        z-index: 20;
        pointer-events: auto;
    }

    /* Slide-up entrance animations */
    .slider-item.active .banner-animate-1 { animation: heroSlideUp 0.7s cubic-bezier(0.16,1,0.3,1) both 0.1s; }
    .slider-item.active .banner-animate-2 { animation: heroSlideUp 0.7s cubic-bezier(0.16,1,0.3,1) both 0.3s; }
    .slider-item.active .banner-animate-3 { animation: heroSlideUp 0.7s cubic-bezier(0.16,1,0.3,1) both 0.5s; }
    .slider-item.active .banner-animate-4 { animation: heroSlideUp 0.7s cubic-bezier(0.16,1,0.3,1) both 0.65s; }

    @keyframes heroSlideUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Ken Burns slow zoom */
    @keyframes heroZoom {
        from { transform: scale(1.05); }
        to   { transform: scale(1.12); }
    }
    .slider-item.active img {
        animation: heroZoom 14s ease-in-out forwards;
    }

    /* Primary CTA hover glow pulse */
    .hero-cta-primary:hover {
        box-shadow: 0 0 50px rgba(255,153,51,0.65), 0 12px 40px rgba(0,0,0,0.35);
        transform: translateY(-2px) scale(1.03);
    }

    /* Secondary CTA hover */
    .hero-cta-secondary:hover {
        background: rgba(255,153,51,0.12) !important;
        border-color: rgba(255,153,51,0.6) !important;
        transform: translateY(-2px);
    }

    /* Dot transition */
    .slider-dot { cursor: pointer; }
</style>

<script>
    let currentSlider = 0;
    const heroSliders = document.querySelectorAll('.slider-item');
    const heroDots = document.querySelectorAll('.slider-dot');
    let heroInterval;

    function updateSliders(index) {
        heroSliders.forEach((s, i) => {
            s.classList.remove('active');
            heroDots[i].style.width = '8px';
            heroDots[i].style.height = '8px';
            heroDots[i].style.background = 'rgba(255,255,255,0.35)';
            heroDots[i].style.boxShadow = 'none';
        });
        heroSliders[index].classList.add('active');
        heroDots[index].style.width = '28px';
        heroDots[index].style.height = '8px';
        heroDots[index].style.background = '#FF9933';
        heroDots[index].style.boxShadow = '0 0 10px rgba(255,153,51,0.7)';
        currentSlider = index;
    }

    function goToSlider(index) {
        clearInterval(heroInterval);
        updateSliders(index);
        startHeroSlide();
    }

    function startHeroSlide() {
        heroInterval = setInterval(() => {
            updateSliders((currentSlider + 1) % heroSliders.length);
        }, 7000);
    }

    if (heroSliders.length > 1) startHeroSlide();
</script>

<!-- Stats Counter Section -->
<div class="bg-gray-50 py-12 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center" data-aos="zoom-in" data-aos-delay="100">
                <p class="text-4xl md:text-5xl font-extrabold text-saffron mb-2">10M+</p>
                <p class="text-gray-600 font-semibold">सक्रिय सदस्य</p>
            </div>
            <div class="text-center" data-aos="zoom-in" data-aos-delay="200">
                <p class="text-4xl md:text-5xl font-extrabold text-saffron mb-2">500+</p>
                <p class="text-gray-600 font-semibold">जिले कवर</p>
            </div>
            <div class="text-center" data-aos="zoom-in" data-aos-delay="300">
                <p class="text-4xl md:text-5xl font-extrabold text-saffron mb-2">100%</p>
                <p class="text-gray-600 font-semibold">राष्ट्र सेवा</p>
            </div>
            <div class="text-center" data-aos="zoom-in" data-aos-delay="400">
                <p class="text-4xl md:text-5xl font-extrabold text-saffron mb-2">24/7</p>
                <p class="text-gray-600 font-semibold">जनता की सेवा</p>
            </div>
        </div>
    </div>
</div>

<!-- Mission & Vision Section -->
<div class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-16 items-center">
            <div class="flex-1" data-aos="fade-right">
                <h2 class="text-saffron font-bold tracking-widest uppercase mb-2 md:mb-4 text-sm md:text-base">हमारी विचारधारा</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 md:mb-6 leading-tight">
                    सनातन संस्कृति और <br>आधुनिक विकास का संगम
                </h3>
                <p class="text-gray-600 text-base md:text-lg mb-6 md:mb-8">
                    "हमारा विज़न है - एक ऐसा भारत जहाँ संस्कृति, धर्म, और राष्ट्रप्रेम के मूल्यों का सम्मान हो। हमारा मिशन है कि हम सनातन मूल्यों की रक्षा करें और समाज के अंतिम व्यक्ति तक विकास पहुंचाएं।"
                </p>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-saffron/10 rounded-lg flex items-center justify-center text-saffron shrink-0">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="font-bold text-gray-800 text-base md:text-lg">सांस्कृतिक संरक्षण</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-saffron/10 rounded-lg flex items-center justify-center text-saffron shrink-0">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="font-bold text-gray-800 text-base md:text-lg">पारदर्शी शासन</p>
                    </div>
                </div>
            </div>
            <div class="flex-1 relative w-full" data-aos="fade-left">
                <div class="bg-saffron-gradient w-full min-h-[300px] md:h-[400px] rounded-2xl shadow-2xl relative overflow-hidden transform md:rotate-3 md:hover:rotate-0 transition duration-500">
                    <div class="absolute inset-4 border-2 border-white/30 rounded-xl"></div>
                    <div class="p-8 md:p-12 text-white h-full flex flex-col justify-end">
                        <p class="text-2xl md:text-3xl font-bold mb-4 italic">"राष्ट्र सर्वोपरि, अंत्योदय ही हमारा लक्ष्य है।"</p>
                        <p class="font-semibold text-base md:text-lg opacity-80">- भगवा दल सिद्धांत</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Focus Areas - Grid with Hover Effects -->
<div class="bg-gray-50 py-24 border-y">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4" data-aos="fade-up">मुख्य संकल्प (Focus Areas)</h2>
            <div class="w-24 h-1 bg-saffron mx-auto rounded-full" data-aos="fade-up" data-aos-delay="100"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $focusAreas = [
                    ['title' => 'आर्थिक समृद्धि', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['title' => 'स्वास्थ्य सेवाएँ', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                    ['title' => 'पर्यावरण संरक्षण', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['title' => 'शिक्षा सशक्तिकरण', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                    ['title' => 'राष्ट्रीय सुरक्षा', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                    ['title' => 'जवाबदेह शासन', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                    ['title' => 'सांस्कृतिक समृद्धि', 'icon' => 'M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5'],
                    ['title' => 'सामाजिक समानता', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                ];
            @endphp
            @foreach($focusAreas as $index => $area)
            <div class="bg-white rounded-2xl p-8 text-center group hover:bg-saffron transition-all duration-500 shadow-lg hover:shadow-saffron/40" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                <div class="w-16 h-16 bg-saffron/10 rounded-2xl flex items-center justify-center text-saffron mb-6 mx-auto group-hover:bg-white group-hover:text-saffron transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $area['icon'] }}"></path></svg>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 group-hover:text-white transition">{{ $area['title'] }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Premium Chairman Message Section -->
<div class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-900 rounded-[2rem] md:rounded-[3rem] p-8 md:p-20 relative flex flex-col md:flex-row items-center gap-8 md:gap-12 border-b-8 border-saffron">
            <div class="absolute top-0 right-0 p-8 md:p-12 opacity-10">
                <svg class="w-48 h-48 md:w-64 md:h-64 text-saffron" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V21H14.017ZM5.017 21L5.017 18C5.017 16.8954 5.91243 16 7.017 16H10.017C10.5693 16 11.017 15.5523 11.017 15V9C11.017 8.44772 10.5693 8 10.017 8H6.017C5.46472 8 5.017 8.44772 5.017 9V11C5.017 11.5523 4.56929 12 4.017 12H3.017V21H5.017Z" /></svg>
            </div>
            
            <div class="w-48 h-48 md:w-64 md:h-64 flex-shrink-0 relative mx-auto md:mx-0" data-aos="zoom-in">
                <div class="absolute inset-0 bg-saffron rounded-full transform scale-110 opacity-20 animate-pulse"></div>
                <img src="{{ asset('images/chairman.png') }}" alt="Chairman" class="w-full h-full object-cover rounded-full border-4 border-saffron shadow-2xl relative z-10">
            </div>
            
            <div class="relative z-10 text-center md:text-left" data-aos="fade-left">
                <h2 class="text-saffron font-bold text-lg md:text-xl mb-2 md:mb-4">राष्ट्रीय अध्यक्ष का संदेश</h2>
                <p class="text-white text-xl md:text-3xl font-bold leading-relaxed mb-6 md:mb-8">
                    "एक उज्ज्वल भविष्य के लिए हमें चुनिए... हमारा संकल्प है कि हम भारत को विश्व पटल पर सर्वश्रेष्ठ राष्ट्र बनाएंगे और सांस्कृतिक धरोहर को सहेजते हुए आधुनिक भारत का निर्माण करेंगे।"
                </p>
                <div class="flex items-center justify-center md:justify-start space-x-4">
                    <div class="w-8 md:w-12 h-1 bg-saffron rounded-full"></div>
                    <p class="text-gray-400 text-lg md:text-xl font-semibold">श्री राष्ट्रीय अध्यक्ष</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA - Join Us -->
<div class="py-24 bg-saffron relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6 md:mb-8" data-aos="fade-up">आप भी बनें इस परिवर्तन का हिस्सा</h2>
        <p class="text-white/80 text-base md:text-xl mb-8 md:mb-12 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            हजारों देशभक्तों के साथ जुड़ें और अपने क्षेत्र और राष्ट्र की प्रगति में सीधा योगदान दें। आपका साथ ही हमारी शक्ति है।
        </p>
        <a href="{{ route('join') }}" class="inline-block bg-white text-saffron text-xl md:text-2xl font-bold py-4 px-10 md:py-6 md:px-16 rounded-full shadow-2xl hover:bg-gray-100 transition transform hover:scale-110 active:scale-95" data-aos="fade-up" data-aos-delay="200">
            आज ही जुड़ें (Join Now)
        </a>
    </div>
</div>
@endsection
