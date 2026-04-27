@extends('admin.layout')

@section('content')
<div class="mb-10 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800 uppercase tracking-tighter">Manage Designations</h1>
        <p class="text-slate-500 font-medium italic mt-1 text-sm">Define and manage membership roles and positions</p>
    </div>
</div>

@if(session('success'))
    <div class="mb-6 px-5 py-4 rounded-2xl bg-green-50 border border-green-200 text-green-700 font-bold flex items-center gap-3">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
@endif

<!-- Add Form -->
<div class="bg-white rounded-5xl p-8 mb-12 shadow-2xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500/5 rounded-bl-full"></div>
    <h2 class="text-xl font-black text-slate-800 mb-6 flex items-center">
        <div class="w-10 h-10 bg-orange-500/10 rounded-2xl flex items-center justify-center text-orange-500 mr-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        </div>
        Create New Designation
    </h2>
    <form action="{{ route('admin.designations.store') }}" method="POST">
        @csrf
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="title" required
                       class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-orange-500 focus:bg-white focus:outline-none transition-all duration-300 font-bold text-slate-700"
                       placeholder="e.g. District President (जिला अध्यक्ष)">
            </div>
            <button type="submit" class="bg-orange-500 text-white font-black py-4 px-10 rounded-2xl shadow-xl shadow-orange-500/30 hover:bg-orange-600 transition transform hover:scale-[1.02] whitespace-nowrap">
                Add Designation
            </button>
        </div>
    </form>
</div>

<!-- List Table -->
<div class="bg-white rounded-4xl shadow-xl border border-slate-100 overflow-hidden">
    <table class="min-w-full divide-y divide-slate-100">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-8 py-5 text-left text-xs font-black text-slate-400 uppercase tracking-widest">#</th>
                <th class="px-8 py-5 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Designation Title</th>
                <th class="px-8 py-5 text-right text-xs font-black text-slate-400 uppercase tracking-widest">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($designations as $i => $d)
            <tr class="hover:bg-slate-50 transition duration-200">
                <td class="px-8 py-5 text-sm font-bold text-slate-400">{{ $i + 1 }}</td>
                <td class="px-8 py-5">
                    <span class="text-base font-black text-slate-800">{{ $d->title }}</span>
                </td>
                <td class="px-8 py-5 text-right">
                    <form action="{{ route('admin.designations.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Delete this designation? This will not affect existing members but will remove it from the joining form.');" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-red-500 bg-red-50 hover:bg-red-500 hover:text-white transition-all font-bold text-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-8 py-20 text-center">
                    <div class="flex flex-col items-center gap-3 text-slate-300">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <p class="font-bold text-lg text-slate-400">No designations added yet</p>
                        <p class="text-sm text-slate-300">Add positions above to show them in the membership form</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
