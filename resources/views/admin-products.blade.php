@extends('layouts.app')

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
                <img src="{{ asset(\'images/products/letne1.jpg\') }}" class="w-12 h-12 object-cover rounded border">
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
  </main>
@endsection

@push('scripts')
E html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin – Produkty | PneuShop</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script>tailwind.config = { theme: { extend: { colors: { primary: '#646cfe', 'primary-dark': '#4A4ECC' }, fontFamily: { sans: ['Inter', 'sans-serif'] } } } }</script>
</head>

<body class="font-sans bg-gray-50 text-gray-900 flex h-screen overflow-hidden">
  <aside class="w-64 bg-white border-r border-gray-200 flex flex-col hidden md:flex">
    <div class="h-16 flex items-center px-6 border-b border-gray-200">
      <img src="{{ asset(\'images/logo2.jpg\') }}" class="h-8">
    </div>
    <nav class="flex-1 p-4 space-y-2">
      <a href="{{ route('admin.products') }}" class="block bg-primary/10 text-primary font-bold px-4 py-3 rounded-lg">📦 Produkty</a>
      <a href="{{ route('admin.form') }}" class="block text-gray-600 hover:bg-gray-100 font-semibold px-4 py-3 rounded-lg transition-colors">➕ Pridať produkt</a>
      <a href="#" class="block text-gray-600 hover:bg-gray-100 font-semibold px-4 py-3 rounded-lg transition-colors">🛒 Objednávky</a>
    </nav>
    <div class="p-4 border-t">
      <a href="{{ route('home') }}" class="block text-red-500 hover:bg-red-50 font-bold px-4 py-3 rounded-lg text-center transition-colors">Odhlásiť sa</a>
    </div>
  </aside>

  <main class="flex-1 flex flex-col h-screen overflow-y-auto">
    <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8">
      <h1 class="text-xl font-bold">Zoznam produktov</h1>
      <a href="{{ route('admin.form') }}" class="bg-primary hover:bg-primary-dark text-white font-bold px-5 py-2.5 rounded-lg transition-colors">+ Pridať produkt</a>
    </header>

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
                <img src="{{ asset(\'images/products/letne1.jpg\') }}" class="w-12 h-12 object-cover rounded border">
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
  </main>
@endpush
