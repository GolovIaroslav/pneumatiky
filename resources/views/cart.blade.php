@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-10 min-h-[60vh]">

    <div class="flex flex-wrap items-center justify-center gap-4 mb-8 text-lg font-bold text-center">
      <span class="text-gray-900">Košík</span>
      <span class="text-gray-400">&#8594;</span>
      <span class="text-gray-400 font-normal">Doprava a spôsob platby</span>
      <span class="text-gray-400">&#8594;</span>
      <span class="text-gray-400 font-normal">Dodacie údaje</span>
      <span class="text-gray-400 font-bold">&#8594;</span>
      <span class="text-gray-400 font-normal">Súhrn objednávky</span>
    </div>

    <div class="border border-gray-400 rounded-lg divide-y divide-gray-400 mb-6">

      <div class="hidden md:grid md:grid-cols-12 gap-3 p-4 text-xs uppercase tracking-wide text-gray-500">
        <span class="md:col-span-5">Názov produktu</span>
        <span class="md:col-span-2 text-right">Cena/ks</span>
        <span class="md:col-span-2 text-right">Počet</span>
        <span class="md:col-span-2 text-right">Medzisúčet</span>
        <span class="md:col-span-1"></span>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-12 gap-3 p-4 items-center">
        <div class="md:col-span-5 flex items-center gap-3">
          <img src="{{ asset(\'images/products/letne1.jpg\') }}" alt="Názov produktu 1" class="w-16 h-16 flex-shrink-0 object-cover rounded" />
          <span class="font-medium">Matador MP47 Hectorra 3</span>
        </div>
        <div class="md:col-span-2 flex items-center justify-between md:justify-end gap-3 text-gray-700">
          <span class="md:hidden text-xs uppercase text-gray-500">Cena/ks</span>
          <span>49,99 €</span>
        </div>
        <div class="md:col-span-2 flex items-center justify-between md:justify-end gap-3 qty-control">
          <span class="md:hidden text-xs uppercase text-gray-500">Počet</span>
          <div class="flex flex-col items-center gap-1">
            <input type="number" value="4" min="1" class="qty-input w-14 text-center border border-gray-300 rounded px-1 py-0.5 text-sm" />
            <div class="flex gap-1">
              <button type="button" data-delta="1" class="w-6 h-6 border border-gray-300 rounded text-gray-600 text-sm leading-none hover:bg-gray-100">+</button>
              <button type="button" data-delta="-1" class="w-6 h-6 border border-gray-300 rounded text-gray-600 text-sm leading-none hover:bg-gray-100">-</button>
            </div>
          </div>
        </div>
        <div class="md:col-span-2 flex items-center justify-between md:justify-end gap-3 font-medium">
          <span class="md:hidden text-xs uppercase text-gray-500">Medzisúčet</span>
          <span>199,96 €</span>
        </div>
        <button class="md:col-span-1 justify-self-end text-gray-400 hover:text-red-500">
          <img src="{{ asset(\'images/icons/trash.png\') }}" alt="Odstrániť" class="w-5 h-5 opacity-50 hover:opacity-100 transition-opacity" />
        </button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-12 gap-3 p-4 items-center">
        <div class="md:col-span-5 flex items-center gap-3">
          <img src="{{ asset(\'images/products/letne2.jpg\') }}" alt="Názov produktu 2" class="w-16 h-16 flex-shrink-0 object-cover rounded" />
          <span class="font-medium">Continental PremiumContact 6</span>
        </div>
        <div class="md:col-span-2 flex items-center justify-between md:justify-end gap-3 text-gray-700">
          <span class="md:hidden text-xs uppercase text-gray-500">Cena/ks</span>
          <span>49,99 €</span>
        </div>
        <div class="md:col-span-2 flex items-center justify-between md:justify-end gap-3 qty-control">
          <span class="md:hidden text-xs uppercase text-gray-500">Počet</span>
          <div class="flex flex-col items-center gap-1">
            <input type="number" value="4" min="1" class="qty-input w-14 text-center border border-gray-300 rounded px-1 py-0.5 text-sm" />
            <div class="flex gap-1">
              <button type="button" data-delta="1" class="w-6 h-6 border border-gray-300 rounded text-gray-600 text-sm leading-none hover:bg-gray-100">+</button>
              <button type="button" data-delta="-1" class="w-6 h-6 border border-gray-300 rounded text-gray-600 text-sm leading-none hover:bg-gray-100">-</button>
            </div>
          </div>
        </div>
        <div class="md:col-span-2 flex items-center justify-between md:justify-end gap-3 font-medium">
          <span class="md:hidden text-xs uppercase text-gray-500">Medzisúčet</span>
          <span>199,96 €</span>
        </div>
        <button class="md:col-span-1 justify-self-end text-gray-400 hover:text-red-500">
          <img src="{{ asset(\'images/icons/trash.png\') }}" alt="Odstrániť" class="w-5 h-5 opacity-50 hover:opacity-100 transition-opacity" />
        </button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-12 gap-3 p-4 items-center">
        <div class="md:col-span-5 flex items-center gap-3">
          <img src="{{ asset(\'images/products/letne3.jpg\') }}" alt="Názov produktu 3" class="w-16 h-16 flex-shrink-0 object-cover rounded" />
          <span class="font-medium">Hankook Ventus Prime 4</span>
        </div>
        <div class="md:col-span-2 flex items-center justify-between md:justify-end gap-3 text-gray-700">
          <span class="md:hidden text-xs uppercase text-gray-500">Cena/ks</span>
          <span>49,99 €</span>
        </div>
        <div class="md:col-span-2 flex items-center justify-between md:justify-end gap-3 qty-control">
          <span class="md:hidden text-xs uppercase text-gray-500">Počet</span>
          <div class="flex flex-col items-center gap-1">
            <input type="number" value="2" min="1" class="qty-input w-14 text-center border border-gray-300 rounded px-1 py-0.5 text-sm" />
            <div class="flex gap-1">
              <button type="button" data-delta="1" class="w-6 h-6 border border-gray-300 rounded text-gray-600 text-sm leading-none hover:bg-gray-100">+</button>
              <button type="button" data-delta="-1" class="w-6 h-6 border border-gray-300 rounded text-gray-600 text-sm leading-none hover:bg-gray-100">-</button>
            </div>
          </div>
        </div>
        <div class="md:col-span-2 flex items-center justify-between md:justify-end gap-3 font-medium">
          <span class="md:hidden text-xs uppercase text-gray-500">Medzisúčet</span>
          <span>99,98 €</span>
        </div>
        <button class="md:col-span-1 justify-self-end text-gray-400 hover:text-red-500">
          <img src="{{ asset(\'images/icons/trash.png\') }}" alt="Odstrániť" class="w-5 h-5 opacity-50 hover:opacity-100 transition-opacity" />
        </button>
      </div>

    </div>

    <div class="text-right font-bold text-lg mb-8">Cena produktov: 499,90 €</div>

    <div class="flex items-center justify-between">
      <a href="{{ route('products') }}" class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-full transition-colors">Späť k nákupu</a>
      <a href="{{ route('transport') }}" class="px-8 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-full transition-colors">Pokračovať</a>
    </div>

  </main>
@endsection

@push('scripts')
<script>
  function toggleHeaderLoginMenu(button) {
    const menu = button.nextElementSibling;
    if (!menu) return;

    menu.classList.toggle('hidden');
  }

  document.addEventListener('click', function (event) {
    document.querySelectorAll('.header-login-menu').forEach(function (menu) {
      const toggle = menu.previousElementSibling;
      if (!menu.contains(event.target) && (!toggle || !toggle.contains(event.target))) {
        menu.classList.add('hidden');
      }
    });
  });
</script>
@endpush
