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

class AdminController extends Controller
{
    public function dashboard()
    {
        $membersCount = Member::where('payment_status', '!=', 'pending')->count();
        $paidMembersCount = Member::where('payment_status', 'success')->count();
        $eventsCount = Event::count();
        $galleryCount = Gallery::count();
        return view('admin.dashboard', compact('membersCount', 'paidMembersCount', 'eventsCount', 'galleryCount'));
    }

    public function slidersIndex() { return view('admin.sliders.index', ['sliders' => Slider::all()]); }
    public function teamIndex() { return view('admin.team.index', ['team' => TeamMember::orderBy('order')->get()]); }
    public function galleryIndex() { return view('admin.gallery.index', ['galleries' => Gallery::all()]); }
    public function eventsIndex() { return view('admin.events.index', ['events' => Event::all()]); }
    public function membersIndex() { return view('admin.members.index', ['members' => Member::where('payment_status', '!=', 'pending')->latest()->get()]); }
    public function contactsIndex() { return view('admin.contacts.index', ['contacts' => Contact::all()]); }
    public function designationsIndex() { return view('admin.designations.index', ['designations' => Designation::all()]); }

    public function settingsIndex()
    {
        $razorpay_key = Setting::getVal('razorpay_key');
        $razorpay_secret = Setting::getVal('razorpay_secret');
        
        $id_card_header_image = Setting::getVal('id_card_header_image');
        $id_card_footer_image = Setting::getVal('id_card_footer_image');
        $id_card_watermark = Setting::getVal('id_card_watermark');
        
        $upi_id = Setting::getVal('upi_id');
        $bank_details = Setting::getVal('bank_details');
        
        $site_name = Setting::getVal('site_name', 'भगवा दल');
        $site_address = Setting::getVal('site_address');
        $site_email = Setting::getVal('site_email');
        $site_phone = Setting::getVal('site_phone');
        $site_map_iframe = Setting::getVal('site_map_iframe');
        $site_logo = Setting::getVal('site_logo');
        $site_favicon = Setting::getVal('site_favicon');

        return view('admin.settings.index', compact(
            'razorpay_key', 'razorpay_secret', 
            'id_card_header_image', 'id_card_footer_image', 'id_card_watermark',
            'upi_id', 'bank_details',
            'site_name', 'site_address', 'site_email', 'site_phone', 'site_map_iframe', 'site_logo', 'site_favicon'
        ));
    }

    public function settingsUpdate(Request $request)
    {
        Setting::updateOrCreate(['key' => 'razorpay_key'], ['value' => $request->razorpay_key]);
        Setting::updateOrCreate(['key' => 'razorpay_secret'], ['value' => $request->razorpay_secret]);
        Setting::updateOrCreate(['key' => 'upi_id'], ['value' => $request->upi_id]);
        Setting::updateOrCreate(['key' => 'bank_details'], ['value' => $request->bank_details]);
        
        Setting::updateOrCreate(['key' => 'site_name'], ['value' => $request->site_name]);
        Setting::updateOrCreate(['key' => 'site_address'], ['value' => $request->site_address]);
        Setting::updateOrCreate(['key' => 'site_email'], ['value' => $request->site_email]);
        Setting::updateOrCreate(['key' => 'site_phone'], ['value' => $request->site_phone]);
        Setting::updateOrCreate(['key' => 'site_map_iframe'], ['value' => $request->site_map_iframe]);
        
        if($request->hasFile('id_card_header_image')) {
            $path = $request->file('id_card_header_image')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'id_card_header_image'], ['value' => $path]);
        }
        
        if($request->hasFile('id_card_footer_image')) {
            $path = $request->file('id_card_footer_image')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'id_card_footer_image'], ['value' => $path]);
        }
        
        if($request->hasFile('id_card_watermark')) {
            $path = $request->file('id_card_watermark')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'id_card_watermark'], ['value' => $path]);
        }
        
        if($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'site_logo'], ['value' => $path]);
        }
        
        if($request->hasFile('site_favicon')) {
            $path = $request->file('site_favicon')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'site_favicon'], ['value' => $path]);
        }

        return back()->with('success', 'Settings updated successfully');
    }

    // Sliders
    public function slidersStore(Request $request) {
        $request->validate(['image' => 'required|image', 'title' => 'nullable|string', 'description' => 'nullable|string']);
        $path = $request->file('image')->store('sliders', 'public');
        Slider::create(['title' => $request->title, 'description' => $request->description, 'image_path' => $path]);
        return back()->with('success', 'Slider added.');
    }
    public function slidersDestroy($id) {
        Slider::findOrFail($id)->delete();
        return back()->with('success', 'Slider deleted.');
    }
    public function slidersEdit($id) {
        return view('admin.sliders.edit', ['slider' => Slider::findOrFail($id)]);
    }
    public function slidersUpdate(Request $request, $id) {
        $request->validate(['title' => 'nullable|string', 'description' => 'nullable|string', 'image' => 'nullable|image']);
        $slider = Slider::findOrFail($id);
        if($request->hasFile('image')) {
            $path = $request->file('image')->store('sliders', 'public');
            $slider->image_path = $path;
        }
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->save();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated.');
    }

    // Team
    public function teamStore(Request $request) {
        $request->validate(['name' => 'required|string', 'designation' => 'required|string', 'image' => 'nullable|image', 'order' => 'nullable|integer']);
        $path = $request->hasFile('image') ? $request->file('image')->store('team', 'public') : null;
        TeamMember::create(['name' => $request->name, 'designation' => $request->designation, 'image_path' => $path, 'order' => $request->order ?? 0]);
        return back()->with('success', 'Team member added.');
    }
    public function teamDestroy($id) {
        TeamMember::findOrFail($id)->delete();
        return back()->with('success', 'Team member deleted.');
    }

    // Gallery
    public function galleryStore(Request $request) {
        $request->validate(['image' => 'required|image', 'title' => 'nullable|string', 'category' => 'nullable|string']);
        $path = $request->file('image')->store('gallery', 'public');
        Gallery::create(['title' => $request->title, 'category' => $request->category, 'image_path' => $path]);
        return back()->with('success', 'Image added to gallery.');
    }
    public function galleryDestroy($id) {
        Gallery::findOrFail($id)->delete();
        return back()->with('success', 'Gallery image deleted.');
    }

    // Events
    public function eventsStore(Request $request) {
        $request->validate(['title' => 'required|string', 'event_date' => 'required|date', 'description' => 'nullable|string', 'image' => 'nullable|image']);
        $path = $request->hasFile('image') ? $request->file('image')->store('events', 'public') : null;
        Event::create(['title' => $request->title, 'event_date' => $request->event_date, 'description' => $request->description, 'image_path' => $path]);
        return back()->with('success', 'Event added.');
    }
    public function eventsDestroy($id) {
        Event::findOrFail($id)->delete();
        return back()->with('success', 'Event deleted.');
    }

    // Members
    public function membersApprove(Request $request, $id) {
        $member = Member::findOrFail($id);
        
        $data = [
            'payment_status' => 'approved'
        ];

        // Only update these if they are in the request (coming from the modal edit form)
        if ($request->has('name')) {
            $data = array_merge($data, $request->only([
                'name', 'father_name', 'dob', 'phone', 'state', 'district', 'address', 'designation'
            ]));
        }

        $member->update($data);

        return back()->with('success', 'Member approved successfully.');
    }

    public function memberIdCard($id)
    {
        $member = Member::findOrFail($id);
        
        $id_card_header_image = Setting::getVal('id_card_header_image');
        $id_card_footer_image = Setting::getVal('id_card_footer_image');
        $id_card_watermark = Setting::getVal('id_card_watermark');

        return view('frontend.idcard', compact('member', 'id_card_header_image', 'id_card_footer_image', 'id_card_watermark'));
    }

    public function membersDestroy($id) {
        Member::findOrFail($id)->delete();
        return back()->with('success', 'Member deleted.');
    }

    // Contacts
    public function contactsDestroy($id) {
        Contact::findOrFail($id)->delete();
        return back()->with('success', 'Contact message deleted.');
    }

    // Designations
    public function designationsStore(Request $request) {
        $request->validate(['title' => 'required|string|max:255']);
        Designation::create(['title' => $request->title]);
        return back()->with('success', 'Designation added successfully.');
    }

    public function designationsDestroy($id) {
        Designation::findOrFail($id)->delete();
        return back()->with('success', 'Designation deleted.');
    }
}
