@extends('admin.layout')

@section('content')
<div class="mb-10 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800">MANAGE SLIDERS</h1>
        <p class="text-slate-500 font-medium italic mt-1">Control top banner images on the home page</p>
    </div>
</div>

<!-- Add Form -->
<div class="bg-slate-50 rounded-3xl p-8 mb-12 border border-slate-200">
    <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-saffron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-9-4h18c1.1 0 2 .9 2 2v6c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V7c0-1.1.9-2 2-2z"></path></svg>
        Add New Slider
    </h2>
    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div>
                <label class="block text-slate-700 font-bold mb-3">Title</label>
                <input type="text" name="title" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl focus:border-saffron focus:outline-none focus:ring-2 focus:ring-saffron/20 transition-all duration-300" placeholder="e.g. Pledge for Nation Building">
            </div>
            <div>
                <label class="block text-slate-700 font-bold mb-3">Choose Image (Required)</label>
                <input type="file" name="image" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl focus:border-saffron focus:outline-none transition-all duration-300" required>
            </div>
        </div>
        <div class="mb-8">
            <label class="block text-slate-700 font-bold mb-3">Short Description</label>
            <textarea name="description" class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl focus:border-saffron focus:outline-none transition-all duration-300" rows="3" placeholder="Write a few words about this slider..."></textarea>
        </div>
        <button type="submit" class="bg-saffron text-white font-bold py-4 px-12 rounded-2xl shadow-xl shadow-saffron/20 hover:bg-saffronDark transition transform hover:scale-[1.02]">
            Save Slider
        </button>
    </form>
</div>

<!-- List Table -->
<div class="overflow-hidden rounded-3xl border border-slate-100 shadow-sm">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">Image</th>
                <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">Details</th>
                <th class="px-8 py-5 text-right text-xs font-bold text-slate-500 uppercase tracking-widest">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-100">
            @foreach($sliders as $slider)
            <tr class="hover:bg-slate-50/50 transition">
                <td class="px-8 py-6 whitespace-nowrap">
                    <img src="{{ Storage::url($slider->image_path) }}" class="h-20 w-40 object-cover rounded-2xl shadow-md border-2 border-white">
                </td>
                <td class="px-8 py-6">
                    <div class="text-lg font-bold text-slate-800">{{ $slider->title }}</div>
                    <div class="text-sm text-slate-400 mt-1 line-clamp-1">{{ $slider->description }}</div>
                </td>
                <td class="px-8 py-6 text-right whitespace-nowrap space-x-2">
                    <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="inline-block bg-blue-50 text-blue-500 p-3 rounded-xl hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-sm border border-blue-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </a>
                    <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?');" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-50 text-red-500 p-3 rounded-xl hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm border border-red-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
