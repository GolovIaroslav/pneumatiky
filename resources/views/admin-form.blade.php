@extends('layouts.admin')

@section('title', 'Admin – Pridať produkt | PneuShop')
@section('header_title', 'Pridať / Upraviť produkt')

@section('header_action')
    <a href="{{ route('admin.products') }}" class="text-sm font-bold text-gray-400 hover:text-primary transition-colors">← Späť na zoznam</a>
@endsection

@section('content')
<div class="p-8 max-w-5xl">
    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg font-medium shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg font-medium shadow-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.save', $product->id ?? '') }}" enctype="multipart/form-data" class="bg-white border border-gray-200 rounded-xl shadow-sm p-8 space-y-8">
        @csrf
        <div>
            <h2 class="text-lg font-bold border-b pb-2 mb-4">Základné informácie</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold mb-2 text-gray-700">Značka</label>
                    <input type="text" name="brand" value="{{ old('brand', $product->brand ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary transition-all">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold mb-2 text-gray-700">Názov produktu</label>
                    <input type="text" name="name" required value="{{ old('name', $product->name ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Cena (€)</label>
                    <input type="number" name="price" step="0.01" required value="{{ old('price', isset($product) ? number_format((float)$product->price, 2, '.', '') : '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Skladom (ks)</label>
                    <input type="number" name="stock" required value="{{ old('stock', $product->stock ?? 0) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold mb-2 text-gray-700">Opis produktu</label>
                    <textarea name="description" rows="4" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-lg font-bold border-b pb-2 mb-4">Kategorizácia a Parametre</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold mb-2">Kategória</label>
                    <select name="category_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white">
                        <option value="">Vyberte kategóriu...</option>
                        @foreach($categories as $category)
                            @if($category->parent_id !== null)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                                    {{ $category->parent->name ?? $category->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Sezónnosť</label>
                    <select name="season" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white">
                        <option value="">-- Neuvedené --</option>
                        <option value="letne" @selected(old('season', $product->season ?? '') == 'letne')>Letné</option>
                        <option value="zimne" @selected(old('season', $product->season ?? '') == 'zimne')>Zimné</option>
                        <option value="celorocne" @selected(old('season', $product->season ?? '') == 'celorocne')>Celoročné</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Šírka (mm) *</label>
                    <select name="width" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                        <option value="">-- Vyberte --</option>
                        @foreach([25,28,30,32,35,38,40,42,45,47,48,50,52,54,56,80,90,100,110,120,130,140,150,160,170,180,190,195,200,205,215,225,235,245,255,265,275,285,295,300,310,320,330,340,350,360,370,380] as $val)
                            <option value="{{ $val }}" @selected((int)old('width', $product->width ?? '') === $val)>{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Profil (%)</label>
                    <select name="profile" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                        <option value="">-- Neuvedené --</option>
                        @foreach([0,25,30,35,40,45,50,55,60,65,70,75,80,85,90] as $val)
                            <option value="{{ $val }}" @selected(old('profile', $product->profile ?? '') !== '' && (int)old('profile', $product->profile ?? '') === $val)>{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Priemer (") *</label>
                    <select name="diameter" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                        <option value="">-- Vyberte --</option>
                        @foreach(['R10','R12','R13','R14','R15','R16','R17','R18','R19','R20','R21','R22','R24','R26','R27.5','R28','R29','R30'] as $val)
                            <option value="{{ $val }}" @selected(strtoupper(old('diameter', $product->diameter ?? '')) == $val)>{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-3">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="has_spikes" value="1" @checked(old('has_spikes', $product->has_spikes ?? false)) class="w-5 h-5 accent-primary rounded">
                        <span class="font-bold">Pneumatika s hrotmi</span>
                    </label>
                </div>
            </div>
        </div>

        @if(isset($product) && $product->images->count() > 0)
        <div>
            <h2 class="text-lg font-bold border-b pb-2 mb-4">Existujúce Fotografie</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($product->images as $img)
                <div class="relative group border border-gray-200 rounded">
                    <img src="{{ asset($img->image_path) }}" class="w-full aspect-square object-cover rounded">
                    <button type="button" onclick="document.getElementById('delete-img-{{ $img->id }}').submit()" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div>
            <h2 class="text-lg font-bold border-b pb-2 mb-4">Pridať Fotografie (min. 2 pre nový produkt)</h2>
            <input type="file" name="images[]" multiple accept="image/*"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 border border-gray-300 rounded-lg p-2 cursor-pointer">
        </div>

        <div class="pt-6 border-t flex justify-end gap-4">
            <a href="{{ route('admin.products') }}"
                class="px-6 py-3 text-gray-500 font-bold hover:bg-gray-100 rounded-lg transition-colors">Zrušiť</a>
            <button type="submit"
                class="bg-primary hover:bg-primary-dark text-white font-bold px-10 py-3 rounded-lg shadow-lg shadow-primary/20 hover:shadow-primary/40 -translate-y-0 hover:-translate-y-0.5 transition-all duration-200">
                Uložiť produkt
            </button>
        </div>
    </form>

    @if(isset($product) && $product->images->count() > 0)
        @foreach($product->images as $img)
        <form id="delete-img-{{ $img->id }}" action="{{ route('admin.image.delete', $img->id) }}" method="POST" class="hidden">
            @csrf
        </form>
        @endforeach
    @endif
</div>
@endsection
