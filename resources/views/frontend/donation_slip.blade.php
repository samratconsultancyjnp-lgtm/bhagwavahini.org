<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <title>Donation Receipt - {{ $donation->transaction_id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', 'Tiro Devanagari Hindi', serif; }
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .receipt-container { border: none; shadow: none; }
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 8rem;
            opacity: 0.05;
            z-index: 0;
            white-space: nowrap;
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-gray-100 p-4 md:p-10 flex flex-col items-center">

    <div class="no-print mb-8 space-x-4">
        <button onclick="window.print()" class="bg-saffron text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-saffronDark transition transform hover:scale-105 flex items-center inline-flex">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Print Receipt
        </button>
        <button onclick="window.close()" class="bg-gray-800 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-gray-900 transition flex items-center inline-flex">
            Close
        </button>
    </div>

    <div class="receipt-container bg-white w-full max-w-3xl p-8 md:p-12 shadow-2xl rounded-3xl border-t-[12px] border-saffron relative overflow-hidden">
        <div class="watermark uppercase font-black">BHAGVA DAL</div>
        
        <!-- Header -->
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center border-b-2 border-gray-100 pb-8 mb-8">
            <div class="flex items-center mb-4 md:mb-0">
                @if($site_logo)
                    <img src="{{ Storage::url($site_logo) }}" alt="Logo" class="h-20 w-20 rounded-full border-2 border-saffron shadow-sm object-cover mr-4">
                @else
                    <div class="h-20 w-20 rounded-full bg-saffron flex items-center justify-center text-white text-3xl font-black mr-4 shadow-sm">B</div>
                @endif
                <div>
                    <h1 class="text-3xl font-black text-saffron tracking-tighter uppercase">{{ $site_name }}</h1>
                    <p class="text-xs text-gray-500 font-bold tracking-[0.2em] uppercase">Donation Receipt</p>
                </div>
            </div>
            <div class="text-center md:text-right">
                <p class="text-sm text-gray-600 font-medium">Receipt No: <span class="font-bold text-gray-900">#DON-{{ str_pad($donation->id, 6, '0', STR_PAD_LEFT) }}</span></p>
                <p class="text-sm text-gray-600 font-medium">Date: <span class="font-bold text-gray-900">{{ $donation->updated_at->format('d M, Y') }}</span></p>
            </div>
        </div>

        <!-- Content -->
        <div class="relative z-10 space-y-8">
            <div class="text-center">
                <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight mb-2">Thank You for Your Donation!</h2>
                <p class="text-gray-500 italic">"आपका सहयोग, हमारा संकल्प - एक सशक्त राष्ट्र का निर्माण"</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-gray-50 p-8 rounded-3xl border border-gray-100">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Donor Details</p>
                    <p class="text-xl font-bold text-gray-800">{{ $donation->name }}</p>
                    <p class="text-sm text-gray-600">{{ $donation->phone }}</p>
                    <p class="text-sm text-gray-600">{{ $donation->email }}</p>
                </div>
                <div class="md:text-right">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Payment Info</p>
                    <p class="text-3xl font-black text-greenColor tracking-tighter">₹ {{ number_format($donation->amount, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">Transaction ID: <span class="font-bold">{{ $donation->transaction_id }}</span></p>
                    <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Status: <span class="text-green-600 font-bold">Verified</span></p>
                </div>
            </div>

            <div class="border-l-4 border-saffron pl-6 py-2 italic text-gray-600 leading-relaxed">
                यह रसीद प्रमाणित करती है कि हमें आपकी ओर से सहायता राशि प्राप्त हुई है। इस राशि का उपयोग संगठन की सामाजिक और सांस्कृतिक गतिविधियों के लिए किया जाएगा।
            </div>

            <!-- Signature Area -->
            <div class="flex flex-col md:flex-row justify-between items-end pt-12">
                <div class="text-xs text-gray-400 space-y-1">
                    <p class="font-bold uppercase tracking-widest">Registered Address:</p>
                    <p class="whitespace-pre-line">{{ $site_address }}</p>
                    <p>Tel: {{ $site_phone }}</p>
                    <p>Email: {{ $site_email }}</p>
                </div>
                <div class="text-center mt-8 md:mt-0">
                    <div class="w-48 border-b-2 border-gray-200 mb-2 h-16 flex items-center justify-center opacity-50 italic text-gray-300">Authorized Signatory</div>
                    <p class="text-sm font-bold text-gray-800 uppercase tracking-widest">Office Seal & Sign</p>
                </div>
            </div>
        </div>

        <!-- Footer Accent -->
        <div class="absolute bottom-0 left-0 right-0 h-2 bg-saffron-gradient opacity-20"></div>
    </div>

    <div class="mt-8 text-center text-gray-400 text-xs tracking-widest uppercase">
        Computer Generated Receipt - No Signature Required
    </div>

</body>
</html>
