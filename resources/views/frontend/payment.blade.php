@extends('frontend.layout')

@section('content')
<div class="min-h-screen py-16 px-4" style="background: linear-gradient(135deg, #fff8f0 0%, #fff3e0 50%, #fce4d6 100%);">
    <div class="max-w-2xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="h-[2px] w-12 rounded-full bg-saffron"></span>
                <span class="text-xs font-black tracking-[0.3em] uppercase text-saffron">Payment</span>
                <span class="h-[2px] w-12 rounded-full bg-saffron"></span>
            </div>
            <h1 class="text-3xl md:text-4xl font-black text-gray-900 mb-2">भुगतान करें</h1>
            <p class="text-gray-500 font-medium">Complete Payment to Get Your Member ID Card</p>
        </div>

        <!-- Progress Steps -->
        <div class="flex items-center justify-center gap-2 mb-10">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-black text-white" style="background:#FF9933;">✓</div>
                <span class="text-sm font-bold text-saffron">Form</span>
            </div>
            <div class="h-[2px] w-10 bg-saffron rounded-full"></div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-black text-white" style="background:#FF9933;">2</div>
                <span class="text-sm font-bold text-saffron">Payment</span>
            </div>
            <div class="h-[2px] w-10 bg-gray-300 rounded-full"></div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-black text-white bg-gray-300">3</div>
                <span class="text-sm font-bold text-gray-400">ID Card</span>
            </div>
        </div>

        <!-- Payment Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-orange-100">
            <div class="h-2" style="background: linear-gradient(90deg, #FF9933, #FFCC33, #FF9933);"></div>

            <div class="p-8 md:p-10">

                <!-- Member Info Summary -->
                <div class="rounded-2xl p-5 mb-8" style="background:#fff8f0; border:1.5px solid #fde8cc;">
                    <h3 class="font-black text-gray-800 mb-3 text-sm uppercase tracking-wide">Applicant Details</h3>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div><span class="text-gray-400">Name:</span> <span class="font-bold text-gray-800">{{ $member->name }}</span></div>
                        <div><span class="text-gray-400">Father:</span> <span class="font-bold text-gray-800">{{ $member->father_name }}</span></div>
                        <div><span class="text-gray-400">Phone:</span> <span class="font-bold text-gray-800">+91 {{ $member->phone }}</span></div>
                        <div><span class="text-gray-400">State:</span> <span class="font-bold text-gray-800">{{ $member->state }}</span></div>
                        <div class="col-span-2"><span class="text-gray-400">District:</span> <span class="font-bold text-gray-800">{{ $member->district }}</span></div>
                    </div>
                </div>

                <!-- Amount Due -->
                <div class="text-center mb-8">
                    <div class="inline-flex flex-col items-center px-10 py-5 rounded-2xl" style="background: linear-gradient(135deg, #FF9933, #E68A2E);">
                        <span class="text-white text-sm font-bold opacity-80 mb-1">Total Amount Due</span>
                        <span class="text-white text-5xl font-black">₹100</span>
                        <span class="text-white text-xs opacity-70 mt-1">One-time Membership Fee</span>
                    </div>
                </div>

                <!-- Razorpay Section -->
                <div class="text-center mb-8">
                    <h3 class="font-black text-gray-800 mb-2">ऑनलाइन भुगतान करें (Online Payment)</h3>
                    <p class="text-gray-500 text-sm mb-8">Click the button below to pay securely via Razorpay (UPI, Card, NetBanking)</p>

                    <form action="{{ route('join.payment.verify') }}" method="POST" id="razorpay-form">
                        @csrf
                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="{{ $razorpayOrderId }}">
                        <input type="hidden" name="razorpay_signature" id="razorpay_signature">

                        <button type="button" id="rzp-button1"
                                class="w-full py-5 rounded-2xl font-black text-white text-xl transition-all duration-300 hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3"
                                style="background: linear-gradient(135deg, #FF9933, #E68A2E); box-shadow: 0 15px 30px rgba(255,153,51,0.3);">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            ₹100 का भुगतान करें (Pay ₹100)
                        </button>

                        @if($razorpay_key_id === 'dummy_key_id' || empty($razorpay_key_id))
                        <div class="mt-6 p-4 rounded-xl bg-blue-50 border border-blue-200">
                            <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-3">Developer Test Mode</p>
                            <button type="button" onclick="document.getElementById('razorpay-form').submit()"
                                    class="w-full py-3 rounded-xl font-black text-blue-600 bg-white border-2 border-blue-200 hover:bg-blue-100 transition-all text-sm">
                                ⚡ Simulate Successful Payment (Test Only)
                            </button>
                            <p class="text-[10px] text-blue-400 mt-2 font-medium">This button only appears because you are using dummy keys in .env</p>
                        </div>
                        @endif
                    </form>
                </div>

                <p class="text-center text-xs text-gray-400">
                    Your payment is secure with SSL encryption. <br>
                    समस्या हो? संपर्क करें: <a href="tel:+919876543210" class="text-saffron font-bold">+91 98765 43210</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ $razorpay_key_id }}",
        "amount": "10000",
        "currency": "INR",
        "name": "Bhagva Dal",
        "description": "Membership Fee",
        "image": "https://bhagva.org/logo.png",
        "order_id": "{{ $razorpayOrderId }}",
        "handler": function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            document.getElementById('razorpay-form').submit();
        },
        "prefill": {
            "name": "{{ $member->name }}",
            "email": "", // Add email if available
            "contact": "{{ $member->phone }}"
        },
        "notes": {
            "member_id": "{{ $member->id }}"
        },
        "theme": {
            "color": "#FF9933"
        }
    };

    @if($razorpay_key_id !== 'dummy_key_id' && !empty($razorpay_key_id))
    var rzp1 = new Razorpay(options);
    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }
    @else
    document.getElementById('rzp-button1').onclick = function(e){
        alert("Razorpay is not configured (using dummy keys). Please use the 'Simulate Successful Payment' button below for testing.");
        e.preventDefault();
    }
    @endif
</script>
@endsection
