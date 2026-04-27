@extends('frontend.layout')

@section('content')
<!-- Hero Section -->
<div class="relative py-24 bg-gray-900 overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6" data-aos="fade-down">
            संपर्क करें <span class="text-saffron">CONTACT US</span>
        </h1>
        <div class="w-24 h-1 bg-saffron mx-auto rounded-full mb-8" data-aos="zoom-in" data-aos-delay="200"></div>
        <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="300">
            आपकी आवाज़ हमारे लिए महत्वपूर्ण है। किसी भी सुझाव, प्रश्न या सहायता के लिए हमसे बेझिझक संपर्क करें।
        </p>
    </div>
</div>

<div class="bg-white py-24 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-16">
            
            <!-- Contact Info & Map -->
            <div class="lg:w-1/2" data-aos="fade-right">
                <h2 class="text-4xl font-extrabold text-gray-900 mb-8">मुख्यालय एवं संपर्क विवरण</h2>
                <div class="space-y-8 mb-12">
                    <div class="flex items-start p-6 bg-gray-50 rounded-3xl border-l-8 border-saffron shadow-sm hover:shadow-md transition">
                        <div class="w-14 h-14 bg-saffron/10 rounded-2xl flex items-center justify-center text-saffron mr-6 flex-shrink-0">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-1">हमारा पता</h4>
                            <p class="text-gray-600 text-lg whitespace-pre-line">{{ \App\Models\Setting::getVal('site_address', "123, भगवा भवन, मुख्य रोड, नई दिल्ली - 110001") }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start p-6 bg-gray-50 rounded-3xl border-l-8 border-navyBlue shadow-sm hover:shadow-md transition">
                        <div class="w-14 h-14 bg-navyBlue/10 rounded-2xl flex items-center justify-center text-navyBlue mr-6 flex-shrink-0">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-1">ईमेल आईडी</h4>
                            <p class="text-gray-600 text-lg whitespace-pre-line">{{ \App\Models\Setting::getVal('site_email', "contact@bhagva.org\nsupport@bhagva.org") }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start p-6 bg-gray-50 rounded-3xl border-l-8 border-saffron shadow-sm hover:shadow-md transition">
                        <div class="w-14 h-14 bg-saffron/10 rounded-2xl flex items-center justify-center text-saffron mr-6 flex-shrink-0">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-1">संपर्क नंबर</h4>
                            <p class="text-gray-600 text-lg whitespace-pre-line">{{ \App\Models\Setting::getVal('site_phone', "+91 98765 43210\n011-2345678") }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Simple Map Placeholder -->
                <div class="rounded-[2rem] overflow-hidden shadow-2xl h-80 bg-gray-200 relative border-4 border-white">
                    @if(\App\Models\Setting::getVal('site_map_iframe'))
                        {!! \App\Models\Setting::getVal('site_map_iframe') !!}
                    @else
                        <iframe class="w-full h-full grayscale opacity-70" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224345.8392319277!2d77.0688975472!3d28.527218140000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd5b34766247%3A0xaa828a2046830722!2sNew%20Delhi%2C%20Delhi!5e0!3m2!1sen!2sin!4v1650000000000!5m2!1sen!2sin" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    @endif
                    <div class="absolute inset-0 pointer-events-none bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:w-1/2" data-aos="fade-left">
                <div class="bg-white p-10 md:p-16 rounded-[3rem] shadow-2xl border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-saffron/5 rounded-bl-[100%]"></div>
                    
                    <h3 class="text-3xl font-extrabold text-gray-900 mb-2">हमें संदेश भेजें</h3>
                    <p class="text-gray-500 mb-10 font-semibold">हम 24-48 घंटों के भीतर उत्तर देने का प्रयास करते हैं।</p>
                    
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-3">आपका नाम</label>
                                <input type="text" name="name" required class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300" placeholder="उदा. राहुल कुमार">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-3">ईमेल पता</label>
                                <input type="email" name="email" required class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300" placeholder="email@example.com">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-bold mb-3">विषय</label>
                            <input type="text" name="subject" class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300" placeholder="संदेश का विषय">
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-bold mb-3">आपका संदेश</label>
                            <textarea name="message" rows="5" required class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300" placeholder="यहाँ अपना संदेश विस्तार से लिखें..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-saffron text-white font-bold py-5 px-8 rounded-2xl shadow-xl shadow-saffron/30 hover:bg-saffronDark transition transform hover:scale-[1.02] flex items-center justify-center">
                            <span>संदेश भेजें</span>
                            <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection
