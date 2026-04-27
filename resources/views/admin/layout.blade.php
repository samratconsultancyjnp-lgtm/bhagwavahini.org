<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Admin - {{ \App\Models\Setting::getVal('site_name', 'Bhagva.org') }}</title>
    @if(\App\Models\Setting::getVal('site_favicon'))
        <link rel="icon" href="{{ Storage::url(\App\Models\Setting::getVal('site_favicon')) }}">
    @else
        <link rel="icon" href="{{ asset('images/logo.jpg') }}">
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Tiro+Devanagari+Hindi&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        saffron: '#FF9933',
                        saffronDark: '#E68A2E',
                        saffronLight: '#FFCC66',
                        deepNavy: '#0F172A',
                        glass: 'rgba(255, 255, 255, 0.1)',
                    },
                    borderRadius: {
                        '4xl': '2rem',
                        '5xl': '3rem',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Outfit', 'Tiro Devanagari Hindi', sans-serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .sidebar-active {
            background: linear-gradient(135deg, #FF9933 0%, #FF6600 100%);
            box-shadow: 0 10px 20px -5px rgba(255, 102, 0, 0.4);
            color: white !important;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] flex h-screen overflow-hidden text-slate-700">

    <!-- Premium Sidebar -->
    <div class="w-72 bg-deepNavy flex flex-col hidden lg:flex relative overflow-hidden flex-shrink-0">
        <!-- Abstract background glow -->
        <div class="absolute top-[-10%] right-[-20%] w-64 h-64 bg-saffron/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[-10%] left-[-20%] w-64 h-64 bg-blue-500/10 rounded-full blur-[100px]"></div>

        <div class="flex flex-col h-full relative z-10">
            <!-- Logo Section -->
            <div class="px-6 pt-8 pb-4">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="p-1 bg-white rounded-xl shadow-xl shadow-saffron/20 flex-shrink-0">
                        @if(\App\Models\Setting::getVal('site_logo'))
                            <img src="{{ Storage::url(\App\Models\Setting::getVal('site_logo')) }}" alt="Logo" class="h-8 w-8 rounded-lg object-cover">
                        @else
                            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-8 w-8 rounded-lg object-cover">
                        @endif
                    </div>
                    <div>
                        <h1 class="text-md font-extrabold text-white tracking-tighter uppercase">{{ \App\Models\Setting::getVal('site_name', 'Bhagva') }} <span class="text-saffron">CMS</span></h1>
                        <p class="text-[9px] text-slate-500 font-bold tracking-[0.2em] uppercase">Suite v2.0</p>
                    </div>
                </div>
            </div>

            <!-- Scrollable Nav Section -->
            <div class="flex-1 overflow-y-auto px-4 space-y-1 custom-scrollbar">
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route' => 'admin.sliders.index', 'label' => 'Sliders', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['route' => 'admin.team.index', 'label' => 'Our Team', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                        ['route' => 'admin.gallery.index', 'label' => 'Gallery', 'icon' => 'M4 5a1 1 0 011-1h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5z M4 5v14l8-8 8 8V5z'],
                        ['route' => 'admin.events.index', 'label' => 'Events', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['route' => 'admin.settings.index', 'label' => 'Settings', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['route' => 'admin.members.index', 'label' => 'Join Requests', 'icon' => 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z'],
                        ['route' => 'admin.designations.index', 'label' => 'Designations', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['route' => 'admin.contacts.index', 'label' => 'Messages', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="flex items-center px-3 py-2 rounded-lg transition-all duration-300 group {{ request()->routeIs($item['route']) ? 'sidebar-active' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        <div class="w-8 h-8 flex items-center justify-center mr-2 flex-shrink-0">
                            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold tracking-tight">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>

            <!-- Profile Section -->
            <div class="p-4">
                <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-8 h-8 rounded-full bg-saffron flex items-center justify-center text-white font-bold text-xs">A</div>
                        <div>
                            <p class="text-[10px] font-bold text-white">Administrator</p>
                            <p class="text-[9px] text-slate-500 font-bold uppercase">Online</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white py-2 rounded-lg font-bold transition-all duration-300 text-[10px]">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main View Area -->
    <div class="flex-1 flex flex-col relative overflow-hidden">
        <!-- Dynamic Header -->
        <header class="h-20 px-10 flex items-center justify-between relative z-20">
            <div>
                <h2 class="text-2xl font-black text-slate-800 tracking-tight uppercase">Dashboard</h2>
            </div>
            
            <div class="flex items-center space-x-8">
                <a href="{{ route('home') }}" class="group flex items-center space-x-3 bg-white px-6 py-3 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl transition-all duration-500" target="_blank">
                    <span class="w-8 h-8 bg-saffron/10 rounded-lg flex items-center justify-center text-saffron">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </span>
                    <span class="font-bold text-slate-700">Live Website</span>
                </a>
                
                <div class="relative">
                    <div class="w-12 h-12 bg-white rounded-2xl shadow-sm border border-slate-200 flex items-center justify-center text-slate-500 cursor-pointer hover:text-saffron transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full border-4 border-[#F8FAFC]"></span>
                </div>
            </div>
        </header>

        <!-- Main Scrolling Content -->
        <main class="flex-1 overflow-y-auto px-10 pb-10 relative z-10 scroll-smooth">
            @if(session('success'))
                <div class="mb-8 animate-float">
                    <div class="bg-green-500 text-white px-8 py-4 rounded-3xl shadow-xl shadow-green-500/20 flex items-center justify-between">
                        <span class="font-bold tracking-wide">{{ session('success') }}</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            @endif

            <div class="relative min-h-full">
                @yield('content')
            </div>
        </main>

        <!-- Dynamic Background Elements -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-saffron/5 rounded-full blur-[120px] -z-0"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-500/5 rounded-full blur-[120px] -z-0"></div>
    </div>

    <!-- Modals -->
    @stack('modals')

</body>
</html>
