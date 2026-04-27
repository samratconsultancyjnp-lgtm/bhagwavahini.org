@extends('frontend.layout')

@section('content')
<div class="min-h-[80vh] bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute -top-20 -right-20 w-72 h-72 bg-saffron rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-orange-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
    </div>

    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl p-8 md:p-10 relative z-10 border-t-8 border-saffron">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Download ID Card</h2>
            <p class="mt-2 text-sm text-gray-500">
                अपना ID Card डाउनलोड करने के लिए अपनी जानकारी दर्ज करें।
            </p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 font-medium">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('download.id.process') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Phone Number -->
            <div>
                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1">मोबाइल नंबर (Mobile Number)</label>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                        class="focus:ring-saffron focus:border-saffron block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-3 bg-gray-50 transition" 
                        placeholder="10 अंकों का मोबाइल नंबर">
                </div>
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date of Birth -->
            <div>
                <label for="dob" class="block text-sm font-semibold text-gray-700 mb-1">जन्म तिथि (Date of Birth)</label>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input type="date" name="dob" id="dob" value="{{ old('dob') }}" required
                        class="focus:ring-saffron focus:border-saffron block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-3 bg-gray-50 transition">
                </div>
                @error('dob')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full shadow-lg text-lg font-bold text-white bg-saffron hover:bg-saffronDark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-saffron transition transform hover:scale-105">
                    Download ID Card
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
