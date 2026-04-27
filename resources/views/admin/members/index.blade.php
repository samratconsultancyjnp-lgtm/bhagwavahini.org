@extends('admin.layout')

@section('content')

@if(session('success'))
    <div class="mb-6 px-5 py-4 rounded-2xl bg-green-50 border border-green-200 text-green-700 font-bold flex items-center gap-3">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
@endif

<div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800 uppercase tracking-tighter">JOIN REQUESTS</h1>
        <p class="text-slate-500 font-medium italic mt-1 text-sm">Review and manage party membership applications</p>
    </div>
    <!-- Stats -->
    <div class="flex gap-3">
        <div class="px-4 py-2 rounded-xl bg-green-50 border border-green-100 text-center">
            <div class="text-lg font-black text-green-600">{{ $members->where('payment_status','approved')->count() }}</div>
            <div class="text-[10px] font-bold text-green-500 uppercase tracking-wider">Approved</div>
        </div>
        <div class="px-4 py-2 rounded-xl bg-orange-50 border border-orange-100 text-center">
            <div class="text-lg font-black text-orange-500">{{ $members->where('payment_status','success')->count() }}</div>
            <div class="text-[10px] font-bold text-orange-400 uppercase tracking-wider">Action Needed</div>
        </div>
        <div class="px-4 py-2 rounded-xl bg-blue-50 border border-blue-100 text-center">
            <div class="text-lg font-black text-blue-600">{{ $members->count() }}</div>
            <div class="text-[10px] font-bold text-blue-500 uppercase tracking-wider">Total Active</div>
        </div>
    </div>
</div>

<div class="overflow-hidden rounded-3xl border border-slate-100 shadow-2xl bg-white">
    <table class="min-w-full divide-y divide-slate-100">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-6 py-5 text-left text-xs font-black text-slate-400 uppercase tracking-widest">#</th>
                <th class="px-6 py-5 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Applicant</th>
                <th class="px-6 py-5 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Contact & Location</th>
                <th class="px-6 py-5 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Member ID</th>
                <th class="px-6 py-5 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Payment</th>
                <th class="px-6 py-5 text-right text-xs font-black text-slate-400 uppercase tracking-widest">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($members as $i => $member)
            <tr class="hover:bg-slate-50 transition duration-200">
                <td class="px-6 py-5 text-sm font-bold text-slate-400">{{ $i + 1 }}</td>

                <!-- Photo + Name -->
                <td class="px-6 py-5">
                    <div class="flex items-center gap-4">
                        @if($member->photo_path)
                            <img src="{{ Storage::disk('public')->url($member->photo_path) }}" class="h-14 w-14 rounded-2xl object-cover shadow border-2 border-white ring-2 ring-slate-100">
                        @else
                            <div class="h-14 w-14 rounded-2xl bg-slate-200 flex items-center justify-center text-slate-400">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            </div>
                        @endif
                        <div>
                            <div class="text-base font-black text-slate-800">{{ $member->name }}</div>
                            <div class="text-xs font-semibold text-slate-400 mt-0.5">S/O: {{ $member->father_name }}</div>
                            <div class="text-xs text-slate-400 mt-0.5">DOB: {{ \Carbon\Carbon::parse($member->dob)->format('d M Y') }}</div>
                        </div>
                    </div>
                </td>

                <!-- Contact & Location -->
                <td class="px-6 py-5">
                    <div class="text-sm font-bold text-slate-700">{{ $member->phone ?? '—' }}</div>
                    <div class="text-xs text-slate-400 mt-1">{{ $member->district ?? '' }}{{ $member->state ? ', '.$member->state : '' }}</div>
                </td>

                <!-- Member ID -->
                <td class="px-6 py-5">
                    @if($member->member_id)
                        <span class="inline-block px-3 py-1 rounded-lg text-xs font-black tracking-wider" style="background:#fff3e0; color:#E65C00;">{{ $member->member_id }}</span>
                    @else
                        <span class="text-xs text-slate-300 font-bold italic">Not Assigned</span>
                    @endif
                </td>

                <!-- Payment Status -->
                <td class="px-6 py-5">
                    @if($member->payment_status == 'success')
                        <div class="inline-flex items-center gap-2 bg-green-50 text-green-600 px-3 py-1.5 rounded-xl border border-green-100">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="font-black text-[10px] uppercase tracking-widest">Paid ₹100</span>
                        </div>
                    @elseif($member->payment_status == 'approved')
                        <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-xl border border-blue-100">
                            <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                            <span class="font-black text-[10px] uppercase tracking-widest">Approved</span>
                        </div>
                    @else
                        <div class="inline-flex items-center gap-2 bg-red-50 text-red-500 px-3 py-1.5 rounded-xl border border-red-100">
                            <span class="w-2 h-2 bg-red-400 rounded-full"></span>
                            <span class="font-black text-[10px] uppercase tracking-widest">Pending</span>
                        </div>
                    @endif
                </td>

                <!-- Actions -->
                <td class="px-6 py-5 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <!-- View Button -->
                        <button onclick="openModal({{ $member->id }})"
                                class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-black text-blue-600 bg-blue-50 border border-blue-100 hover:bg-blue-600 hover:text-white transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            View
                        </button>

                        <!-- ID Card Button (Only for approved) -->
                        @if($member->payment_status == 'approved')
                        <a href="{{ route('admin.members.idcard', $member->id) }}" target="_blank"
                           class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-black text-orange-600 bg-orange-50 border border-orange-100 hover:bg-orange-500 hover:text-white transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            ID Card
                        </a>
                        @endif

                        <!-- Approve Button (only if pending/paid) -->
                        @if($member->payment_status != 'approved')
                        <form action="{{ route('admin.members.approve', $member->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit"
                                    onclick="return confirm('Approve {{ $member->name }}?')"
                                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-black text-green-600 bg-green-50 border border-green-100 hover:bg-green-500 hover:text-white transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                Approve
                            </button>
                        </form>
                        @else
                        <span class="inline-flex items-center gap-1 px-3 py-2 rounded-xl text-xs font-black text-green-500 bg-green-50 border border-green-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Approved
                        </span>
                        @endif

                        <!-- Delete Button -->
                        <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Delete this member permanently?');" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center p-2 rounded-xl text-red-400 bg-red-50 border border-red-100 hover:bg-red-500 hover:text-white transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-20 text-center">
                    <div class="flex flex-col items-center gap-3 text-slate-300">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <p class="font-bold text-lg text-slate-400">No applications yet</p>
                        <p class="text-sm text-slate-300">Membership requests will appear here</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- ===== VIEW MODAL ===== -->
@push('modals')
@foreach($members as $member)
<div id="modal-{{ $member->id }}" class="fixed inset-0 z-50 hidden items-center justify-center p-4" style="background:rgba(0,0,0,0.55); backdrop-filter:blur(4px);">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-xl max-h-[95vh] flex flex-col animate-fadeIn">
        <!-- Modal Header -->
        <div class="flex items-center justify-between px-8 py-5 flex-shrink-0" style="background: linear-gradient(135deg, #FF9933, #E65C00);">
            <div>
                <h2 class="text-xl font-black text-white">Member Profile</h2>
                <p class="text-white/70 text-xs font-semibold mt-0.5">{{ $member->member_id ?? 'ID Pending' }}</p>
            </div>
            <button onclick="closeModal({{ $member->id }})" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-8 overflow-y-auto">
            <div class="flex gap-6 mb-6">
                <!-- Photo -->
                <div class="flex-shrink-0">
                    @if($member->photo_path)
                        <img src="{{ Storage::disk('public')->url($member->photo_path) }}" class="w-28 h-32 rounded-2xl object-cover border-4 border-orange-100 shadow-lg">
                    @else
                        <div class="w-28 h-32 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-300">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        </div>
                    @endif
                </div>

                <!-- Basic Info -->
                <div class="flex-1">
                    <h3 class="text-2xl font-black text-slate-800 mb-1">{{ $member->name }}</h3>
                    @if($member->member_id)
                        <span class="inline-block text-xs font-black px-3 py-1 rounded-lg mb-3" style="background:#fff3e0; color:#E65C00;">{{ $member->member_id }}</span>
                    @endif
                    <div class="space-y-1.5 text-sm">
                        <div class="flex items-center gap-2 text-slate-600"><svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg> <span>S/O: <strong>{{ $member->father_name }}</strong></span></div>
                        <div class="flex items-center gap-2 text-slate-600"><svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> DOB: <strong>{{ \Carbon\Carbon::parse($member->dob)->format('d M Y') }}</strong></div>
                        <div class="flex items-center gap-2 text-slate-600"><svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg> +91 {{ $member->phone ?? '—' }}</div>
                        @if($member->designation)
                        <div class="flex items-center gap-2 text-slate-600 mt-2"><svg class="w-4 h-4 text-saffron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg> <span class="font-bold text-saffron">{{ $member->designation }}</span></div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- More Details Grid -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wide mb-1">State</p>
                    <p class="font-black text-slate-700">{{ $member->state ?? '—' }}</p>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wide mb-1">District</p>
                    <p class="font-black text-slate-700">{{ $member->district ?? '—' }}</p>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 col-span-2">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wide mb-1">Address</p>
                    <p class="text-sm font-semibold text-slate-700">{{ $member->address }}</p>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wide mb-1">Payment Status</p>
                    <p class="font-black {{ $member->payment_status == 'success' || $member->payment_status == 'approved' ? 'text-green-600' : 'text-red-500' }}">{{ ucfirst($member->payment_status) }}</p>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wide mb-1">Transaction ID</p>
                    <p class="font-black text-slate-700 font-mono text-sm">{{ $member->payment_id ?? '—' }}</p>
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 col-span-2">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wide mb-1">Joined On</p>
                    <p class="font-black text-slate-700">{{ $member->created_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>

            <!-- Modal Actions (Editable Form) -->
            <form action="{{ route('admin.members.approve', $member->id) }}" method="POST" class="mt-4 border-t border-slate-100 pt-6">
                @csrf
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">Full Name</label>
                        <input type="text" name="name" value="{{ $member->name }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-saffron focus:outline-none transition-colors text-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">Father's Name</label>
                        <input type="text" name="father_name" value="{{ $member->father_name }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-saffron focus:outline-none transition-colors text-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">DOB</label>
                        <input type="date" name="dob" value="{{ $member->dob }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-saffron focus:outline-none transition-colors text-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">Phone</label>
                        <input type="text" name="phone" value="{{ $member->phone }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-saffron focus:outline-none transition-colors text-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">Designation</label>
                        <input type="text" name="designation" value="{{ $member->designation }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-saffron focus:outline-none transition-colors text-sm" placeholder="e.g. District President">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">State</label>
                        <input type="text" name="state" value="{{ $member->state }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-saffron focus:outline-none transition-colors text-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">District</label>
                        <input type="text" name="district" value="{{ $member->district }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-saffron focus:outline-none transition-colors text-sm" required>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">Address</label>
                        <textarea name="address" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-saffron focus:outline-none transition-colors text-sm resize-none" required>{{ $member->address }}</textarea>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="flex-1 py-3.5 rounded-xl font-black text-white text-sm transition-all hover:scale-[1.02]" style="background: linear-gradient(135deg, #22c55e, #16a34a); box-shadow: 0 10px 20px rgba(34,197,94,0.2);">
                        {{ $member->payment_status != 'approved' ? '✓ Save & Approve Member' : '✓ Save Changes' }}
                    </button>
                    <button type="button" onclick="closeModal({{ $member->id }})" class="px-6 py-3.5 rounded-xl font-black text-slate-500 bg-slate-100 hover:bg-slate-200 text-sm transition-all">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endpush

<style>
@keyframes fadeIn { from { opacity:0; transform:scale(0.95) translateY(10px); } to { opacity:1; transform:scale(1) translateY(0); } }
.animate-fadeIn { animation: fadeIn 0.25s ease-out both; }
</style>

<script>
function openModal(id) {
    document.getElementById('modal-' + id).classList.remove('hidden');
    document.getElementById('modal-' + id).classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closeModal(id) {
    document.getElementById('modal-' + id).classList.add('hidden');
    document.getElementById('modal-' + id).classList.remove('flex');
    document.body.style.overflow = '';
}
// Close on backdrop click
document.querySelectorAll('[id^="modal-"]').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            this.classList.remove('flex');
            document.body.style.overflow = '';
        }
    });
});
</script>
@endsection
