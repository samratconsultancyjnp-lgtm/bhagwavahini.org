@extends('admin.layout')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-extrabold text-slate-800">SYSTEM SETTINGS</h1>
    <p class="text-slate-500 font-medium italic mt-1">Payment gateway and critical configurations</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
    <!-- Razorpay Integration Form -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-5xl p-10 shadow-2xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-saffron/5 rounded-bl-full"></div>
            
            <div class="flex items-center mb-10">
                <div class="w-16 h-16 bg-saffron/10 rounded-3xl flex items-center justify-center text-saffron mr-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800">Razorpay Integration</h2>
                    <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">Payment Gateway Configuration</p>
                </div>
            </div>

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-slate-700 font-bold mb-3 flex items-center">
                            RAZORPAY KEY ID
                            <span class="ml-2 px-2 py-0.5 bg-saffron/10 text-saffron text-[10px] rounded-md font-black uppercase">Required</span>
                        </label>
                        <input type="text" name="razorpay_key" value="{{ $razorpay_key }}" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-3xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 font-mono text-sm" placeholder="rzp_test_...">
                    </div>
                    
                    <div>
                        <label class="block text-slate-700 font-bold mb-3 flex items-center">
                            RAZORPAY KEY SECRET
                            <span class="ml-2 px-2 py-0.5 bg-saffron/10 text-saffron text-[10px] rounded-md font-black uppercase">Required</span>
                        </label>
                        <input type="password" name="razorpay_secret" value="{{ $razorpay_secret }}" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-3xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 font-mono text-sm" placeholder="••••••••••••••••">
                    </div>
                </div>

                <div class="mt-10 mb-6 border-t border-slate-100 pt-10">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-saffron/10 rounded-2xl flex items-center justify-center text-saffron mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-slate-800">Manual Payment Settings</h2>
                            <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">QR Code & Bank Transfer</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-slate-700 font-bold mb-3 flex items-center">
                                UPI ID
                                <span class="ml-2 px-2 py-0.5 bg-saffron/10 text-saffron text-[10px] rounded-md font-black uppercase">For QR Code</span>
                            </label>
                            <input type="text" name="upi_id" value="{{ $upi_id ?? '' }}" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-3xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 font-mono text-sm" placeholder="yourname@upi">
                        </div>
                        
                        <div>
                            <label class="block text-slate-700 font-bold mb-3 flex items-center">
                                BANK DETAILS
                            </label>
                            <textarea name="bank_details" rows="3" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-3xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 font-mono text-sm" placeholder="Bank Name: State Bank of India&#10;A/C No: 12345678901&#10;IFSC: SBIN0001234">{{ $bank_details ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Brand Identity & Site Info -->
                <div class="mt-10 mb-6 border-t border-slate-100 pt-10">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-saffron/10 rounded-2xl flex items-center justify-center text-saffron mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-slate-800">Brand Identity</h2>
                            <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">Logo, Favicon & Site Name</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-slate-700 font-bold mb-3">Site Name</label>
                            <input type="text" name="site_name" value="{{ $site_name ?? 'भगवा दल' }}" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-3xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 font-bold text-sm">
                        </div>

                        <div>
                            <label class="block text-slate-700 font-bold mb-3 flex justify-between">
                                <span>Site Logo</span>
                                @if(isset($site_logo) && $site_logo)
                                    <span class="text-green-500 text-xs flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Uploaded</span>
                                @endif
                            </label>
                            <div class="flex items-center gap-4">
                                @if(isset($site_logo) && $site_logo)
                                    <img src="{{ Storage::url($site_logo) }}" class="w-16 h-16 object-contain rounded-lg border border-slate-200">
                                @endif
                                <input type="file" name="site_logo" accept="image/*" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-slate-700 font-bold mb-3 flex justify-between">
                                <span>Site Favicon</span>
                                @if(isset($site_favicon) && $site_favicon)
                                    <span class="text-green-500 text-xs flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Uploaded</span>
                                @endif
                            </label>
                            <div class="flex items-center gap-4">
                                @if(isset($site_favicon) && $site_favicon)
                                    <img src="{{ Storage::url($site_favicon) }}" class="w-16 h-16 object-contain rounded-lg border border-slate-200">
                                @endif
                                <input type="file" name="site_favicon" accept="image/*" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 text-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="mt-10 mb-6 border-t border-slate-100 pt-10">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-saffron/10 rounded-2xl flex items-center justify-center text-saffron mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-slate-800">Contact Information</h2>
                            <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">Public Address, Email & Phone</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-slate-700 font-bold mb-3">Office Address</label>
                            <textarea name="site_address" rows="3" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-3xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 text-sm" placeholder="123, भगवा भवन, मुख्य रोड, नई दिल्ली - 110001">{{ $site_address ?? '' }}</textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-slate-700 font-bold mb-3">Email IDs (One per line)</label>
                                <textarea name="site_email" rows="3" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-3xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 text-sm" placeholder="contact@bhagva.org&#10;support@bhagva.org">{{ $site_email ?? '' }}</textarea>
                            </div>
                            <div>
                                <label class="block text-slate-700 font-bold mb-3">Contact Numbers (One per line)</label>
                                <textarea name="site_phone" rows="3" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-3xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 text-sm" placeholder="+91 98765 43210&#10;011-2345678">{{ $site_phone ?? '' }}</textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-slate-700 font-bold mb-3">Google Map Embed (iframe HTML)</label>
                            <textarea name="site_map_iframe" rows="4" class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-3xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 font-mono text-sm" placeholder='<iframe src="..."></iframe>'>{{ $site_map_iframe ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-10 mb-6 border-t border-slate-100 pt-10">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-saffron/10 rounded-2xl flex items-center justify-center text-saffron mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-slate-800">ID Card Configuration</h2>
                            <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">Customize Member ID Card Layout</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-slate-700 font-bold mb-3 flex justify-between">
                                <span>ID Card Header Image</span>
                                @if(isset($id_card_header_image) && $id_card_header_image)
                                    <span class="text-green-500 text-xs flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Uploaded</span>
                                @endif
                            </label>
                            <div class="flex items-center gap-4">
                                @if(isset($id_card_header_image) && $id_card_header_image)
                                    <img src="{{ Storage::url($id_card_header_image) }}" class="w-auto h-16 object-cover rounded-lg border border-slate-200">
                                @endif
                                <input type="file" name="id_card_header_image" accept="image/*" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-slate-700 font-bold mb-3 flex justify-between">
                                <span>ID Card Footer Image</span>
                                @if(isset($id_card_footer_image) && $id_card_footer_image)
                                    <span class="text-green-500 text-xs flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Uploaded</span>
                                @endif
                            </label>
                            <div class="flex items-center gap-4">
                                @if(isset($id_card_footer_image) && $id_card_footer_image)
                                    <img src="{{ Storage::url($id_card_footer_image) }}" class="w-auto h-16 object-cover rounded-lg border border-slate-200">
                                @endif
                                <input type="file" name="id_card_footer_image" accept="image/*" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-slate-700 font-bold mb-3 flex justify-between">
                                <span>Watermark Logo (Optional)</span>
                                @if(isset($id_card_watermark) && $id_card_watermark)
                                    <span class="text-green-500 text-xs flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Uploaded</span>
                                @endif
                            </label>
                            <div class="flex items-center gap-4">
                                @if(isset($id_card_watermark) && $id_card_watermark)
                                    <img src="{{ Storage::url($id_card_watermark) }}" class="w-16 h-16 object-contain rounded-lg border border-slate-200">
                                @endif
                                <input type="file" name="id_card_watermark" accept="image/*" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300 text-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-saffron text-white font-black py-5 rounded-3xl shadow-xl shadow-saffron/30 hover:bg-saffronDark transition transform hover:scale-[1.02] flex items-center justify-center space-x-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Update All Settings</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Info/Help Panel -->
    <div class="lg:col-span-1 space-y-8">
        <div class="bg-slate-900 rounded-5xl p-10 text-white relative overflow-hidden shadow-2xl shadow-slate-900/20">
            <div class="absolute top-0 right-0 w-24 h-24 bg-saffron/10 rounded-bl-full"></div>
            <h3 class="text-xl font-black mb-6">Need Help?</h3>
            <p class="text-slate-400 text-sm leading-relaxed mb-8">
                Log in to your Razorpay Dashboard and navigate to **Settings > API Keys** to retrieve your credentials.
            </p>
            <a href="https://dashboard.razorpay.com" target="_blank" class="flex items-center justify-between bg-white/5 border border-white/10 p-4 rounded-2xl hover:bg-white/10 transition group">
                <span class="font-bold text-sm">Razorpay Dashboard</span>
                <svg class="w-5 h-5 text-saffron transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <div class="bg-white rounded-5xl p-10 shadow-xl border border-slate-100">
            <h3 class="text-lg font-black text-slate-800 mb-6">Safety Instructions</h3>
            <ul class="space-y-4">
                <li class="flex items-start">
                    <span class="w-1.5 h-1.5 bg-saffron rounded-full mt-2 mr-3"></span>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">Never share your API Secret with anyone.</p>
                </li>
                <li class="flex items-start">
                    <span class="w-1.5 h-1.5 bg-saffron rounded-full mt-2 mr-3"></span>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">Always test in 'Test Mode' before going live.</p>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
