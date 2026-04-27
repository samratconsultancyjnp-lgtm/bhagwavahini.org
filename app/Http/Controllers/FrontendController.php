<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\TeamMember;
use App\Models\Gallery;
use App\Models\Event;
use App\Models\Contact;
use App\Models\Member;
use App\Models\Setting;
use App\Models\Designation;
use Razorpay\Api\Api;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)->get();
        return view('frontend.index', compact('sliders'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function team()
    {
        $team = TeamMember::orderBy('order', 'asc')->get();
        return view('frontend.team', compact('team'));
    }

    public function gallery()
    {
        $galleries = Gallery::all();
        return view('frontend.gallery', compact('galleries'));
    }

    public function events()
    {
        $events = Event::orderBy('event_date', 'desc')->get();
        return view('frontend.events', compact('events'));
    }

    public function eventShow($id)
    {
        $event = Event::findOrFail($id);
        return view('frontend.event_show', compact('event'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'आपका संदेश सफलतापूर्वक भेज दिया गया है। (Message sent successfully)');
    }

    public function join()
    {
        $designations = Designation::all();
        return view('frontend.join', compact('designations'));
    }

    public function submitJoin(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'dob'         => 'required|date|before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d'),
            'phone'       => 'required|digits:10',
            'designation' => 'required|string|max:255',
            'state'       => 'required|string|max:100',
            'district'    => 'required|string|max:100',
            'address'     => 'required|string',
            'photo'       => 'required|image|mimes:jpeg,png,jpg|max:200', // 200KB
        ]);

        $photoPath = $request->file('photo')->store('members', 'public');

        $member = Member::create([
            'name'           => $request->name,
            'father_name'    => $request->father_name,
            'dob'            => $request->dob,
            'phone'          => $request->phone,
            'designation'    => $request->designation,
            'state'          => $request->state,
            'district'       => $request->district,
            'address'        => $request->address,
            'photo_path'     => $photoPath,
            'payment_status' => 'pending',
        ]);

        $key_id = env('RAZORPAY_KEY_ID');
        $key_secret = env('RAZORPAY_KEY_SECRET');

        if ($key_id === 'dummy_key_id' || empty($key_id)) {
            // Mock Order ID for local testing
            $razorpayOrderId = 'order_mock_' . time() . '_' . $member->id;
        } else {
            $api = new Api($key_id, $key_secret);
            $orderData = [
                'receipt'         => 'rcpt_' . $member->id,
                'amount'          => 100 * 100, // 100 rupees in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // auto capture
            ];
            $razorpayOrder = $api->order->create($orderData);
            $razorpayOrderId = $razorpayOrder['id'];
        }

        $member->update(['razorpay_order_id' => $razorpayOrderId]);
        $razorpay_key_id = $key_id;

        return view('frontend.payment', compact('member', 'razorpayOrderId', 'razorpay_key_id'));
    }



    public function verifyPayment(Request $request)
    {
        $success = true;
        $error = "Payment Failed";

        $key_id = env('RAZORPAY_KEY_ID');
        $key_secret = env('RAZORPAY_KEY_SECRET');

        if ($key_id === 'dummy_key_id' || empty($key_id)) {
            // Bypass verification for local testing
            $success = true;
        } elseif (empty($request->razorpay_payment_id) === false) {
            $api = new Api($key_id, $key_secret);

            try {
                $attributes = [
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                ];

                $api->utility->verifyPaymentSignature($attributes);
            } catch (\Exception $e) {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }

        if ($success === true) {
            $member = Member::where('razorpay_order_id', $request->razorpay_order_id)->firstOrFail();
            
            // Generate unique Member ID  e.g. BHD-2026-000012
            $memberId = 'BHD-' . now()->year . '-' . str_pad($member->id, 6, '0', STR_PAD_LEFT);

            $member->update([
                'payment_id'     => $request->razorpay_payment_id,
                'payment_status' => 'success',
                'member_id'      => $memberId,
            ]);

            return view('frontend.join_success', compact('memberId'));
        } else {
            return redirect()->route('join')->with('error', $error);
        }
    }

    public function downloadId()
    {
        return view('frontend.download_id');
    }

    public function processDownloadId(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'dob'   => 'required|date',
        ]);

        $member = Member::where('phone', $request->phone)
                        ->where('dob', $request->dob)
                        ->first();

        if (!$member) {
            return back()->with('error', 'सदस्य नहीं मिला या विवरण अमान्य है। (Invalid details or member not found.)')->withInput();
        }

        if ($member->payment_status !== 'approved') {
            return back()->with('error', 'आपका आवेदन अभी प्रशासन द्वारा स्वीकृत नहीं हुआ है। कृपया प्रतीक्षा करें। (Your application is pending admin approval.)')->withInput();
        }

        // Render ID Card since it's approved
        $id_card_header_image = Setting::getVal('id_card_header_image');
        $id_card_footer_image = Setting::getVal('id_card_footer_image');
        $id_card_watermark = Setting::getVal('id_card_watermark');

        return view('frontend.idcard', compact('member', 'id_card_header_image', 'id_card_footer_image', 'id_card_watermark'));
    }
}
