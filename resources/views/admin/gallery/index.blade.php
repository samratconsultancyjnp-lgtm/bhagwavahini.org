@extends('admin.layout')

@section('content')
<div class="mb-10 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800">MANAGE GALLERY</h1>
        <p class="text-slate-500 font-medium italic mt-1">Organize and display party event photos</p>
    </div>
</div>

<!-- Add Form -->
<div class="bg-white rounded-5xl p-10 mb-12 shadow-2xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-40 h-40 bg-purple-500/5 rounded-bl-full"></div>
    <h2 class="text-2xl font-black text-slate-800 mb-8 flex items-center">
        <div class="w-12 h-12 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-500 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        </div>
        Add New Photo
    </h2>
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div>
                <label class="block text-slate-700 font-bold mb-3 tracking-wide">Image Title</label>
                <input type="text" name="title" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-purple-500 focus:bg-white focus:outline-none transition-all duration-300" placeholder="e.g. Rally in Mumbai">
            </div>
            <div>
                <label class="block text-slate-700 font-bold mb-3 tracking-wide">Category</label>
                <input type="text" name="category" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-purple-500 focus:bg-white focus:outline-none transition-all duration-300" placeholder="e.g. Events">
            </div>
            <div>
                <label class="block text-slate-700 font-bold mb-3 tracking-wide">Choose Image (Required)</label>
                <input type="file" name="image" class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:border-purple-500 focus:bg-white focus:outline-none transition-all duration-300" required>
            </div>
        </div>
        <button type="submit" class="bg-purple-600 text-white font-black py-4 px-12 rounded-2xl shadow-xl shadow-purple-500/30 hover:bg-purple-700 transition transform hover:scale-[1.02]">
            Save to Gallery
        </button>
    </form>
</div>

<!-- List Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
    @foreach($galleries as $gallery)
    <div class="bg-white rounded-4xl p-4 shadow-xl border border-slate-100 group">
        <div class="relative overflow-hidden rounded-3xl h-48 mb-4">
            <img src="{{ Storage::url($gallery->image_path) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex items-end p-6">
                <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Delete this image?');" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-500 text-white font-bold py-3 rounded-2xl hover:bg-red-600 transition shadow-lg">
                        Delete Image
                    </button>
                </form>
            </div>
        </div>
        <h3 class="font-black text-slate-800 px-2 line-clamp-1 uppercase tracking-tighter">{{ $gallery->title ?? 'Untitled' }}</h3>
        <p class="text-xs text-slate-400 font-bold px-2 mt-1 uppercase tracking-widest">{{ $gallery->category }}</p>
    </div>
    @endforeach
</div>
@endsection
