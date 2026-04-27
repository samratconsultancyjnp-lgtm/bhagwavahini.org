@extends('admin.layout')

@section('content')
<div class="mb-10 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800">MANAGE TEAM</h1>
        <p class="text-slate-500 font-medium italic mt-1">Update leadership and core team profiles</p>
    </div>
</div>

<!-- Add Form -->
<div class="bg-white rounded-5xl p-10 mb-12 shadow-2xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-40 h-40 bg-blue-500/5 rounded-bl-full"></div>
    <h2 class="text-2xl font-black text-slate-800 mb-8 flex items-center">
        <div class="w-12 h-12 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </div>
        Add Team Member
    </h2>
    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <div>
                <label class="block text-slate-700 font-bold mb-3">Full Name</label>
                <input type="text" name="name" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all duration-300" placeholder="e.g. Rahul Sharma" required>
            </div>
            <div>
                <label class="block text-slate-700 font-bold mb-3">Designation</label>
                <input type="text" name="designation" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all duration-300" placeholder="e.g. State President" required>
            </div>
            <div>
                <label class="block text-slate-700 font-bold mb-3">Profile Photo</label>
                <input type="file" name="image" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-blue-500 focus:outline-none transition-all duration-300">
            </div>
            <div>
                <label class="block text-slate-700 font-bold mb-3">Display Order</label>
                <input type="number" name="order" value="0" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all duration-300">
            </div>
        </div>
        <button type="submit" class="bg-blue-600 text-white font-black py-4 px-12 rounded-2xl shadow-xl shadow-blue-500/30 hover:bg-blue-700 transition transform hover:scale-[1.02]">
            Save Member
        </button>
    </form>
</div>

<!-- List Table -->
<div class="overflow-hidden rounded-5xl border border-slate-100 shadow-xl bg-white">
    <table class="min-w-full divide-y divide-slate-100">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-8 py-6 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Profile</th>
                <th class="px-8 py-6 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Member Details</th>
                <th class="px-8 py-6 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Order</th>
                <th class="px-8 py-6 text-right text-xs font-black text-slate-400 uppercase tracking-widest">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($team as $member)
            <tr class="hover:bg-slate-50 transition duration-300">
                <td class="px-8 py-6 whitespace-nowrap">
                    @if($member->image_path)
                        <img src="{{ Storage::url($member->image_path) }}" class="h-16 w-16 rounded-2xl object-cover shadow-lg border-4 border-white">
                    @else
                        <div class="h-16 w-16 rounded-2xl bg-slate-200 flex items-center justify-center text-slate-400">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        </div>
                    @endif
                </td>
                <td class="px-8 py-6">
                    <div class="text-xl font-black text-slate-800">{{ $member->name }}</div>
                    <div class="text-xs font-bold text-saffron uppercase tracking-widest mt-1">{{ $member->designation }}</div>
                </td>
                <td class="px-8 py-6">
                    <span class="px-4 py-1 bg-slate-100 text-slate-500 rounded-full font-black text-xs">{{ $member->order }}</span>
                </td>
                <td class="px-8 py-6 text-right whitespace-nowrap">
                    <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Delete this member?');" class="inline-block">
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
