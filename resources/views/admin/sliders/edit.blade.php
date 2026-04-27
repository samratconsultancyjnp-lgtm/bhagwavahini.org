@extends('admin.layout')

@section('content')
<div class="mb-10 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800 uppercase tracking-tighter">Edit Slider</h1>
        <p class="text-slate-500 font-medium italic mt-1 text-sm">Update banner image and text</p>
    </div>
    <a href="{{ route('admin.sliders.index') }}" class="text-slate-500 hover:text-slate-800 font-bold flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to List
    </a>
</div>

<div class="bg-white rounded-5xl p-10 shadow-2xl shadow-slate-200/50 border border-slate-100">
    <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div>
                <label class="block text-slate-700 font-bold mb-3 tracking-wide text-sm uppercase">Banner Title</label>
                <input type="text" name="title" value="{{ $slider->title }}" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300" placeholder="e.g. राष्ट्रहित सर्वोपरि">
            </div>
            <div>
                <label class="block text-slate-700 font-bold mb-3 tracking-wide text-sm uppercase">Change Image (Optional)</label>
                <input type="file" name="image" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-saffron focus:outline-none transition-all duration-300">
                <p class="text-xs text-slate-400 mt-2 italic">Current Image:</p>
                <img src="{{ Storage::url($slider->image_path) }}" class="h-20 w-32 rounded-xl mt-2 object-cover border border-slate-100">
            </div>
        </div>
        <div class="mb-8">
            <label class="block text-slate-700 font-bold mb-3 tracking-wide text-sm uppercase">Short Description</label>
            <textarea name="description" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-saffron focus:bg-white focus:outline-none transition-all duration-300" rows="3" placeholder="Describe the focus of this banner...">{{ $slider->description }}</textarea>
        </div>
        <button type="submit" class="bg-saffron text-white font-black py-4 px-12 rounded-2xl shadow-xl shadow-saffron/30 hover:bg-saffronDark transition transform hover:scale-[1.02]">
            Update Slider
        </button>
    </form>
</div>
@endsection
