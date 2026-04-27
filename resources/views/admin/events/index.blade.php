@extends('admin.layout')

@section('content')
<div class="mb-10 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800">MANAGE EVENTS</h1>
        <p class="text-slate-500 font-medium italic mt-1">Schedule and publish party rallies or meetings</p>
    </div>
</div>

<!-- Add Form -->
<div class="bg-white rounded-5xl p-10 mb-12 shadow-2xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-40 h-40 bg-green-500/5 rounded-bl-full"></div>
    <h2 class="text-2xl font-black text-slate-800 mb-8 flex items-center">
        <div class="w-12 h-12 bg-green-500/10 rounded-2xl flex items-center justify-center text-green-500 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        Schedule New Event
    </h2>
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div>
                <label class="block text-slate-700 font-bold mb-3 tracking-wide">Event Title</label>
                <input type="text" name="title" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-green-500 focus:bg-white focus:outline-none transition-all duration-300" placeholder="e.g. Mega Rally 2026" required>
            </div>
            <div>
                <label class="block text-slate-700 font-bold mb-3 tracking-wide">Event Date</label>
                <input type="date" name="event_date" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-green-500 focus:bg-white focus:outline-none transition-all duration-300" required>
            </div>
            <div>
                <label class="block text-slate-700 font-bold mb-3 tracking-wide">Event Banner</label>
                <input type="file" name="image" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-green-500 focus:outline-none transition-all duration-300">
            </div>
        </div>
        <div class="mb-8">
            <label class="block text-slate-700 font-bold mb-3 tracking-wide">Detailed Description</label>
            <textarea name="description" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-green-500 focus:bg-white focus:outline-none transition-all duration-300" rows="3" placeholder="Describe the event location, purpose, and key speakers..."></textarea>
        </div>
        <button type="submit" class="bg-green-600 text-white font-black py-4 px-12 rounded-2xl shadow-xl shadow-green-500/30 hover:bg-green-700 transition transform hover:scale-[1.02]">
            Save & Publish Event
        </button>
    </form>
</div>

<!-- List Table -->
<div class="overflow-hidden rounded-5xl border border-slate-100 shadow-xl bg-white">
    <table class="min-w-full divide-y divide-slate-100">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-8 py-6 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Banner</th>
                <th class="px-8 py-6 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Event Information</th>
                <th class="px-8 py-6 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Date</th>
                <th class="px-8 py-6 text-right text-xs font-black text-slate-400 uppercase tracking-widest">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($events as $event)
            <tr class="hover:bg-slate-50 transition duration-300">
                <td class="px-8 py-6 whitespace-nowrap">
                    @if($event->image_path)
                        <img src="{{ Storage::url($event->image_path) }}" class="h-16 w-28 rounded-2xl object-cover shadow-lg border-2 border-white">
                    @else
                        <div class="h-16 w-28 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                </td>
                <td class="px-8 py-6">
                    <div class="text-xl font-black text-slate-800 tracking-tight uppercase">{{ $event->title }}</div>
                    <div class="text-xs font-bold text-slate-400 mt-1 line-clamp-1 italic max-w-md">{{ $event->description }}</div>
                </td>
                <td class="px-8 py-6">
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        <span class="font-black text-slate-700 text-sm tracking-tight">{{ \Carbon\Carbon::parse($event->event_date)->format('D, d M Y') }}</span>
                    </div>
                </td>
                <td class="px-8 py-6 text-right whitespace-nowrap">
                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Delete this event?');" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-50 text-red-500 p-4 rounded-2xl hover:bg-red-500 hover:text-white transition shadow-sm border border-red-100 group">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
