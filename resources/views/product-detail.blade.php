@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-8">

    <div class="flex flex-col lg:flex-row gap-12 mb-16">

      <div class="lg:w-96 flex-shrink-0">
        <img src="{{ asset(\'images/products/letne7.jpg\') }}" alt="Michelin Pilot Sport 4" class="w-full aspect-square mb-3 object-cover rounded" />
        <div class="grid grid-cols-4 gap-2">
          <img src="{{ asset(\'images/products/letne13.jpg\') }}" alt="Michelin Pilot Sport 4" class="w-full aspect-square object-cover rounded" />
          <img src="{{ asset(\'images/products/letne14.jpg\') }}" alt="Michelin Pilot Sport 4" class="w-full aspect-square object-cover rounded" />
          <img src="{{ asset(\'images/products/letne15.jpg\') }}" alt="Michelin Pilot Sport 4" class="w-full aspect-square object-cover rounded" />
          <img src="{{ asset(\'images/products/letne16.jpg\') }}" alt="Michelin Pilot Sport 4" class="w-full aspect-square object-cover rounded" />

        </div>
      </div>

      <div class="flex-1 pt-2">
        <h1 class="text-3xl font-bold mb-4 text-black">Michelin Pilot Sport 4</h1>
        <p class="text-black font-bold text-sm mb-6">245/40R18</p>

        <div class="flex items-baseline gap-3 mb-6">
          <span class="text-gray-500 font-bold text-xl">cena</span>
          <span class="text-4xl font-extrabold text-black">172 €</span>
          <span class="text-sm text-primary font-bold ml-1">Prices include VAT</span>
        </div>

        <div class="flex items-stretch gap-4 mb-8">
          <button class="w-72 bg-primary hover:bg-primary-dark text-white font-bold py-3.5 px-6 rounded-md transition-colors text-base text-center">
            pridať do košíka
          </button>
          
          <div class="flex w-16 border border-gray-300 rounded-md overflow-hidden bg-white">
            <div id="qty" class="flex-1 flex items-center justify-center font-bold text-black text-base">4</div>
            <div class="flex flex-col border-l border-gray-300 w-6">
              <button onclick="changeQty(1)" class="qty-btn flex-1 flex items-center justify-center hover:bg-gray-100 text-primary border-b border-gray-300">
                <img src="{{ asset(\'images/icons/caret-up.png\') }}" alt="Pridať" class="w-2.5 h-2.5 opacity-70" />
              </button>
              <button onclick="changeQty(-1)" class="qty-btn flex-1 flex items-center justify-center hover:bg-gray-100 text-primary">
                <img src="{{ asset(\'images/icons/caret-down.png\') }}" alt="Odobrať" class="w-2.5 h-2.5 opacity-70" />
              </button>
            </div>
          </div>
        </div>

        <ul class="space-y-3.5 text-sm">
          <li class="flex items-center gap-3">
            <img src="{{ asset(\'images/icons/check-green.png\') }}" alt="Check" class="w-5 h-5 flex-shrink-0" />
            <span class="text-green-500 font-medium">Rýchle spracovanie objednávky (do 20 min.)</span>
          </li>
          <li class="flex items-center gap-3">
            <img src="{{ asset(\'images/icons/stock.png\') }}" alt="Skladom" class="w-5 h-5 flex-shrink-0" />
            <span class="text-gray-700 font-medium">Skladom: 5 ks</span>
          </li>
          <li class="flex items-center gap-3">
            <img src="{{ asset(\'images/icons/pin.png\') }}" alt="Miesto" class="w-5 h-5 flex-shrink-0 opacity-60" />
            <span class="text-gray-700 font-medium">Bezplatný osobný odber na 2 odberných miestach</span>
          </li>
          <li class="flex items-center gap-3">
            <img src="{{ asset(\'images/icons/truck.png\') }}" alt="Kuriér" class="w-5 h-5 flex-shrink-0 opacity-60" />
            <span class="text-gray-700 font-medium">Bezplatné doručenie kuriérom</span>
          </li>
          <li class="flex items-center gap-3">
            <img src="{{ asset(\'images/icons/card.png\') }}" alt="Platba" class="w-5 h-5 flex-shrink-0 opacity-60" />
            <span class="text-gray-700 font-medium">Kartou online, v hotovosti, prevodom na účet</span>
          </li>
          <li class="flex items-center gap-3">
            <img src="{{ asset(\'images/icons/box.png\') }}" alt="Doprava" class="w-5 h-5 flex-shrink-0 opacity-60" />
            <span class="text-gray-700 font-medium">Doprava 0 €</span>
          </li>
        </ul>
      </div>
    </div>

    <section class="mb-14">
      <div class="flex items-center gap-3 mb-6">
        <span class="text-primary font-bold text-lg whitespace-nowrap">Odporúčané</span>
        <div class="flex-1 h-px bg-gray-200"></div>
        <div class="flex gap-2">
          <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
            <img src="{{ asset(\'images/icons/arrow-left.png\') }}" alt="Späť" class="w-3 h-3 opacity-60" />
          </button>
          <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
            <img src="{{ asset(\'images/icons/arrow-right.png\') }}" alt="Ďalej" class="w-3 h-3 opacity-60" />
          </button>
        </div>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
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

    <section id="reviews">
      <h2 class="text-3xl font-bold mb-3 text-black">Hodnotenia a recenzie</h2>
      <a href="#reviews" class="text-primary font-bold text-base hover:underline block mb-2">5 recenzií</a>
      <div class="flex items-center gap-3 mb-10">
        <div class="text-xl tracking-widest"><span class="text-yellow-400">★★★★</span><span class="text-gray-300">★</span></div>
        <span class="font-bold text-4xl text-gray-600">4.1</span>
      </div>

      <div class="mb-10">
        <p class="font-semibold text-base mb-3 text-black">pridať recenziu</p>

        <div class="flex items-center gap-1 mb-4">
          <span class="text-sm font-medium text-gray-500 mr-2">Hodnotenie:</span>
          <button onclick="setRating(1)" id="s1" class="text-gray-300 text-2xl hover:text-yellow-400 transition-colors">★</button>
          <button onclick="setRating(2)" id="s2" class="text-gray-300 text-2xl hover:text-yellow-400 transition-colors">★</button>
          <button onclick="setRating(3)" id="s3" class="text-gray-300 text-2xl hover:text-yellow-400 transition-colors">★</button>
          <button onclick="setRating(4)" id="s4" class="text-gray-300 text-2xl hover:text-yellow-400 transition-colors">★</button>
          <button onclick="setRating(5)" id="s5" class="text-gray-300 text-2xl hover:text-yellow-400 transition-colors">★</button>
        </div>

        <textarea
          rows="4"
          placeholder="Vaša recenzia"
          class="w-full max-w-md border border-gray-300 rounded-lg px-4 py-3 text-sm outline-none focus:border-primary resize-none placeholder-gray-400"
        ></textarea>
        <div class="mt-3">
          <button class="bg-primary hover:bg-primary-dark text-white font-bold text-sm px-10 py-3 rounded-lg tracking-wide transition-colors">
            ODOSLAŤ
          </button>
        </div>
      </div>

      <div class="space-y-6 max-w-3xl">

        <div class="border-b border-gray-200 pb-6">
          <div class="flex items-center gap-3 mb-3">
            <span class="text-yellow-400 text-lg tracking-widest">★★★★★</span>
            <span class="font-bold text-base text-black">Anonym</span>
            <span class="text-gray-500 text-xs">pred 3 rokmi</span>
          </div>
          <p class="text-gray-700 text-sm leading-relaxed">
            Pneumatiky sú výborné, jazdia sa skvele aj v daždi. Montáž prebehla rýchlo a bez problémov. Určite odporúčam každému, kto hľadá spoľahlivé letné pneumatiky za rozumnú cenu. Dodanie prebehlo načas a balenie bolo v poriadku.
          </p>
        </div>

        <div class="border-b border-gray-200 pb-6">
          <div class="flex items-center gap-3 mb-3">
            <span class="text-yellow-400 text-lg tracking-widest">★★★★★</span>
            <span class="font-bold text-base text-black">Anonym</span>
            <span class="text-gray-500 text-xs">pred 3 rokmi</span>
          </div>
          <p class="text-gray-700 text-sm leading-relaxed">
            Veľmi spokojný s nákupom. Cena zodpovedá kvalite, pneumatiky vydržali celú sezónu bez problémov. Obchod má rýchlu odozvu a doručenie bolo bez komplikácií. Budem nakupovať tu aj nabudúce a odporučím kamarátom.
          </p>
        </div>

        <div class="pb-6">
          <div class="flex items-center gap-3 mb-3">
            <div class="text-lg tracking-widest"><span class="text-yellow-400">★★★</span><span class="text-gray-300">★★</span></div>
            <span class="font-bold text-base text-black">Anonym</span>
            <span class="text-gray-500 text-xs">pred 1 rokom</span>
          </div>
          <p class="text-gray-700 text-sm leading-relaxed">
            Celkovo prijateľná pneumatika, no očakával som trochu lepšiu priľnavosť pri vyšších rýchlostiach. Dodanie bolo promptné, obal nepoškodený. Za tú cenu solídna voľba, ale na trhu sú aj lepšie alternatívy.
          </p>
        </div>

      </div>
    </section>

  </main>

  <div class="py-10"></div>
@endsection

@push('scripts')
<script>
    let qty = 4;
    function changeQty(d) {
      qty = Math.max(1, qty + d);
      document.getElementById('qty').textContent = qty;
    }
    let rating = 0;
    function setRating(n) {
      rating = n;
      for (let i = 1; i <= 5; i++) {
        document.getElementById('s' + i).className =
          'text-2xl transition-colors ' + (i <= n ? 'text-yellow-400' : 'text-gray-300 hover:text-yellow-400');
      }
    }
  </script>

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
