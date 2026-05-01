<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ \App\Models\Setting::getVal('site_name', 'Bhagva.org') }} - Political Party</title>
    @if(\App\Models\Setting::getVal('site_favicon'))
        <link rel="icon" href="{{ Storage::url(\App\Models\Setting::getVal('site_favicon')) }}">
    @else
        <link rel="icon" href="{{ asset('images/logo.jpg') }}">
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        saffron: '#FF9933',
                        saffronDark: '#E68A2E',
                        saffronLight: '#FFB870',
                        greenColor: '#138808',
                        navyBlue: '#000080'
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi:ital@0;1&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', 'Tiro Devanagari Hindi', serif; 
            background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
        }
        .bg-saffron-gradient {
            background: linear-gradient(135deg, #FF9933 0%, #FFCC33 100%);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <nav class="bg-white text-gray-800 shadow-md sticky top-0 z-50 border-b-4 border-saffron">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center font-bold text-3xl tracking-wider text-saffron">
                        @if(\App\Models\Setting::getVal('site_logo'))
                            <img src="{{ Storage::url(\App\Models\Setting::getVal('site_logo')) }}" alt="Logo" class="h-16 w-16 mr-3 rounded-full border-2 border-saffron shadow-sm object-cover">
                        @else
                            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-16 w-16 mr-3 rounded-full border-2 border-saffron shadow-sm object-cover">
                        @endif
                        {{ \App\Models\Setting::getVal('site_name', 'भगवा दल') }}
                    </a>
                </div>
                <div class="hidden lg:flex lg:items-center lg:space-x-8 text-lg font-semibold">
                    <a href="{{ route('home') }}" class="hover:text-saffron transition">होम</a>
                    <a href="{{ route('about') }}" class="hover:text-saffron transition">हमारे बारे में</a>
                    <a href="{{ route('team') }}" class="hover:text-saffron transition">हमारी टीम</a>
                    <a href="{{ route('gallery') }}" class="hover:text-saffron transition">गैलरी</a>
                    <a href="{{ route('events') }}" class="hover:text-saffron transition">आयोजन</a>
                    <a href="{{ route('contact') }}" class="hover:text-saffron transition text-gray-600">संपर्क</a>
                    <a href="{{ route('download.id') }}" class="hover:text-saffron transition font-bold text-saffron">ID Card डाउनलोड</a>
                    <a href="{{ route('donations') }}" class="hover:text-saffron transition font-bold text-greenColor">दान करें</a>

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-saffron transition">डैशबोर्ड</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-saffron transition">लॉगिन</a>
                    @endauth
                    <a href="{{ route('join') }}" class="bg-saffron text-white py-2 px-6 rounded-full shadow-lg hover:bg-saffronDark transition transform hover:scale-105">जुड़ें</a>
                </div>
                <div class="flex items-center lg:hidden">
                    <button id="mobile-menu-btn" class="text-saffron hover:text-saffronDark focus:outline-none p-2 border-2 border-saffron rounded-lg shadow-sm">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Container -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-b-4 border-saffron absolute left-0 top-full w-full shadow-2xl z-40 transform origin-top transition-transform duration-300">
            <div class="px-4 pt-2 pb-6 space-y-2 text-center flex flex-col items-center">
                <a href="{{ route('home') }}" class="block w-full py-3 text-lg font-bold text-gray-800 hover:text-saffron hover:bg-saffron/5 rounded-xl transition">होम</a>
                <a href="{{ route('about') }}" class="block w-full py-3 text-lg font-bold text-gray-800 hover:text-saffron hover:bg-saffron/5 rounded-xl transition">हमारे बारे में</a>
                <a href="{{ route('team') }}" class="block w-full py-3 text-lg font-bold text-gray-800 hover:text-saffron hover:bg-saffron/5 rounded-xl transition">हमारी टीम</a>
                <a href="{{ route('gallery') }}" class="block w-full py-3 text-lg font-bold text-gray-800 hover:text-saffron hover:bg-saffron/5 rounded-xl transition">गैलरी</a>
                <a href="{{ route('events') }}" class="block w-full py-3 text-lg font-bold text-gray-800 hover:text-saffron hover:bg-saffron/5 rounded-xl transition">आयोजन</a>
                <a href="{{ route('contact') }}" class="block w-full py-3 text-lg font-bold text-gray-800 hover:text-saffron hover:bg-saffron/5 rounded-xl transition">संपर्क</a>
                <a href="{{ route('download.id') }}" class="block w-full py-3 text-lg font-black text-saffron hover:text-saffronDark hover:bg-saffron/5 rounded-xl transition">ID Card डाउनलोड करें</a>
                <a href="{{ route('donations') }}" class="block w-full py-3 text-lg font-black text-greenColor hover:text-green-700 hover:bg-green-50 rounded-xl transition">दान (Donation) करें</a>

                
                <div class="w-24 h-[2px] bg-saffron/20 my-2"></div>
                
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="block w-full py-3 text-lg font-bold text-gray-800 hover:text-saffron hover:bg-saffron/5 rounded-xl transition">डैशबोर्ड</a>
                @else
                    <a href="{{ route('login') }}" class="block w-full py-3 text-lg font-bold text-gray-800 hover:text-saffron hover:bg-saffron/5 rounded-xl transition">लॉगिन</a>
                @endauth
                <a href="{{ route('join') }}" class="inline-block mt-4 bg-saffron text-white py-3 px-10 rounded-full font-bold shadow-lg hover:bg-saffronDark transition transform hover:scale-105">जुड़ें</a>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    <main class="flex-grow">
        @if(session('success'))
            <div class="max-w-7xl mx-auto mt-4 px-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="max-w-7xl mx-auto mt-4 px-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-950 text-white mt-12 border-t-4 border-saffron pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <!-- Column 1: Brand & Logo -->
                <div class="col-span-1">
                    <div class="flex items-center mb-6">
                        @if(\App\Models\Setting::getVal('site_logo'))
                            <img src="{{ Storage::url(\App\Models\Setting::getVal('site_logo')) }}" alt="Logo" class="h-14 w-14 mr-3 rounded-full border-2 border-saffron object-cover">
                        @else
                            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-14 w-14 mr-3 rounded-full border-2 border-saffron object-cover">
                        @endif
                        <span class="text-2xl font-bold text-white tracking-wider">{{ \App\Models\Setting::getVal('site_name', 'भगवा दल') }}</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        हमारा संकल्प है एक समृद्ध, सुरक्षित और सांस्कृतिक रूप से सशक्त भारत का निर्माण। जन-जन तक विकास पहुँचाना ही हमारा लक्ष्य है।
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-saffron transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-saffron transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-saffron transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.975.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.058-1.281.072-1.689.072-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98-1.281-.058-1.689-.072-4.948-.072zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="col-span-1">
                    <h3 class="text-lg font-bold text-saffron mb-6">त्वरित लिंक</h3>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">होम</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">हमारे बारे में</a></li>
                        <li><a href="{{ route('team') }}" class="hover:text-white transition">हमारी टीम</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-white transition">गैलरी</a></li>
                        <li><a href="{{ route('donations') }}" class="hover:text-white transition">दान करें</a></li>

                    </ul>
                </div>

                <!-- Column 3: Important Sections -->
                <div class="col-span-1">
                    <h3 class="text-lg font-bold text-saffron mb-6">महत्वपूर्ण</h3>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="{{ route('events') }}" class="hover:text-white transition">आगामी आयोजन</a></li>
                        <li><a href="{{ route('join') }}" class="hover:text-white transition">सदस्य बनें</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">शिकायत एवं सुझाव</a></li>
                        <li><a href="#" class="hover:text-white transition">गोपनीयता नीति</a></li>
                    </ul>
                </div>

                <!-- Column 4: Contact Info -->
                <div class="col-span-1">
                    <h3 class="text-lg font-bold text-saffron mb-6">संपर्क जानकारी</h3>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-saffron mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="whitespace-pre-line">{{ \App\Models\Setting::getVal('site_address', "123, भगवा भवन, \nनई दिल्ली, भारत 110001") }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-saffron mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span class="whitespace-pre-line">{{ \App\Models\Setting::getVal('site_email', "contact@bhagva.org") }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-saffron mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span class="whitespace-pre-line">{{ \App\Models\Setting::getVal('site_phone', "+91 98765 43210") }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Line -->
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm mb-4 md:mb-0">
                    &copy; {{ date('Y') }} {{ \App\Models\Setting::getVal('site_name', 'भगवा दल') }}. सर्वाधिकार सुरक्षित।
                </p>
                <div class="text-gray-500 text-sm flex items-center gap-2">
                    Designed & Developed by
                    <a href="https://samratconsultancy.in/"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="group inline-flex items-center gap-1 font-bold text-saffron hover:text-white transition-all duration-300 relative">
                        <span class="relative">
                            SAMRAT CONSULTANCY &amp; IT WORLD PVT. LTD.
                            <span class="absolute -bottom-0.5 left-0 w-0 h-[1.5px] bg-saffron group-hover:w-full transition-all duration-300 rounded-full"></span>
                        </span>
                        <svg class="w-3.5 h-3.5 opacity-60 group-hover:opacity-100 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
</body>
</html>
