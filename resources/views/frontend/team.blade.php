@extends('frontend.layout')

@section('content')
<!-- Hero Section -->
<div class="relative py-24 bg-gray-900 overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6" data-aos="fade-down">
            हमारी टीम <span class="text-saffron">OUR TEAM</span>
        </h1>
        <div class="w-24 h-1 bg-saffron mx-auto rounded-full mb-8" data-aos="zoom-in" data-aos-delay="200"></div>
        <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="300">
            हमारे नेतृत्व में अनुभव और ऊर्जा का अद्भुत संगम है। हम साथ मिलकर एक सशक्त और गौरवशाली भारत के निर्माण के लिए प्रतिबद्ध हैं।
        </p>
    </div>
</div>

<!-- Team Grid Section -->
<div class="bg-gray-50 py-24 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4" data-aos="fade-up">नेतृत्व मंडल</h2>
            <p class="text-gray-500 font-semibold" data-aos="fade-up" data-aos-delay="100">राष्ट्र के विकास के लिए समर्पित हमारे प्रमुख सदस्य</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
            @forelse($team ?? [] as $index => $member)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-xl transition-all duration-500 hover:-translate-y-4 hover:shadow-2xl border-b-8 border-saffron">
                        <div class="relative h-80 overflow-hidden">
                            @if($member->image_path)
                                <img src="{{ Storage::url($member->image_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center text-gray-400">
                                    <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                </div>
                            @endif
                            <!-- Social Overlay -->
                            <div class="absolute inset-0 bg-saffron/80 flex items-center justify-center space-x-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-saffron hover:bg-gray-900 hover:text-white transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-saffron hover:bg-gray-900 hover:text-white transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.975.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.058-1.281.072-1.689.072-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98-1.281-.058-1.689-.072-4.948-.072zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </a>
                            </div>
                        </div>
                        <div class="p-8 text-center">
                            <h3 class="text-2xl font-extrabold text-gray-900 group-hover:text-saffron transition duration-300">{{ $member->name }}</h3>
                            <p class="text-gray-500 font-bold uppercase tracking-widest text-sm mt-2">{{ $member->designation }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center" data-aos="fade-up">
                    <div class="bg-white rounded-3xl p-12 shadow-xl inline-block">
                        <svg class="w-20 h-20 text-gray-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <p class="text-gray-400 text-xl font-bold italic">अभी कोई टीम सदस्य नहीं जोड़ा गया है।</p>
                        <a href="{{ route('home') }}" class="mt-8 inline-block text-saffron font-bold hover:underline">वापस होम पर जाएँ</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl font-extrabold text-gray-900 mb-8" data-aos="fade-up">क्या आप भी हमारी टीम का हिस्सा बनना चाहते हैं?</h2>
        <p class="text-gray-600 text-xl mb-12 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            हम हमेशा उन ऊर्जावान और समर्पित लोगों की तलाश में रहते हैं जो देश के विकास में अपना योगदान देना चाहते हैं।
        </p>
        <a href="{{ route('join') }}" class="inline-block bg-saffron text-white text-xl font-bold py-5 px-12 rounded-full shadow-2xl hover:bg-saffronDark transition transform hover:scale-110" data-aos="fade-up" data-aos-delay="200">
            आज ही सदस्यता लें
        </a>
    </div>
</div>
@endsection
