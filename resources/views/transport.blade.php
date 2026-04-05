@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-10 min-h-[60vh]">

    <div class="flex flex-wrap items-center justify-center gap-4 mb-10 text-center text-lg">
      <a href="{{ route('cart') }}">
        <span class="text-gray-400">Košík</span>
      </a>
      <span class="text-gray-400 font-bold">&#8594;</span>
      <span class="text-gray-900 font-bold">Doprava a spôsob platby</span>
      <span class="text-gray-400 font-bold">&#8594;</span>
      <span class="text-gray-400">Dodacie údaje</span>
      <span class="text-gray-400 font-bold">&#8594;</span>
      <span class="text-gray-400">Súhrn objednávky</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-8">
      <div class="space-y-2">
        <label class="flex items-center justify-between border border-gray-400 rounded-lg px-3 py-2 cursor-pointer">
          <span class="flex items-center gap-3">
            <input type="radio" name="doprava" class="accent-primary" checked />
            <span class="text-base md:text-xl leading-none">Packeta</span>
          </span>
          <span class="text-base md:text-xl leading-none">+ 1,29 €</span>
        </label>
        <label class="flex items-center justify-between border border-gray-400 rounded-lg px-3 py-2 cursor-pointer">
          <span class="flex items-center gap-3">
            <input type="radio" name="doprava" class="accent-primary" />
            <span class="text-base md:text-xl leading-none">Doručenie na adresu</span>
          </span>
          <span class="text-base md:text-xl leading-none">+ 3,29 €</span>
        </label>
        <label class="flex items-center justify-between border border-gray-400 rounded-lg px-3 py-2 cursor-pointer">
          <span class="flex items-center gap-3">
            <input type="radio" name="doprava" class="accent-primary" />
            <span class="text-base md:text-xl leading-none">Na predajni</span>
          </span>
          <span class="text-base md:text-xl leading-none">zadarmo</span>
        </label>
        <label class="flex items-center justify-between border border-gray-400 rounded-lg px-3 py-2 cursor-pointer">
          <span class="flex items-center gap-3">
            <input type="radio" name="doprava" class="accent-primary" />
            <span class="text-base md:text-xl leading-none">Zo skladu</span>
          </span>
          <span class="text-base md:text-xl leading-none">+ 0,99 €</span>
        </label>
      </div>

      <div class="space-y-2">
        <label class="flex items-center justify-between border border-gray-400 rounded-lg px-3 py-2 cursor-pointer">
          <span class="flex items-center gap-3">
            <input type="radio" name="platba" class="accent-primary" checked />
            <span class="text-base md:text-xl leading-none">Kartou online</span>
          </span>
          <span class="text-base md:text-xl leading-none">zadarmo</span>
        </label>
        <label class="flex items-center justify-between border border-gray-400 rounded-lg px-3 py-2 cursor-pointer">
          <span class="flex items-center gap-3">
            <input type="radio" name="platba" class="accent-primary" />
            <span class="text-base md:text-xl leading-none">Revolut</span>
          </span>
          <span class="text-base md:text-xl leading-none">+ 0,99 €</span>
        </label>
        <label class="flex items-center justify-between border border-gray-400 rounded-lg px-3 py-2 cursor-pointer">
          <span class="flex items-center gap-3">
            <input type="radio" name="platba" class="accent-primary" />
            <span class="text-base md:text-xl leading-none">PaySafeCard</span>
          </span>
          <span class="text-base md:text-xl leading-none">+ 1,49 €</span>
        </label>
        <label class="flex items-center justify-between border border-gray-400 rounded-lg px-3 py-2 cursor-pointer">
          <span class="flex items-center gap-3">
            <input type="radio" name="platba" class="accent-primary" />
            <span class="text-base md:text-xl leading-none">Kartou pri prebratí</span>
          </span>
          <span class="text-base md:text-xl leading-none">+ 2,99 €</span>
        </label>
        <label class="flex items-center justify-between border border-gray-400 rounded-lg px-3 py-2 cursor-pointer">
          <span class="flex items-center gap-3">
            <input type="radio" name="platba" class="accent-primary" />
            <span class="text-base md:text-xl leading-none">Hotovosťou pri prebratí</span>
          </span>
          <span class="text-base md:text-xl leading-none">+ 5 €</span>
        </label>
      </div>
    </div>

    <div class="text-right text-lg mb-2">Cena produktov: 499,90 €</div>
    <div class="text-right font-bold text-lg mb-8">Celková cena: 501,19 €</div>

    <div class="flex items-center justify-between gap-4">
      <a href="{{ route('cart') }}" class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-full transition-colors">Späť</a>
      <a href="{{ route('delivery') }}" class="px-8 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-full transition-colors">Pokračovať</a>
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
