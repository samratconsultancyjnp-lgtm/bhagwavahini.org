@extends('admin.layout')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-black text-slate-800 tracking-tight uppercase mb-2">Donation Requests</h1>
    <p class="text-slate-500 font-medium">Manage and verify donation submissions from supporters.</p>
</div>

<div class="bg-white rounded-4xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Donor</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Amount & ID</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Proof</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Status</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($donations as $donation)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-2xl bg-saffron/10 flex items-center justify-center text-saffron font-black text-xl shadow-sm">
                                {{ strtoupper(substr($donation->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-slate-800 font-bold tracking-tight">{{ $donation->name }}</p>
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">{{ $donation->phone }}</p>
                                <p class="text-[10px] text-slate-400">{{ $donation->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-lg font-black text-slate-800 tracking-tighter">₹ {{ number_format($donation->amount, 2) }}</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">ID: {{ $donation->transaction_id }}</p>
                        <p class="text-[9px] text-slate-400">{{ $donation->created_at->format('d M Y, h:i A') }}</p>
                    </td>
                    <td class="px-8 py-6">
                        @if($donation->payment_proof)
                        <a href="{{ Storage::url($donation->payment_proof) }}" target="_blank" class="block w-16 h-16 rounded-xl overflow-hidden border-2 border-slate-100 hover:border-saffron transition shadow-sm group-hover:scale-110 duration-500">
                            <img src="{{ Storage::url($donation->payment_proof) }}" alt="Proof" class="w-full h-full object-cover">
                        </a>
                        @else
                        <span class="text-slate-300 italic text-xs">No Proof</span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        @if($donation->status == 'pending')
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-amber-50 text-amber-600 border border-amber-100">Pending</span>
                        @elseif($donation->status == 'approved')
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-green-50 text-green-600 border border-green-100">Approved</span>
                        @else
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-red-50 text-red-600 border border-red-100">Rejected</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            @if($donation->status == 'pending')
                            <form action="{{ route('admin.donations.approve', $donation->id) }}" method="POST" onsubmit="return confirm('Approve this donation?')">
                                @csrf
                                <button type="submit" class="p-3 bg-green-50 text-green-600 rounded-xl hover:bg-green-500 hover:text-white transition shadow-sm" title="Approve">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </form>
                            <button onclick="toggleRejectModal({{ $donation->id }})" class="p-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-500 hover:text-white transition shadow-sm" title="Reject">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            @endif

                            @if($donation->status == 'approved')
                            <a href="{{ route('admin.donations.slip', $donation->id) }}" target="_blank" class="p-3 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-500 hover:text-white transition shadow-sm" title="Download Slip">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </a>
                            @endif

                            <form action="{{ route('admin.donations.destroy', $donation->id) }}" method="POST" onsubmit="return confirm('Delete this record permanently?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-3 bg-slate-50 text-slate-400 rounded-xl hover:bg-slate-900 hover:text-white transition shadow-sm" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-4">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            </div>
                            <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">No donations found</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-4xl w-full max-w-md shadow-2xl overflow-hidden animate-float">
            <div class="p-8">
                <h3 class="text-2xl font-black text-slate-800 uppercase tracking-tight mb-2">Reject Donation</h3>
                <p class="text-slate-500 font-medium mb-6">Please provide a reason for rejection.</p>
                
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Reason (Optional)</label>
                        <textarea name="admin_note" rows="3" class="w-full px-5 py-4 bg-slate-50 border-none rounded-3xl focus:ring-2 focus:ring-saffron outline-none text-slate-700 font-medium placeholder-slate-300 transition" placeholder="e.g. Transaction ID not matched..."></textarea>
                    </div>
                    <div class="flex space-x-3">
                        <button type="button" onclick="toggleRejectModal()" class="flex-1 px-8 py-4 bg-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-slate-200 transition">Cancel</button>
                        <button type="submit" class="flex-1 px-8 py-4 bg-red-500 text-white rounded-2xl font-bold shadow-lg shadow-red-500/20 hover:bg-red-600 transition transform active:scale-95">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleRejectModal(id = null) {
        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');
        if (id) {
            form.action = `/admin/donations/${id}/reject`;
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }
</script>
@endsection
