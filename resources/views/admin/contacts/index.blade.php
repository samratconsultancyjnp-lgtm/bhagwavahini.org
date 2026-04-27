@extends('admin.layout')

@section('content')
<div class="mb-10 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800 uppercase tracking-tighter">MESSAGES</h1>
        <p class="text-slate-500 font-medium italic mt-1 text-sm">Read and respond to public inquiries</p>
    </div>
</div>

<div class="overflow-hidden rounded-5xl border border-slate-100 shadow-2xl bg-white">
    <table class="min-w-full divide-y divide-slate-100">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-8 py-6 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Sender</th>
                <th class="px-8 py-6 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Email Address</th>
                <th class="px-8 py-6 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Message Content</th>
                <th class="px-8 py-6 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Received Date</th>
                <th class="px-8 py-6 text-right text-xs font-black text-slate-400 uppercase tracking-widest">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($contacts as $contact)
            <tr class="hover:bg-slate-50 transition duration-300">
                <td class="px-8 py-6 whitespace-nowrap">
                    <div class="text-lg font-black text-slate-800 tracking-tight">{{ $contact->name }}</div>
                </td>
                <td class="px-8 py-6 whitespace-nowrap">
                    <div class="text-xs font-bold text-blue-500 underline tracking-wide">{{ $contact->email }}</div>
                </td>
                <td class="px-8 py-6">
                    <div class="text-sm text-slate-600 font-medium line-clamp-1 italic">"{{ $contact->message }}"</div>
                </td>
                <td class="px-8 py-6">
                    <div class="text-xs font-black text-slate-400 tracking-tighter">{{ $contact->created_at->format('D, d M Y') }}</div>
                </td>
                <td class="px-8 py-6 text-right whitespace-nowrap">
                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Delete this message?');" class="inline-block">
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
