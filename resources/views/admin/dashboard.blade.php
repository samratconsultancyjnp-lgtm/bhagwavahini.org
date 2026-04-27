@extends('admin.layout')

@section('content')
<!-- Top Stats Section -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Members Card -->
    <div class="bg-white rounded-4xl p-6 shadow-xl shadow-slate-200/40 border border-slate-100 relative overflow-hidden group hover:-translate-y-1 transition-all duration-500">
        <div class="absolute top-0 right-0 w-24 h-24 bg-saffron/5 rounded-bl-full transition-transform group-hover:scale-110"></div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-saffron rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-saffron/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h3 class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mb-1">Total Members</h3>
            <div class="flex items-baseline space-x-2">
                <span class="text-4xl font-black text-slate-800 tracking-tighter">{{ $membersCount }}</span>
                <span class="text-green-500 font-bold text-[10px] px-2 py-0.5 bg-green-50 rounded-lg">({{ $paidMembersCount }} Paid)</span>
            </div>
        </div>
    </div>

    <!-- Events Card -->
    <div class="bg-white rounded-4xl p-6 shadow-xl shadow-slate-200/40 border border-slate-100 relative overflow-hidden group hover:-translate-y-1 transition-all duration-500">
        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/5 rounded-bl-full transition-transform group-hover:scale-110"></div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-blue-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-blue-500/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mb-1">Events</h3>
            <div class="flex items-baseline space-x-2">
                <span class="text-4xl font-black text-slate-800 tracking-tighter">{{ $eventsCount }}</span>
                <span class="text-blue-500 font-bold text-[10px] px-2 py-0.5 bg-blue-50 rounded-lg">Active</span>
            </div>
        </div>
    </div>

    <!-- Gallery Card -->
    <div class="bg-white rounded-4xl p-6 shadow-xl shadow-slate-200/40 border border-slate-100 relative overflow-hidden group hover:-translate-y-1 transition-all duration-500">
        <div class="absolute top-0 right-0 w-24 h-24 bg-purple-500/5 rounded-bl-full transition-transform group-hover:scale-110"></div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-purple-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-purple-500/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mb-1">Gallery</h3>
            <div class="flex items-baseline space-x-2">
                <span class="text-4xl font-black text-slate-800 tracking-tighter">{{ $galleryCount }}</span>
                <span class="text-purple-500 font-bold text-[10px] px-2 py-0.5 bg-purple-50 rounded-lg">Updated</span>
            </div>
        </div>
    </div>

    <!-- Messages Card -->
    <div class="bg-white rounded-4xl p-6 shadow-xl shadow-slate-200/40 border border-slate-100 relative overflow-hidden group hover:-translate-y-1 transition-all duration-500">
        <div class="absolute top-0 right-0 w-24 h-24 bg-red-500/5 rounded-bl-full transition-transform group-hover:scale-110"></div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-red-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-red-500/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mb-1">Messages</h3>
            <div class="flex items-baseline space-x-2">
                <span class="text-4xl font-black text-slate-800 tracking-tighter">0</span>
                <span class="text-red-500 font-bold text-[10px] px-2 py-0.5 bg-red-50 rounded-lg">Pending</span>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col lg:flex-row gap-8">
    <!-- Welcome Panel -->
    <div class="lg:w-2/3 bg-slate-900 rounded-4xl p-10 text-white relative overflow-hidden shadow-2xl shadow-slate-900/20">
        <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-saffron/10 rounded-full blur-[80px]"></div>
        <div class="relative z-10">
            <h2 class="text-3xl font-black mb-4">Welcome back, Admin!</h2>
            <p class="text-slate-400 text-lg leading-relaxed mb-10 max-w-lg">
                Your central command for managing Bhagva Dal's digital presence. Keep the movement growing.
            </p>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                <a href="{{ route('admin.members.index') }}" class="bg-white/5 border border-white/10 p-5 rounded-3xl hover:bg-white/10 transition cursor-pointer group">
                    <div class="w-10 h-10 bg-saffron rounded-xl flex items-center justify-center mb-3 transition-transform group-hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <p class="font-bold text-sm">New Member</p>
                </a>
                <a href="{{ route('admin.events.index') }}" class="bg-white/5 border border-white/10 p-5 rounded-3xl hover:bg-white/10 transition cursor-pointer group">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center mb-3 transition-transform group-hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="font-bold text-sm">New Event</p>
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="bg-white/5 border border-white/10 p-5 rounded-3xl hover:bg-white/10 transition cursor-pointer group">
                    <div class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center mb-3 transition-transform group-hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="font-bold text-sm">Gallery</p>
                </a>
            </div>
        </div>
    </div>

    <!-- Activity Panel -->
    <div class="lg:w-1/3 bg-white rounded-4xl p-8 shadow-xl shadow-slate-200/40 border border-slate-100">
        <h3 class="text-lg font-black text-slate-800 mb-8 flex items-center">
            <span class="w-1.5 h-6 bg-saffron rounded-full mr-3"></span>
            Recent Activities
        </h3>
        <div class="space-y-6">
            <div class="flex items-start space-x-3">
                <div class="w-2 h-2 rounded-full bg-saffron mt-1.5"></div>
                <div>
                    <p class="text-sm font-bold text-slate-800">New member registered</p>
                    <p class="text-[10px] text-slate-400 font-medium">2 mins ago</p>
                </div>
            </div>
            <div class="flex items-start space-x-3">
                <div class="w-2 h-2 rounded-full bg-blue-500 mt-1.5"></div>
                <div>
                    <p class="text-sm font-bold text-slate-800">Event "Mega Rally" updated</p>
                    <p class="text-[10px] text-slate-400 font-medium">15 mins ago</p>
                </div>
            </div>
            <div class="flex items-start space-x-3">
                <div class="w-2 h-2 rounded-full bg-purple-500 mt-1.5"></div>
                <div>
                    <p class="text-sm font-bold text-slate-800">5 new photos added to gallery</p>
                    <p class="text-[10px] text-slate-400 font-medium">1 hour ago</p>
                </div>
            </div>
        </div>
        <button class="w-full mt-10 bg-slate-50 text-slate-500 font-bold py-3.5 rounded-2xl hover:bg-slate-100 transition text-sm">
            View All
        </button>
    </div>
</div>
@endsection
