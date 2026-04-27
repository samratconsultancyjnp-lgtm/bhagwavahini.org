@extends('frontend.layout')

@section('content')
<div class="min-h-screen py-16 px-4" style="background: linear-gradient(135deg, #fff8f0 0%, #fff3e0 50%, #fce4d6 100%);">
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="h-[2px] w-12 rounded-full bg-saffron"></span>
                <span class="text-xs font-black tracking-[0.3em] uppercase text-saffron">भगवा दल</span>
                <span class="h-[2px] w-12 rounded-full bg-saffron"></span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-3" style="letter-spacing:-0.02em;">
                सदस्यता फॉर्म
            </h1>
            <p class="text-lg text-gray-500 font-medium">Membership Form — Join Bhagva Dal</p>
            <div class="inline-flex items-center gap-2 mt-4 px-5 py-2 rounded-full text-sm font-bold" style="background:#fff3cd; color:#b45309; border:1.5px solid #fcd34d;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                सदस्यता शुल्क: ₹100 (One-time Registration Fee)
            </div>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-orange-100">
            <!-- Top accent bar -->
            <div class="h-2" style="background: linear-gradient(90deg, #FF9933, #FFCC33, #FF9933);"></div>

            <div class="p-8 md:p-12">
                @if($errors->any())
                    <div class="mb-6 p-4 rounded-2xl border border-red-200 bg-red-50 flex gap-3">
                        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            @foreach($errors->all() as $error)
                                <p class="text-sm text-red-700 font-medium">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 p-4 rounded-2xl border border-red-200 bg-red-50 text-red-700 text-sm font-medium">{{ session('error') }}</div>
                @endif

                <form action="{{ route('join.submit') }}" method="POST" enctype="multipart/form-data" id="joinForm">
                    @csrf

                    <!-- Row 1: Name + Father's Name -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-black text-gray-700 mb-2 uppercase tracking-wide">नाम (Name) <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   placeholder="अपना पूरा नाम लिखें"
                                   class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-saffron focus:outline-none text-gray-900 font-medium transition-colors"
                                   style="font-size:0.95rem;">
                        </div>
                        <div>
                            <label class="block text-sm font-black text-gray-700 mb-2 uppercase tracking-wide">पिता का नाम (Father's Name) <span class="text-red-500">*</span></label>
                            <input type="text" name="father_name" value="{{ old('father_name') }}" required
                                   placeholder="पिता का पूरा नाम"
                                   class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-saffron focus:outline-none text-gray-900 font-medium transition-colors"
                                   style="font-size:0.95rem;">
                        </div>
                    </div>

                    <!-- Row 2: DOB + Phone + Designation -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-black text-gray-700 mb-2 uppercase tracking-wide">जन्म तिथि (DOB — Min. 18 years) <span class="text-red-500">*</span></label>
                            <input type="date" name="dob" value="{{ old('dob') }}"
                                   max="{{ \Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}"
                                   required
                                   class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-saffron focus:outline-none text-gray-900 font-medium transition-colors"
                                   style="font-size:0.95rem;">
                        </div>
                        <div>
                            <label class="block text-sm font-black text-gray-700 mb-2 uppercase tracking-wide">मोबाइल नंबर (Phone) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold text-sm">+91</span>
                                <input type="tel" name="phone" value="{{ old('phone') }}" required
                                       maxlength="10" pattern="[6-9][0-9]{9}"
                                       placeholder="10-digit mobile number"
                                       class="w-full pl-14 pr-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-saffron focus:outline-none text-gray-900 font-medium transition-colors"
                                       style="font-size:0.95rem;">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-black text-gray-700 mb-2 uppercase tracking-wide">पद (Designation) <span class="text-red-500">*</span></label>
                            <select name="designation" required
                                    class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-saffron focus:outline-none text-gray-900 font-medium transition-colors appearance-none bg-white"
                                    style="font-size:0.95rem;">
                                <option value="">— पद चुनें / Select Designation —</option>
                                @foreach($designations as $designation)
                                    <option value="{{ $designation->title }}" {{ old('designation') == $designation->title ? 'selected' : '' }}>{{ $designation->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Row 3: State + District -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-black text-gray-700 mb-2 uppercase tracking-wide">राज्य (State) <span class="text-red-500">*</span></label>
                            <select name="state" id="stateSelect" required
                                    class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-saffron focus:outline-none text-gray-900 font-medium transition-colors appearance-none bg-white"
                                    style="font-size:0.95rem;">
                                <option value="">— राज्य चुनें / Select State —</option>
                                @php
                                $states = ['Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat','Haryana','Himachal Pradesh','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Odisha','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh','Uttarakhand','West Bengal','Delhi','Jammu & Kashmir','Ladakh','Chandigarh','Puducherry','Andaman & Nicobar Islands','Dadra & Nagar Haveli','Lakshadweep'];
                                @endphp
                                @foreach($states as $state)
                                    <option value="{{ $state }}" {{ old('state') == $state ? 'selected' : '' }}>{{ $state }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-black text-gray-700 mb-2 uppercase tracking-wide">जिला (District) <span class="text-red-500">*</span></label>
                            <input type="text" name="district" id="districtInput" value="{{ old('district') }}" required
                                   placeholder="अपना जिला लिखें"
                                   class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-saffron focus:outline-none text-gray-900 font-medium transition-colors"
                                   style="font-size:0.95rem;">
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mb-6">
                        <label class="block text-sm font-black text-gray-700 mb-2 uppercase tracking-wide">पूरा पता (Full Address) <span class="text-red-500">*</span></label>
                        <textarea name="address" rows="3" required placeholder="मकान नंबर, गली, शहर, पिन कोड..."
                                  class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-saffron focus:outline-none text-gray-900 font-medium transition-colors resize-none"
                                  style="font-size:0.95rem;">{{ old('address') }}</textarea>
                    </div>

                    <!-- Photo Upload -->
                    <div class="mb-8">
                        <label class="block text-sm font-black text-gray-700 mb-2 uppercase tracking-wide">पासपोर्ट फोटो (Passport Photo) <span class="text-red-500">*</span></label>
                        <div id="photoDropZone" class="relative border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center cursor-pointer hover:border-saffron transition-colors group" onclick="document.getElementById('photoInput').click()">
                            <input type="file" name="photo" id="photoInput" accept="image/jpeg,image/png,image/jpg" required class="hidden">
                            <div id="photoPlaceholder">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3" style="background:#fff3e0;">
                                    <svg class="w-8 h-8 text-saffron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <p class="font-bold text-gray-700 mb-1">फोटो अपलोड करें</p>
                                <p class="text-sm text-gray-500">Click to browse or drag & drop</p>
                                <p class="text-xs text-red-500 font-bold mt-2">⚠ Maximum size: 200 KB | Format: JPG / PNG</p>
                            </div>
                            <div id="photoPreviewWrap" class="hidden flex-col items-center gap-3">
                                <img id="photoPreview" class="w-28 h-28 rounded-xl object-cover border-4 border-saffron shadow-lg" src="" alt="Preview">
                                <div>
                                    <p id="photoName" class="text-sm font-bold text-gray-700"></p>
                                    <p id="photoSize" class="text-xs text-gray-500"></p>
                                </div>
                                <button type="button" onclick="clearPhoto(event)" class="text-xs text-red-500 underline font-bold">Remove</button>
                            </div>
                        </div>
                        <p id="photoError" class="text-red-500 text-sm font-bold mt-2 hidden">❌ फोटो का आकार 200KB से कम होना चाहिए। (Photo must be under 200KB)</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex flex-col items-center gap-4">
                        <button type="submit" id="submitBtn"
                                class="group relative inline-flex items-center gap-3 font-black text-white text-lg uppercase tracking-tight px-14 py-5 rounded-2xl overflow-hidden transition-all duration-500"
                                style="background: linear-gradient(135deg, #FF9933, #E68A2E); box-shadow: 0 0 30px rgba(255,153,51,0.4), 0 8px 30px rgba(0,0,0,0.15);">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            <span>Proceed to Payment ₹100</span>
                            <!-- Shine -->
                            <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-700 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                        </button>
                        <p class="text-sm text-gray-400">🔒 Your data is secure and encrypted</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .focus\:border-saffron:focus { border-color: #FF9933; box-shadow: 0 0 0 3px rgba(255,153,51,0.15); }
    select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23FF9933'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2.5' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.2rem; }
</style>

<script>
    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');
    const photoPreviewWrap = document.getElementById('photoPreviewWrap');
    const photoPlaceholder = document.getElementById('photoPlaceholder');
    const photoError = document.getElementById('photoError');
    const photoName = document.getElementById('photoName');
    const photoSize = document.getElementById('photoSize');

    photoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        if (file.size > 200 * 1024) {
            photoError.classList.remove('hidden');
            this.value = '';
            photoPreviewWrap.classList.add('hidden');
            photoPreviewWrap.classList.remove('flex');
            photoPlaceholder.classList.remove('hidden');
            return;
        }
        photoError.classList.add('hidden');

        const reader = new FileReader();
        reader.onload = (e) => {
            photoPreview.src = e.target.result;
            photoName.textContent = file.name;
            photoSize.textContent = (file.size / 1024).toFixed(1) + ' KB';
            photoPlaceholder.classList.add('hidden');
            photoPreviewWrap.classList.remove('hidden');
            photoPreviewWrap.classList.add('flex');
        };
        reader.readAsDataURL(file);
    });

    function clearPhoto(e) {
        e.stopPropagation();
        photoInput.value = '';
        photoPreview.src = '';
        photoPreviewWrap.classList.add('hidden');
        photoPreviewWrap.classList.remove('flex');
        photoPlaceholder.classList.remove('hidden');
    }

    // Drag & Drop
    const dropZone = document.getElementById('photoDropZone');
    dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor='#FF9933'; });
    dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor=''; });
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.style.borderColor='';
        const file = e.dataTransfer.files[0];
        if (file) {
            const dt = new DataTransfer();
            dt.items.add(file);
            photoInput.files = dt.files;
            photoInput.dispatchEvent(new Event('change'));
        }
    });

    // Form validation
    document.getElementById('joinForm').addEventListener('submit', function(e) {
        const file = photoInput.files[0];
        if (file && file.size > 200 * 1024) {
            e.preventDefault();
            photoError.classList.remove('hidden');
        }
    });
</script>
@endsection
