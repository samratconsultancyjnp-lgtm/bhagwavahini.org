@extends('frontend.layout')

@section('content')
<!-- Hero Section -->
<div class="relative py-24 bg-gray-900 overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6" data-aos="fade-down">
            आयोजन <span class="text-saffron">EVENTS</span>
        </h1>
        <div class="w-24 h-1 bg-saffron mx-auto rounded-full mb-8" data-aos="zoom-in" data-aos-delay="200"></div>
        <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="300">
            हम सक्रिय रूप से जनता के बीच रहकर उनकी समस्याओं का समाधान करते हैं। हमारे आगामी और पिछले आयोजनों की जानकारी यहाँ देखें।
        </p>
    </div>
</div>

<!-- Events Timeline Section -->
<div class="bg-gray-50 py-24 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4" data-aos="fade-up">आगामी एवं महत्वपूर्ण आयोजन</h2>
            <p class="text-gray-500 font-semibold" data-aos="fade-up" data-aos-delay="100">जनसेवा की दिशा में हमारे बढ़ते कदम</p>
        </div>

        <div class="space-y-12">
            @forelse($events ?? [] as $index => $event)
                <div class="group bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 flex flex-col md:flex-row" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <!-- Event Image -->
                    <div class="md:w-2/5 relative overflow-hidden h-64 md:h-auto">
                        @if($event->image_path)
                            <img src="{{ Storage::url($event->image_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-saffron/10 to-saffron/20 flex items-center justify-center">
                                <svg class="w-20 h-20 text-saffron/30" fill="currentColor" viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/></svg>
                            </div>
                        @endif
                        <!-- Date Badge -->
                        <div class="absolute top-6 left-6 bg-saffron text-white p-4 rounded-3xl shadow-xl flex flex-col items-center justify-center min-w-[70px]">
                            <span class="text-2xl font-bold leading-none">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                            <span class="text-xs font-bold uppercase tracking-widest mt-1">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                        </div>
                    </div>

                    <!-- Event Details -->
                    <div class="md:w-3/5 p-8 md:p-12 flex flex-col justify-center">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="inline-flex items-center text-saffron font-bold text-sm bg-saffron/10 px-4 py-1 rounded-full uppercase tracking-widest">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                मुख्य आयोजन
                            </span>
                            <span class="text-gray-400 font-semibold text-sm">
                                {{ \Carbon\Carbon::parse($event->event_date)->format('Y') }}
                            </span>
                        </div>
                        <h3 class="text-3xl font-extrabold text-gray-900 mb-6 group-hover:text-saffron transition duration-300">
                            {{ $event->title }}
                        </h3>
                        <p class="text-gray-600 text-lg leading-relaxed mb-8">
                            {{ $event->description }}
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <a href="{{ route('event.show', $event->id) }}" class="inline-flex items-center font-bold text-saffron hover:text-saffronDark transition group/btn">
                                अधिक जानकारी 
                                <svg class="w-5 h-5 ml-2 transform group-hover/btn:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center" data-aos="fade-up">
                    <div class="bg-white rounded-[3rem] p-16 shadow-xl inline-block max-w-lg border-b-8 border-saffron">
                        <div class="w-24 h-24 bg-saffron/10 rounded-full flex items-center justify-center mx-auto mb-8 text-saffron">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-900 mb-4">अभी कोई आयोजन निर्धारित नहीं है।</h4>
                        <p class="text-gray-500 text-lg mb-10">नये आयोजनों की जानकारी के लिए कृपया हमारी वेबसाइट और सोशल मीडिया से जुड़े रहें।</p>
                        <a href="{{ route('home') }}" class="bg-saffron text-white font-bold py-4 px-10 rounded-full shadow-lg hover:bg-saffronDark transition">
                            होम पर वापस जाएँ
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Newsletter/Stay Connected -->
<div class="py-24 bg-gray-900 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl font-extrabold text-white mb-6" data-aos="fade-up">हमारे साथ जुड़े रहें</h2>
        <p class="text-gray-400 text-xl mb-12" data-aos="fade-up" data-aos-delay="100">ताज़ा समाचार और आयोजनों की सूचना सीधे अपने ईमेल पर प्राप्त करें।</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="200">
            <input type="email" placeholder="आपका ईमेल पता" class="px-8 py-5 bg-gray-800 border-none rounded-full text-white w-full sm:w-96 focus:ring-2 focus:ring-saffron">
            <button class="bg-saffron text-white font-bold py-5 px-12 rounded-full shadow-2xl hover:bg-saffronDark transition transform hover:scale-110">
                सब्सक्राइब करें
            </button>
        </div>
    </div>
</div>
@endsection
