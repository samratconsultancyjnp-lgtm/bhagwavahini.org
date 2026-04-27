@extends('frontend.layout')

@section('content')
<div class="min-h-[70vh] bg-gray-50 flex flex-col justify-center items-center py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute -top-20 -right-20 w-72 h-72 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-saffron rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
    </div>

    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden relative z-10 border-t-8 border-green-500">
        <div class="p-8 md:p-12 text-center">
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-6">
                <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">पंजीकरण सफल!</h2>
            <h3 class="text-xl font-bold text-gray-700 mb-2">Registration Successful</h3>
            
            <div class="bg-gray-50 rounded-2xl p-6 my-8 border border-gray-100">
                <p class="text-gray-500 text-sm font-semibold uppercase tracking-wider mb-2">Your Application ID</p>
                <p class="text-3xl font-black text-saffron tracking-wider">{{ $memberId }}</p>
            </div>

            <div class="space-y-4 text-left bg-blue-50/50 p-6 rounded-2xl border border-blue-100">
                <p class="text-gray-700 leading-relaxed font-medium">
                    आपका पंजीकरण और भुगतान प्राप्त हो गया है। आपका आवेदन अभी <span class="font-bold text-blue-600">Pending Approval (प्रतीक्षा में)</span> है।
                </p>
                <p class="text-gray-600 text-sm leading-relaxed">
                    प्रशासन द्वारा आपके विवरण की पुष्टि करने के बाद, आप अपनी जन्म तिथि और मोबाइल नंबर का उपयोग करके अपना ID Card डाउनलोड कर सकेंगे।
                </p>
            </div>

            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('download.id') }}" class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-lg font-bold rounded-full text-white bg-saffron hover:bg-saffronDark shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                    Download ID Card Status
                </a>
                <a href="{{ route('home') }}" class="inline-flex justify-center items-center px-8 py-4 border-2 border-gray-200 text-lg font-bold rounded-full text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-300 transition-all">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
