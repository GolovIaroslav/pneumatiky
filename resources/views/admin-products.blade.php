@extends('layouts.admin')

@section('title', 'Admin – Produkty | PneuShop')
@section('header_title', 'Zoznam produktov')

@section('header_action')
    <a href="{{ route('admin.form') }}" class="bg-primary hover:bg-primary-dark text-white font-bold px-5 py-2.5 rounded-lg transition-colors">+ Pridať produkt</a>
@endsection

@section('content')
<div class="p-8">
    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg font-medium shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg font-medium shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-xl overflow-x-auto shadow-sm">
        <table class="w-full text-left border-collapse min-w-[600px]">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500">
                    <th class="p-4">Foto</th>
                    <th class="p-4">Názov produktu</th>
                    <th class="p-4">Kategória</th>
                    <th class="p-4">Cena</th>
                    <th class="p-4">Sklad</th>
                    <th class="p-4 text-right">Akcie</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="p-4">
                        @php
                            $mainImg = $product->images->firstWhere('is_main', true) ?? $product->images->first();
                            $imgSrc = $mainImg ? asset($mainImg->image_path) : asset('images/products/letne1.jpg');
                        @endphp
                        <img src="{{ $imgSrc }}" class="w-12 h-12 object-cover rounded border">
                    </td>
                    <td class="p-4 font-bold text-gray-900">{{ trim(($product->brand ? $product->brand . ' ' : '') . $product->name) }}</td>
                    <td class="p-4 text-gray-500">
                        {{ $product->category->parent->name ?? 'N/A' }} > {{ $product->category->name ?? 'N/A' }}<br>
                        <span class="text-xs text-primary">
                            {{ ucfirst($product->season) }} • 
                            @if($product->width){{ $product->width }}/{{ $product->profile }} @endif
                            R{{ str_replace('r', '', strtolower($product->diameter)) }}
                        </span>
                    </td>
                    <td class="p-4 font-bold">{{ number_format((float) $product->price, 2, '.', '') }} €</td>
                    <td class="p-4">
                        @if($product->stock > 0)
                            <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-md text-xs font-bold">{{ $product->stock }} ks</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-md text-xs font-bold">Vypredané</span>
                        @endif
                    </td>
                    <td class="p-4 text-right">
                        <a href="{{ route('admin.form', $product->id) }}" class="text-primary hover:underline font-bold mr-3">Upraviť</a>
                        <form action="{{ route('admin.delete', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Naozaj chcete vymazať tento produkt?');">
                            @csrf
                            <button type="submit" class="text-red-500 hover:underline font-bold">Vymazať</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-500">Zatiaľ neboli pridané žiadne produkty.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
