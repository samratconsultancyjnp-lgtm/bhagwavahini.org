@extends('frontend.layout')

@section('content')
<!-- Hero Section -->
<div class="relative py-24 bg-gray-900 overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6" data-aos="fade-down">
            गैलरी <span class="text-saffron">GALLERY</span>
        </h1>
        <div class="w-24 h-1 bg-saffron mx-auto rounded-full mb-8" data-aos="zoom-in" data-aos-delay="200"></div>
        <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="300">
            हमारी यात्रा की कुछ झलकियाँ। राष्ट्र सेवा और जनसंपर्क के गौरवशाली क्षणों का संकलन।
        </p>
    </div>
</div>

<!-- Gallery Grid Section -->
<div class="bg-white py-24 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filter (Optional/Placeholder) -->
        <div class="flex flex-wrap justify-center gap-4 mb-16" data-aos="fade-up">
            <button class="px-8 py-2 rounded-full bg-saffron text-white font-bold shadow-lg shadow-saffron/30 transition">सभी</button>
            <button class="px-8 py-2 rounded-full bg-gray-100 text-gray-600 font-bold hover:bg-saffron hover:text-white transition">आयोजन</button>
            <button class="px-8 py-2 rounded-full bg-gray-100 text-gray-600 font-bold hover:bg-saffron hover:text-white transition">जनसभा</button>
            <button class="px-8 py-2 rounded-full bg-gray-100 text-gray-600 font-bold hover:bg-saffron hover:text-white transition">सामाजिक कार्य</button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($galleries ?? [] as $index => $image)
                <div class="group relative overflow-hidden rounded-3xl shadow-xl aspect-w-4 aspect-h-3" data-aos="zoom-in" data-aos-delay="{{ $index * 50 }}">
                    <img src="{{ Storage::url($image->image_path) }}" alt="{{ $image->title }}" class="object-cover w-full h-full transform group-hover:scale-110 transition duration-700">
                    
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <span class="inline-block px-3 py-1 bg-saffron text-white text-xs font-bold rounded-full mb-3 uppercase tracking-widest">
                                {{ $image->category ?? 'General' }}
                            </span>
                            <h3 class="text-2xl font-bold text-white mb-2">{{ $image->title }}</h3>
                            <div class="w-12 h-1 bg-saffron rounded-full"></div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center" data-aos="fade-up">
                    <div class="bg-gray-50 rounded-3xl p-12 inline-block">
                        <svg class="w-20 h-20 text-gray-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-gray-400 text-xl font-bold italic">अभी गैलरी में कोई चित्र नहीं है।</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-24 bg-gray-50 border-t">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-extrabold text-gray-900 mb-8" data-aos="fade-up">हमारी गतिविधियों से अपडेट रहें</h2>
        <p class="text-gray-600 text-xl mb-12" data-aos="fade-up" data-aos-delay="100">आगामी आयोजनों और पार्टी की नई पहलों के बारे में जानने के लिए हमसे जुड़ें।</p>
        <a href="{{ route('join') }}" class="inline-block bg-saffron text-white text-xl font-bold py-5 px-12 rounded-full shadow-2xl hover:bg-saffronDark transition transform hover:scale-110" data-aos="fade-up" data-aos-delay="200">
            सदस्यता लें
        </a>
    </div>
</div>
@endsection
