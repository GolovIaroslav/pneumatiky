@extends('layouts.app')

@section('content')
<section class="max-w-6xl mx-auto px-6 py-4">
    <div class="img-ph w-full rounded pb-[37%] md:pb-[25%] relative">
      <div class="absolute inset-0 flex items-center justify-center">
        <img src="{{ asset(\'images/ad.png\') }}" alt="Reklamný banner" class="w-full h-full object-cover rounded" />
      </div>
    </div>
  </section>

  <section class="max-w-6xl mx-auto px-6 py-4">
    <div class="flex items-center gap-3 mb-5">
      <span class="text-primary font-semibold text-base whitespace-nowrap">Najnovšie produkty</span>
      <div class="flex-1 h-px bg-gray-200"></div>
      <div class="flex gap-1.5">
        <button class="w-7 h-7 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
          <img src="{{ asset(\'images/icons/arrow-left.png\') }}" alt="Späť" class="w-3 h-3 opacity-60" />
        </button>
        <button class="w-7 h-7 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
          <img src="{{ asset(\'images/icons/arrow-right.png\') }}" alt="Ďalej" class="w-3 h-3 opacity-60" />
        </button>
      </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      <a href="{{ route('product.detail') }}" class="group block text-center">
        <div class="img-ph w-full aspect-square mb-2.5 relative rounded border border-gray-200">
           <img src="{{ asset(\'images/products/letne1.jpg\') }}" alt="Matador MP47" class="w-full h-full object-cover" />
        </div>
        <p class="font-bold text-sm mb-3 group-hover:text-primary transition-colors">Matador MP47 Hectorra 3</p>
        <div class="inline-block bg-gray-100 text-primary font-bold text-sm px-4 py-1.5 rounded-md border border-gray-200">54.90 €</div>
      </a>
      <a href="{{ route('product.detail') }}" class="group block text-center">
        <div class="img-ph w-full aspect-square mb-2.5 relative rounded border border-gray-200">
           <img src="{{ asset(\'images/products/letne2.jpg\') }}" alt="Continental PremiumContact" class="w-full h-full object-cover" />
        </div>
        <p class="font-bold text-sm mb-3 group-hover:text-primary transition-colors">Continental PremiumContact 6</p>
        <div class="inline-block bg-gray-100 text-primary font-bold text-sm px-4 py-1.5 rounded-md border border-gray-200">112.50 €</div>
      </a>
      <a href="{{ route('product.detail') }}" class="group block text-center">
        <div class="img-ph w-full aspect-square mb-2.5 relative rounded border border-gray-200">
           <img src="{{ asset(\'images/products/zimne1.jpg\') }}" alt="Michelin Alpin 6" class="w-full h-full object-cover" />
        </div>
        <p class="font-bold text-sm mb-3 group-hover:text-primary transition-colors">Michelin Alpin 6 (Zimné)</p>
        <div class="inline-block bg-gray-100 text-primary font-bold text-sm px-4 py-1.5 rounded-md border border-gray-200">135.00 €</div>
      </a>
      <a href="{{ route('product.detail') }}" class="group block text-center">
        <div class="img-ph w-full aspect-square mb-2.5 relative rounded border border-gray-200">
           <img src="{{ asset(\'images/products/letne3.jpg\') }}" alt="Hankook Ventus" class="w-full h-full object-cover" />
        </div>
        <p class="font-bold text-sm mb-3 group-hover:text-primary transition-colors">Hankook Ventus Prime 4</p>
        <div class="inline-block bg-gray-100 text-primary font-bold text-sm px-4 py-1.5 rounded-md border border-gray-200">72.30 €</div>
      </a>
    </div>
  </section>

  <section class="bg-primary text-white py-8 my-4">
    <div class="max-w-6xl mx-auto px-6">
      <p class="font-semibold text-sm mb-4">Naše výhody</p>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-8 gap-y-2.5 text-sm">
        <div class="space-y-2.5">
          <div class="flex items-center gap-2.5">
            <img src="{{ asset(\'images/icons/check-white.png\') }}" alt="Výhoda" class="w-4 h-4 flex-shrink-0" />
            <span>Produkty vyrobené v USA</span>
          </div>
          <div class="flex items-center gap-2.5">
            <img src="{{ asset(\'images/icons/check-white.png\') }}" alt="Výhoda" class="w-4 h-4 flex-shrink-0" />
            <span>Vlastná výroba</span>
          </div>
          <div class="flex items-center gap-2.5">
            <img src="{{ asset(\'images/icons/check-white.png\') }}" alt="Výhoda" class="w-4 h-4 flex-shrink-0" />
            <span>Výroba a doprava priamo u nás</span>
          </div>
        </div>
        <div class="space-y-2.5">
          <div class="flex items-center gap-2.5">
            <img src="{{ asset(\'images/icons/check-white.png\') }}" alt="Výhoda" class="w-4 h-4 flex-shrink-0" />
            <span>Neustále sa rozširujúci sortiment</span>
          </div>
          <div class="flex items-center gap-2.5">
            <img src="{{ asset(\'images/icons/check-white.png\') }}" alt="Výhoda" class="w-4 h-4 flex-shrink-0" />
            <span>Krátka dodacia lehota</span>
          </div>
          <div class="flex items-center gap-2.5">
            <img src="{{ asset(\'images/icons/check-white.png\') }}" alt="Výhoda" class="w-4 h-4 flex-shrink-0" />
            <span>Odborné poradenstvo na najvyššej úrovni</span>
          </div>
        </div>
        <div class="space-y-2.5">
          <div class="flex items-center gap-2.5">
            <img src="{{ asset(\'images/icons/check-white.png\') }}" alt="Výhoda" class="w-4 h-4 flex-shrink-0" />
            <span>Veľké množstvá za nízke ceny</span>
          </div>
          <div class="flex items-center gap-2.5">
            <img src="{{ asset(\'images/icons/check-white.png\') }}" alt="Výhoda" class="w-4 h-4 flex-shrink-0" />
            <span>Produkty na mieru aj pri malých množstvách</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="max-w-6xl mx-auto px-6 py-4">
    <div class="flex items-center gap-3 mb-5">
      <span class="text-primary font-semibold text-base whitespace-nowrap">Odporúčané</span>
      <div class="flex-1 h-px bg-gray-200"></div>
      <div class="flex gap-1.5">
        <button class="w-7 h-7 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
          <img src="{{ asset(\'images/icons/arrow-left.png\') }}" alt="Späť" class="w-3 h-3 opacity-60" />
        </button>
        <button class="w-7 h-7 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
          <img src="{{ asset(\'images/icons/arrow-right.png\') }}" alt="Ďalej" class="w-3 h-3 opacity-60" />
        </button>
      </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      <a href="{{ route('product.detail') }}" class="group block text-center">
        <div class="img-ph w-full aspect-square mb-2.5 relative rounded border border-gray-200">
           <img src="{{ asset(\'images/products/letne1.jpg\') }}" alt="Matador MP47" class="w-full h-full object-cover" />
        </div>
        <p class="font-bold text-sm mb-3 group-hover:text-primary transition-colors">Matador MP47 Hectorra 3</p>
        <div class="inline-block bg-gray-100 text-primary font-bold text-sm px-4 py-1.5 rounded-md border border-gray-200">54.90 €</div>
      </a>
      <a href="{{ route('product.detail') }}" class="group block text-center">
        <div class="img-ph w-full aspect-square mb-2.5 relative rounded border border-gray-200">
           <img src="{{ asset(\'images/products/letne2.jpg\') }}" alt="Continental PremiumContact" class="w-full h-full object-cover" />
        </div>
        <p class="font-bold text-sm mb-3 group-hover:text-primary transition-colors">Continental PremiumContact 6</p>
        <div class="inline-block bg-gray-100 text-primary font-bold text-sm px-4 py-1.5 rounded-md border border-gray-200">112.50 €</div>
      </a>
      <a href="{{ route('product.detail') }}" class="group block text-center">
        <div class="img-ph w-full aspect-square mb-2.5 relative rounded border border-gray-200">
           <img src="{{ asset(\'images/products/zimne1.jpg\') }}" alt="Michelin Alpin 6" class="w-full h-full object-cover" />
        </div>
        <p class="font-bold text-sm mb-3 group-hover:text-primary transition-colors">Michelin Alpin 6 (Zimné)</p>
        <div class="inline-block bg-gray-100 text-primary font-bold text-sm px-4 py-1.5 rounded-md border border-gray-200">135.00 €</div>
      </a>
      <a href="{{ route('product.detail') }}" class="group block text-center">
        <div class="img-ph w-full aspect-square mb-2.5 relative rounded border border-gray-200">
           <img src="{{ asset(\'images/products/letne3.jpg\') }}" alt="Hankook Ventus" class="w-full h-full object-cover" />
        </div>
        <p class="font-bold text-sm mb-3 group-hover:text-primary transition-colors">Hankook Ventus Prime 4</p>
        <div class="inline-block bg-gray-100 text-primary font-bold text-sm px-4 py-1.5 rounded-md border border-gray-200">72.30 €</div>
      </a>
    </div>
  </section>

  <div class="py-10"></div>
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
