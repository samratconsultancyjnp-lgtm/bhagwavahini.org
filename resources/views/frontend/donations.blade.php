@extends('frontend.layout')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-t-8 border-saffron">
            <div class="p-8 bg-saffron-gradient text-white text-center">
                <h1 class="text-4xl font-black mb-2">सहयोग एवं दान (Donation)</h1>
                <p class="text-lg opacity-90">आपका छोटा सा योगदान राष्ट्र निर्माण में बड़ा बदलाव ला सकता है।</p>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    <!-- Donation Details -->
                    <div class="bg-orange-50 p-6 rounded-2xl border-2 border-dashed border-saffron">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-8 h-8 text-saffron mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            बैंक विवरण (Bank Details)
                        </h2>
                        <div class="space-y-4 text-lg">
                            @if($bank_details)
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <p class="whitespace-pre-line text-gray-700">{!! nl2br(e($bank_details)) !!}</p>
                                </div>
                            @else
                                <p class="text-gray-500 italic text-center">बैंक विवरण अभी उपलब्ध नहीं हैं।</p>
                            @endif
                            
                            @if($upi_id)
                                <div class="mt-8 bg-white p-6 rounded-xl shadow-sm text-center border-2 border-green-100">
                                    <p class="text-sm text-gray-500 mb-2 uppercase tracking-widest font-bold">UPI ID</p>
                                    <p class="text-2xl font-black text-greenColor select-all">{{ $upi_id }}</p>
                                    
                                    <div class="mt-6">
                                        <p class="text-sm text-gray-500 mb-4 italic">Scan QR to Pay</p>
                                        <div class="bg-gray-100 p-4 inline-block rounded-xl">
                                            <!-- Simple QR Generator for UPI -->
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa={{ $upi_id }}&pn={{ \App\Models\Setting::getVal('site_name', 'Bhagva') }}&cu=INR" alt="UPI QR Code" class="w-48 h-48 mx-auto">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Submission Form -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">दान की जानकारी भेजें</h2>
                        <form action="{{ route('donations.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">पूरा नाम (Full Name) *</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron focus:border-transparent outline-none transition" placeholder="आपका नाम">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">मोबाइल नंबर *</label>
                                    <input type="text" name="phone" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron focus:border-transparent outline-none transition" placeholder="10 अंकों का नंबर">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">ईमेल (वैकल्पिक)</label>
                                    <input type="email" name="email" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron focus:border-transparent outline-none transition" placeholder="आपका ईमेल">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">दान राशि (Amount) *</label>
                                    <input type="number" name="amount" required min="1" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron focus:border-transparent outline-none transition" placeholder="₹ 100">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">ट्रांजैक्शन ID *</label>
                                    <input type="text" name="transaction_id" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron focus:border-transparent outline-none transition" placeholder="Txn ID / Ref No">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">भुगतान का प्रमाण (Screenshot) *</label>
                                <input type="file" name="payment_proof" required accept="image/*" class="w-full px-4 py-2 rounded-xl border border-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-saffron/10 file:text-saffron hover:file:bg-saffron/20 transition cursor-pointer">
                            </div>

                            <button type="submit" class="w-full bg-saffron text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-saffronDark transition transform hover:scale-[1.02] active:scale-95 mt-6">
                                दान की जानकारी जमा करें
                            </button>
                        </form>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    <div class="bg-blue-50 p-6 rounded-2xl flex items-start gap-4">
                        <svg class="w-6 h-6 text-blue-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div class="text-blue-800 text-sm leading-relaxed">
                            <p class="font-bold mb-1">महत्वपूर्ण सूचना:</p>
                            <p>कृपया भुगतान करने के बाद ट्रांजैक्शन ID और स्क्रीनशॉट जरूर अपलोड करें। प्रशासन द्वारा सत्यापन के बाद आपकी रसीद (Donation Slip) जनरेट की जाएगी जिसे आप नीचे दिए गए 'स्टेटस चेक' सेक्शन से प्राप्त कर सकेंगे।</p>
                        </div>
                    </div>

                    <!-- Check Status Form -->
                    <div class="bg-gray-900 text-white p-6 rounded-2xl shadow-xl">
                        <h2 class="text-xl font-bold mb-4 flex items-center">
                            <svg class="w-6 h-6 text-saffron mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            रसीद डाउनलोड करें (Download Receipt)
                        </h2>
                        <form action="{{ route('donations.status') }}" method="GET" class="space-y-4">
                            <div>
                                <label class="block text-[10px] uppercase font-bold text-gray-400 mb-1">मोबाइल नंबर (Mobile Number)</label>
                                <input type="text" name="phone" required class="w-full bg-white/10 border border-white/20 px-4 py-2 rounded-lg focus:outline-none focus:ring-1 focus:ring-saffron text-white" placeholder="आपका मोबाइल नंबर">
                            </div>
                            <div>
                                <label class="block text-[10px] uppercase font-bold text-gray-400 mb-1">ट्रांजैक्शन ID (Transaction ID)</label>
                                <input type="text" name="transaction_id" required class="w-full bg-white/10 border border-white/20 px-4 py-2 rounded-lg focus:outline-none focus:ring-1 focus:ring-saffron text-white" placeholder="Txn ID दर्ज करें">
                            </div>
                            <button type="submit" class="w-full bg-saffron hover:bg-saffronDark text-white font-bold py-2 rounded-lg transition">
                                स्टेटस चेक करें एवं रसीद प्राप्त करें
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
