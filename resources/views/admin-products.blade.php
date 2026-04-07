@extends('layouts.admin')

@section('title', 'Admin – Produkty | PneuShop')
@section('header_title', 'Zoznam produktov')

@section('header_action')
    <a href="{{ route('admin.form') }}" class="bg-primary hover:bg-primary-dark text-white font-bold px-5 py-2.5 rounded-lg transition-colors">+ Pridať produkt</a>
@endsection

@section('content')
<div class="p-8">
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
                <tr class="hover:bg-gray-50">
                    <td class="p-4">
                        <img src="{{ asset('images/products/letne1.jpg') }}" class="w-12 h-12 object-cover rounded border">
                    </td>
                    <td class="p-4 font-bold text-gray-900">Michelin Pilot Sport 4</td>
                    <td class="p-4 text-gray-500">
                        Osobné > Pneumatiky<br>
                        <span class="text-xs text-primary">Letné • 245/40 R18</span>
                    </td>
                    <td class="p-4 font-bold">172.00 €</td>
                    <td class="p-4">
                        <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-md text-xs font-bold">5 ks</span>
                    </td>
                    <td class="p-4 text-right">
                        <a href="{{ route('admin.form') }}" class="text-primary hover:underline font-bold mr-3">Upraviť</a>
                        <button class="text-red-500 hover:underline font-bold">Vymazať</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
