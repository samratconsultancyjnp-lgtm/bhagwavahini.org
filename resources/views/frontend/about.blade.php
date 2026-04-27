@extends('frontend.layout')

@section('content')
<!-- Hero Section -->
<div class="relative py-24 bg-gray-900 overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6" data-aos="fade-down">
            हमारे बारे में <span class="text-saffron">ABOUT US</span>
        </h1>
        <div class="w-24 h-1 bg-saffron mx-auto rounded-full mb-8" data-aos="zoom-in" data-aos-delay="200"></div>
        <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="300">
            भगवा दल एक विचारधारा है, एक संकल्प है और एक भविष्य है। हम भारत की गौरवशाली विरासत को संजोते हुए आधुनिक भारत के निर्माण के लिए समर्पित हैं।
        </p>
    </div>
</div>

<!-- About Section with Image -->
<div class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="lg:w-1/2" data-aos="fade-right">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-saffron/10 rounded-full animate-pulse"></div>
                    <img src="{{ asset('images/hero.png') }}" alt="Bhagva Party" class="rounded-2xl shadow-2xl relative z-10 border-b-8 border-saffron">
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-saffron/20 rounded-2xl rotate-12 -z-0"></div>
                </div>
            </div>
            <div class="lg:w-1/2" data-aos="fade-left">
                <h2 class="text-saffron font-bold tracking-widest uppercase mb-4">हमारी कहानी</h2>
                <h3 class="text-4xl font-extrabold text-gray-900 mb-6">राष्ट्र प्रथम, संस्कृति सदैव</h3>
                <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                    भगवा दल की स्थापना भारत के सांस्कृतिक मूल्यों और लोकतांत्रिक आदर्शों के संगम के रूप में की गई थी। हमारा मानना है कि देश की प्रगति तभी संभव है जब हम अपनी जड़ों से जुड़े रहें।
                </p>
                <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                    हमारा उद्देश्य केवल सत्ता नहीं, बल्कि समाज के अंतिम व्यक्ति तक विकास के लाभ पहुँचाना है। हम "अंत्योदय" के सिद्धांत पर चलते हैं, जहाँ समाज का सबसे पिछला व्यक्ति हमारी पहली प्राथमिकता है।
                </p>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-3xl font-extrabold text-saffron mb-2">20+</p>
                        <p class="text-gray-500 font-semibold">वर्षों का समर्पण</p>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold text-saffron mb-2">10M+</p>
                        <p class="text-gray-500 font-semibold">विश्वसनीय सदस्य</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Vision & Mission Grid -->
<div class="py-24 bg-gray-50 border-y">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Vision -->
            <div class="bg-white p-12 rounded-3xl shadow-xl border-t-8 border-saffron" data-aos="fade-up">
                <div class="w-16 h-16 bg-saffron/10 rounded-2xl flex items-center justify-center text-saffron mb-8">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 class="text-3xl font-extrabold text-gray-900 mb-6">हमारा विज़न (Vision)</h3>
                <p class="text-gray-600 text-lg leading-relaxed italic">
                    "एक ऐसा भारत जहाँ संस्कृति, धर्म, और राष्ट्रप्रेम के मूल्यों का सम्मान हो। एक ऐसा राष्ट्र जो विश्वगुरु बनकर पूरे विश्व को शांति और ज्ञान का मार्ग दिखाए।"
                </p>
            </div>
            
            <!-- Mission -->
            <div class="bg-white p-12 rounded-3xl shadow-xl border-t-8 border-navyBlue" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-navyBlue/10 rounded-2xl flex items-center justify-center text-navyBlue mb-8">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-3xl font-extrabold text-gray-900 mb-6">हमारा मिशन (Mission)</h3>
                <p class="text-gray-600 text-lg leading-relaxed italic">
                    "सनातन मूल्यों की रक्षा करते हुए समाज के अंतिम व्यक्ति तक विकास पहुँचाना। शिक्षा, स्वास्थ्य और सुरक्षा के माध्यम से हर भारतीय को सशक्त बनाना।"
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Values Section -->
<div class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4" data-aos="fade-up">हमारे मूल मूल्य (Our Values)</h2>
            <div class="w-24 h-1 bg-saffron mx-auto rounded-full" data-aos="fade-up" data-aos-delay="100"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $values = [
                    ['title' => 'सत्य और ईमानदारी', 'desc' => 'प्रशासन में पारदर्शिता और सच्चाई ही हमारी शक्ति है।'],
                    ['title' => 'सामाजिक न्याय', 'desc' => 'जाति, धर्म या वर्ग के भेदभाव के बिना सभी को समान अवसर।'],
                    ['title' => 'राष्ट्रवाद', 'desc' => 'देश के हितों को निजी या राजनीतिक स्वार्थ से ऊपर रखना।'],
                    ['title' => 'सांस्कृतिक गौरव', 'desc' => 'अपनी प्राचीन विरासत और धरोहर का संरक्षण और सम्मान।'],
                    ['title' => 'लोकतंत्र', 'desc' => 'जनता की आवाज़ और उनके अधिकारों की सुरक्षा।'],
                    ['title' => 'सशक्तिकरण', 'desc' => 'युवाओं और महिलाओं को आत्मनिर्भर और कुशल बनाना।'],
                ];
            @endphp
            @foreach($values as $index => $val)
            <div class="p-8 border rounded-2xl hover:bg-gray-50 transition border-saffron/20 shadow-sm" data-aos="zoom-in" data-aos-delay="{{ $index * 50 }}">
                <h4 class="text-xl font-bold text-saffron mb-4">{{ $val['title'] }}</h4>
                <p class="text-gray-600 leading-relaxed">{{ $val['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Premium Chairman Message Section -->
<div class="py-24 bg-gray-900 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-800 rounded-[3rem] p-12 md:p-20 relative flex flex-col md:flex-row items-center gap-12 border-b-8 border-saffron">
            <div class="w-64 h-64 flex-shrink-0 relative" data-aos="zoom-in">
                <img src="{{ asset('images/chairman.png') }}" alt="Chairman" class="w-full h-full object-cover rounded-full border-4 border-saffron shadow-2xl relative z-10">
            </div>
            
            <div class="relative z-10 text-center md:text-left" data-aos="fade-left">
                <h2 class="text-saffron font-bold text-xl mb-4">अध्यक्ष का संदेश</h2>
                <p class="text-white text-2xl md:text-3xl font-bold leading-relaxed mb-8">
                    "हमारा संकल्प है कि हम भारत को विश्व पटल पर सर्वश्रेष्ठ राष्ट्र बनाएंगे और सांस्कृतिक धरोहर को सहेजते हुए आधुनिक भारत का निर्माण करेंगे। आइए, इस महायज्ञ में हमारे साथ जुड़ें।"
                </p>
                <p class="text-gray-400 text-xl font-semibold">श्री राष्ट्रीय अध्यक्ष</p>
            </div>
        </div>
    </div>
</div>
@endsection
