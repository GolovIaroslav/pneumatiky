@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-10 min-h-[60vh]">

    <div class="flex flex-wrap items-center justify-center gap-4 mb-10 text-center text-lg">
        <a href="{{ route('cart') }}">
            <span class="text-gray-400">Košík</span>
        </a>
        <span class="text-gray-400 font-bold">&#8594;</span>
        <a href="{{ route('transport') }}">
            <span class="text-gray-400">Doprava a spôsob platby</span>
        </a>
        <span class="text-gray-400 font-bold">&#8594;</span>
        <a href="{{ route('delivery') }}">
            <span class="text-gray-400">Dodacie údaje</span>
        </a>
        <span class="text-gray-400 font-bold">&#8594;</span>
        <span class="text-gray-900 font-bold">Súhrn objednávky</span>
    </div>

    <div class="max-w-4xl mx-auto space-y-6">
      <section class="border border-gray-300 rounded-lg overflow-hidden">
        <div class="px-5 py-3 bg-gray-50 border-b border-gray-200">
          <h1 class="text-lg font-bold">Súhrn produktov</h1>
        </div>

        <div class="hidden md:grid grid-cols-12 gap-3 px-5 py-3 text-xs uppercase tracking-wide text-gray-500 border-b border-gray-200">
          <span class="col-span-5">Produkt</span>
          <span class="col-span-2 text-right">Množstvo</span>
          <span class="col-span-2 text-right">Cena/ks</span>
          <span class="col-span-3 text-right">Medzisúčet</span>
        </div>

        <div class="divide-y divide-gray-200">
          <div class="grid grid-cols-1 md:grid-cols-12 gap-3 px-5 py-4 items-center">
            <div class="md:col-span-5 flex items-center gap-3">
              <img src="{{ asset(\'images/products/letne1.jpg\') }}" alt="Matador MP47 Hectorra 3" class="w-14 h-14 rounded object-cover flex-shrink-0" />
              <span class="font-medium">Matador MP47 Hectorra 3</span>
            </div>
            <span class="md:col-span-2 md:text-right text-gray-700">4 ks</span>
            <span class="md:col-span-2 md:text-right text-gray-700">49,99 €</span>
            <span class="md:col-span-3 md:text-right font-medium">199,96 €</span>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-12 gap-3 px-5 py-4 items-center">
            <div class="md:col-span-5 flex items-center gap-3">
              <img src="{{ asset(\'images/products/letne2.jpg\') }}" alt="Continental PremiumContact 6" class="w-14 h-14 rounded object-cover flex-shrink-0" />
              <span class="font-medium">Continental PremiumContact 6</span>
            </div>
            <span class="md:col-span-2 md:text-right text-gray-700">4 ks</span>
            <span class="md:col-span-2 md:text-right text-gray-700">49,99 €</span>
            <span class="md:col-span-3 md:text-right font-medium">199,96 €</span>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-12 gap-3 px-5 py-4 items-center">
            <div class="md:col-span-5 flex items-center gap-3">
              <img src="{{ asset(\'images/products/letne3.jpg\') }}" alt="Hankook Ventus Prime 4" class="w-14 h-14 rounded object-cover flex-shrink-0" />
              <span class="font-medium">Hankook Ventus Prime 4</span>
            </div>
            <span class="md:col-span-2 md:text-right text-gray-700">2 ks</span>
            <span class="md:col-span-2 md:text-right text-gray-700">49,99 €</span>
            <span class="md:col-span-3 md:text-right font-medium">99,98 €</span>
          </div>
        </div>
      </section>

      <section class="border border-gray-300 rounded-lg overflow-hidden">
        <div class="px-5 py-3 bg-gray-50 border-b border-gray-200">
          <h2 class="text-lg font-bold">Doprava a platba</h2>
        </div>
        <div class="px-5 py-4 space-y-2">
          <div class="flex items-center justify-between">
            <span class="text-gray-700">Doprava: Packeta</span>
            <span class="font-medium">+ 1,29 €</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-gray-700">Platba: Kartou online</span>
            <span class="font-medium">zadarmo</span>
          </div>
        </div>
      </section>

      <section class="border border-gray-300 rounded-lg p-5 bg-gray-50">
        <div class="space-y-2 text-right">
          <p class="text-gray-700">Cena produktov: <span class="font-medium">499,90 €</span></p>
          <p class="text-gray-700">Doprava a platba: <span class="font-medium">1,29 €</span></p>
          <p class="text-2xl font-bold">Celkom na úhradu: 501,19 €</p>
        </div>
      </section>

      <div class="flex items-center justify-between gap-4 pt-2">
        <a href="{{ route('delivery') }}" class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-full transition-colors">Späť</a>
        <a href="{{ route('confirmation') }}" class="px-8 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-full transition-colors">Potvrdiť objednávku</a>
      </div>
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
