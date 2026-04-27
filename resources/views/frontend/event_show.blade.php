@extends('frontend.layout')

@section('content')
<!-- Hero Section -->
<div class="relative pt-32 pb-24 bg-gray-900 overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    
    <!-- Dynamic Background Image Blur -->
    @if($event->image_path)
        <div class="absolute inset-0 opacity-30 bg-cover bg-center blur-xl transform scale-110" style="background-image: url('{{ Storage::url($event->image_path) }}')"></div>
    @endif
    
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
    
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <a href="{{ route('events') }}" class="inline-flex items-center text-saffron hover:text-white font-bold mb-8 transition group">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            सभी आयोजनों पर वापस जाएँ
        </a>
        
        <div class="flex items-center space-x-4 mb-6" data-aos="fade-down">
            <span class="inline-flex items-center text-gray-900 font-bold text-sm bg-saffron px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg shadow-saffron/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}
            </span>
        </div>
        
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight" data-aos="fade-up" data-aos-delay="100">
            {{ $event->title }}
        </h1>
        
        <div class="w-24 h-1.5 bg-saffron rounded-full" data-aos="zoom-in" data-aos-delay="200"></div>
    </div>
</div>

<!-- Event Content Section -->
<div class="bg-gray-50 py-16 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-gray-100 -mt-32 relative z-20" data-aos="fade-up" data-aos-delay="300">
            
            @if($event->image_path)
                <div class="w-full h-[400px] md:h-[500px] relative">
                    <img src="{{ Storage::url($event->image_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                </div>
            @endif

            <div class="p-8 md:p-16">
                <div class="prose prose-lg md:prose-xl max-w-none prose-headings:text-gray-900 prose-a:text-saffron">
                    <p class="text-gray-700 leading-loose text-xl whitespace-pre-line">
                        {{ $event->description }}
                    </p>
                </div>
                
                <div class="mt-16 pt-10 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-500 font-bold uppercase tracking-wider text-sm">इस जानकारी को साझा करें:</span>
                        <div class="flex space-x-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($event->title) }}" target="_blank" class="w-10 h-10 rounded-full bg-sky-50 text-sky-500 flex items-center justify-center hover:bg-sky-500 hover:text-white transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($event->title . ' - ' . request()->fullUrl()) }}" target="_blank" class="w-10 h-10 rounded-full bg-green-50 text-green-500 flex items-center justify-center hover:bg-green-500 hover:text-white transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.126.554 4.195 1.606 6.015L.178 24l6.103-1.599A11.968 11.968 0 0012.031 24c6.646 0 12.031-5.385 12.031-12.031S18.677 0 12.031 0zm3.842 17.202c-.173.486-.998.922-1.423.963-.424.04-1.026.13-2.909-.643-2.298-.944-3.765-3.328-3.88-3.482-.115-.153-.925-1.23-.925-2.346 0-1.115.586-1.666.79-1.895.204-.23.443-.288.595-.288.153 0 .307.001.442.007.139.006.326-.056.51.393.185.448.629 1.536.685 1.651.056.115.093.25.016.403-.076.153-.115.25-.23.385-.115.134-.243.294-.346.391-.11.103-.225.215-.102.428.122.212.544.898 1.168 1.455.805.719 1.479.941 1.694 1.056.215.115.342.096.47-.045.128-.14.549-.636.697-.855.148-.218.295-.181.49-.11.194.07 1.232.58 1.444.686.211.105.352.158.403.245.051.088.051.512-.122.998z"/></svg>
                            </a>
                        </div>
                    </div>
                    
                    <a href="{{ route('join') }}" class="bg-saffron text-white font-bold py-4 px-10 rounded-full shadow-xl hover:bg-saffronDark transition transform hover:scale-105 inline-block text-center">
                        दल से जुड़ें
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
