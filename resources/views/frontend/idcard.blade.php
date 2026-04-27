<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhagva Dal — Member ID Card</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fff8f0 0%, #fff3e0 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 40px 16px;
        }

        .success-banner {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            padding: 16px 32px;
            border-radius: 16px;
            text-align: center;
            margin-bottom: 32px;
            box-shadow: 0 8px 30px rgba(34,197,94,0.3);
        }
        .success-banner h2 { font-size: 1.4rem; font-weight: 900; margin-bottom: 4px; }
        .success-banner p { font-size: 0.9rem; opacity: 0.85; }

        /* ===== ID CARD ===== */
        #idCard {
            width: 520px;
            aspect-ratio: 1.586 / 1; /* Standard CR80 landscape proportion */
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.18);
            border: 2px solid #fde8cc;
            margin-bottom: 28px;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            opacity: 0.05;
            pointer-events: none;
            z-index: 0;
        }

        .card-header {
            width: 100%;
            display: block;
            border-bottom: 2px solid #FF9933;
        }
        .card-header img {
            width: 100%;
            height: auto;
            max-height: 90px;
            object-fit: cover;
            display: block;
        }

        .card-body { padding: 16px 20px; display: flex; gap: 20px; align-items: flex-start; flex: 1; position: relative; z-index: 1; }

        .member-photo {
            width: 100px;
            height: 125px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid #FF9933;
            box-shadow: 0 4px 16px rgba(255,153,51,0.3);
            flex-shrink: 0;
            margin-top: 5px;
        }
        .member-info { flex: 1; display: grid; grid-template-columns: 1fr 1fr; gap: 6px; }
        .member-name-block { grid-column: span 2; margin-bottom: 4px; }
        .member-name { font-size: 1.25rem; font-weight: 900; color: #1a1a1a; letter-spacing: -0.02em; line-height: 1.2; margin-bottom: 4px; }
        .member-id-badge {
            display: inline-block;
            background: linear-gradient(90deg, #FF9933, #E65C00);
            color: white;
            font-size: 0.7rem;
            font-weight: 900;
            letter-spacing: 0.12em;
            padding: 3px 12px;
            border-radius: 20px;
        }
        .info-row { display: flex; flex-direction: column; }
        .info-row.full { grid-column: span 2; }
        .info-label { font-size: 0.58rem; font-weight: 800; color: #999; text-transform: uppercase; letter-spacing: 0.1em; }
        .info-value { font-size: 0.8rem; font-weight: 700; color: #333; line-height: 1.3; }

        .card-divider { height: 1px; background: linear-gradient(90deg, #FF9933, transparent); margin: 0 20px; opacity: 0.5; }

        .card-footer {
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-footer .validity { font-size: 0.65rem; color: #888; font-weight: 600; line-height: 1.4; }
        .card-footer .validity span { color: #FF9933; font-weight: 900; }
        .card-footer .txn { font-size: 0.6rem; color: #bbb; font-weight: 600; font-family: monospace; text-align: right;}

        .card-bottom-bar {
            width: 100%;
            margin-top: auto;
            border-top: 2px solid #FF9933;
        }
        .card-bottom-bar img {
            width: 100%;
            height: auto;
            max-height: 50px;
            object-fit: cover;
            display: block;
        }

        /* Action Buttons */
        .action-buttons { display: flex; gap: 12px; flex-wrap: wrap; justify-content: center; }
        .btn-download {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 14px 32px; border-radius: 14px;
            font-weight: 900; font-size: 1rem; cursor: pointer;
            border: none; transition: all 0.3s; text-decoration: none;
            font-family: 'Inter', sans-serif;
        }
        .btn-primary {
            background: linear-gradient(135deg, #FF9933, #E68A2E);
            color: white;
            box-shadow: 0 0 25px rgba(255,153,51,0.4);
        }
        .btn-primary:hover { transform: translateY(-2px) scale(1.03); box-shadow: 0 0 40px rgba(255,153,51,0.5); }
        .btn-secondary {
            background: white;
            color: #FF9933;
            border: 2px solid #FF9933;
        }
        .btn-secondary:hover { background: #fff8f0; transform: translateY(-2px); }

        .note { margin-top: 16px; text-align: center; font-size: 0.8rem; color: #888; }

        @media print {
            body { background: white; padding: 0; justify-content: center; }
            .success-banner, .action-buttons, .note { display: none !important; }
            #idCard { box-shadow: none; margin: 0; border: 2px solid #FF9933; }
        }
    </style>
</head>
<body>

    <div class="success-banner">
        <h2>🎉 सदस्यता सफल! (Membership Successful!)</h2>
        <p>आपकी Member ID Card नीचे तैयार है — इसे Download करें।</p>
    </div>

    <!-- ID CARD -->
    <div id="idCard">
        @if(isset($id_card_watermark) && $id_card_watermark)
            <img src="{{ Storage::url($id_card_watermark) }}" alt="Watermark" class="watermark">
        @endif

        <!-- Header Image -->
        @if(isset($id_card_header_image) && $id_card_header_image)
            <div class="card-header">
                <img src="{{ Storage::url($id_card_header_image) }}" alt="Header">
            </div>
        @else
            <div class="card-header" style="background: linear-gradient(135deg, #FF9933 0%, #E65C00 100%); padding: 25px;">
                <!-- Fallback if no image uploaded -->
            </div>
        @endif

        <!-- Body -->
        <div class="card-body">
            <img src="{{ Storage::disk('public')->url($member->photo_path) }}" alt="{{ $member->name }}" class="member-photo"
                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=FF9933&color=ffffff&bold=true&size=90'">

            <div class="member-info">
                <div class="member-name-block">
                    <div class="member-name">{{ strtoupper($member->name) }}</div>
                    <div class="member-id-badge">{{ $member->member_id ?? 'PENDING' }}</div>
                </div>

                <div class="info-row">
                    <span class="info-label">Father's Name</span>
                    <span class="info-value">{{ $member->father_name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date of Birth</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($member->dob)->format('d M Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Mobile Number</span>
                    <span class="info-value">+91 {{ $member->phone }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">District</span>
                    <span class="info-value">{{ $member->district }}</span>
                </div>
                <div class="info-row full">
                    <span class="info-label">State</span>
                    <span class="info-value">{{ $member->state }}</span>
                </div>
            </div>
        </div>

        <div class="card-divider"></div>

        <!-- Footer -->
        <div class="card-footer">
            <div class="validity">
                Issued: <span>{{ now()->format('d M Y') }}</span><br>
                Valid Till: <span>{{ now()->addYear()->format('d M Y') }}</span>
            </div>
            <div class="txn">TXN: {{ strtoupper($member->payment_id) }}</div>
        </div>

        <!-- Footer Image -->
        @if(isset($id_card_footer_image) && $id_card_footer_image)
            <div class="card-bottom-bar">
                <img src="{{ Storage::url($id_card_footer_image) }}" alt="Footer">
            </div>
        @else
            <div class="card-bottom-bar" style="background: #1a1a1a; padding: 15px;">
                <!-- Fallback if no image uploaded -->
            </div>
        @endif
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <button class="btn-download btn-primary" onclick="window.print()">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Download ID Card (Print / PDF)
        </button>
        <a href="{{ route('home') }}" class="btn-download btn-secondary">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Go to Home
        </a>
    </div>

    <p class="note">💡 Tip: Click "Download" → In the print dialog, choose "Save as PDF" to save your ID card.</p>

</body>
</html>
