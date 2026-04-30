@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-8">

    <div class="flex flex-col lg:flex-row gap-12 mb-16">

      <div class="lg:w-96 flex-shrink-0">
        @php
          $mainImage = $product->images->firstWhere('is_main', true) ?? $product->images->first();
          $galleryImages = collect([$mainImage])
            ->merge($product->images->where('is_main', false)->values())
            ->filter()
            ->unique('id')
            ->values();
        @endphp

        <img
          src="{{ $mainImage ? asset($mainImage->image_path) : asset('images/products/letne1.jpg') }}"
          alt="{{ $product->name }}"
          class="w-full aspect-square mb-3 object-cover rounded"
          id="main-img"
        />

        @if ($galleryImages->count() > 0)
        <div class="grid grid-cols-4 gap-2" id="product-gallery">
          @foreach ($galleryImages->take(4) as $index => $galleryImage)
            <button
              type="button"
              class="group relative overflow-hidden rounded focus:outline-none focus:ring-2 focus:ring-primary {{ $index === 0 ? 'ring-2 ring-primary' : '' }}"
              data-gallery-thumb="{{ asset($galleryImage->image_path) }}"
              data-gallery-active="{{ $index === 0 ? 'true' : 'false' }}"
            >
              <img
                src="{{ asset($galleryImage->image_path) }}"
                alt="{{ $product->name }}"
                class="w-full aspect-square object-cover transition group-hover:scale-[1.02]"
              />
            </button>
          @endforeach
        </div>
        @endif
      </div>

      <div class="flex-1 pt-2">
        <h1 class="text-3xl font-bold mb-2 text-black">
          {{ trim(($product->brand ? $product->brand . ' ' : '') . $product->name) }}
        </h1>
        @if ($product->width || $product->diameter)
        <p class="text-black font-bold text-sm mb-6">
          {{ $product->width && $product->profile ? $product->width . '/' . $product->profile : '' }}{{ $product->diameter ? 'R' . str_replace('r', '', strtolower($product->diameter)) : '' }}
        </p>
        @endif

        <div class="flex items-baseline gap-3 mb-6">
          <span class="text-gray-500 font-bold text-xl">cena</span>
          <span class="text-4xl font-extrabold text-black">{{ number_format((float) $product->price, 2, ',', ' ') }} €</span>
          <span class="text-sm text-primary font-bold ml-1">Ceny vrátane DPH</span>
        </div>

        <form method="POST" action="{{ route('cart.add') }}" class="flex items-stretch gap-4 mb-8">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}" />

          @if (session('error'))
            <div class="absolute -top-12 left-0 right-0 bg-red-50 border border-red-200 text-red-700 text-xs px-3 py-2 rounded shadow-sm">
              {{ session('error') }}
            </div>
          @endif

          <button type="submit" @disabled($product->stock === 0)
            class="w-72 font-bold py-3.5 px-6 rounded-md transition-colors text-base text-center
              {{ $product->stock === 0 ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-primary hover:bg-primary-dark text-white' }}">
            {{ $product->stock === 0 ? 'Vypredané' : 'pridať do košíka' }}
          </button>

          <div class="flex w-20 border border-gray-300 rounded-md overflow-hidden bg-white {{ $product->stock === 0 ? 'opacity-40 pointer-events-none' : '' }}">
              <input
                type="number"
                name="qty"
                id="qty-input"
                value="1"
                min="1"
                max="{{ $product->stock }}"
                step="1"
                class="flex-1 min-w-0 text-center font-bold text-black text-base outline-none bg-transparent [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
              />
            <div class="flex flex-col border-l border-gray-300 w-6">
              <button type="button" onclick="changeQty(1)" class="flex-1 flex items-center justify-center hover:bg-gray-100 text-primary border-b border-gray-300">
                <img src="{{ asset('images/icons/caret-up.png') }}" alt="Pridať" class="w-2.5 h-2.5 opacity-70" />
              </button>
              <button type="button" onclick="changeQty(-1)" class="flex-1 flex items-center justify-center hover:bg-gray-100 text-primary">
                <img src="{{ asset('images/icons/caret-down.png') }}" alt="Odobrať" class="w-2.5 h-2.5 opacity-70" />
              </button>
            </div>
          </div>
        </form>

        <ul class="space-y-3.5 text-sm">
          <li class="flex items-center gap-3">
            <img src="{{ asset('images/icons/check-green.png') }}" alt="Check" class="w-5 h-5 flex-shrink-0" />
            <span class="text-green-500 font-medium">Rýchle spracovanie objednávky (do 20 min.)</span>
          </li>
          <li class="flex items-center gap-3">
            <img src="{{ asset('images/icons/stock.png') }}" alt="Skladom" class="w-5 h-5 flex-shrink-0" />
            <span class="text-gray-700 font-medium">
              Skladom:
              @if ($product->stock > 0)
                {{ $product->stock }} ks
              @else
                <span class="text-red-500">Nie je na sklade</span>
              @endif
            </span>
          </li>
          <li class="flex items-center gap-3">
            <img src="{{ asset('images/icons/pin.png') }}" alt="Miesto" class="w-5 h-5 flex-shrink-0 opacity-60" />
            <span class="text-gray-700 font-medium">Bezplatný osobný odber na 2 odberných miestach</span>
          </li>
          <li class="flex items-center gap-3">
            <img src="{{ asset('images/icons/truck.png') }}" alt="Kuriér" class="w-5 h-5 flex-shrink-0 opacity-60" />
            <span class="text-gray-700 font-medium">Bezplatné doručenie kuriérom</span>
          </li>
          <li class="flex items-center gap-3">
            <img src="{{ asset('images/icons/card.png') }}" alt="Platba" class="w-5 h-5 flex-shrink-0 opacity-60" />
            <span class="text-gray-700 font-medium">Kartou online, v hotovosti, prevodom na účet</span>
          </li>
          <li class="flex items-center gap-3">
            <img src="{{ asset('images/icons/box.png') }}" alt="Doprava" class="w-5 h-5 flex-shrink-0 opacity-60" />
            <span class="text-gray-700 font-medium">Doprava 0 €</span>
          </li>
        </ul>
      </div>
    </div>

    @if ($product->description)
    <section class="mb-14">
      <h2 class="text-xl font-bold mb-3 text-black">Popis</h2>
      <p class="text-gray-600 text-sm leading-relaxed">{{ $product->description }}</p>
    </section>
    @endif

    @if ($related->count() > 0)
    <section class="mb-14">
      <div class="flex items-center gap-3 mb-6">
        <span class="text-primary font-bold text-lg whitespace-nowrap">Odporúčané</span>
        <div class="flex-1 h-px bg-gray-200"></div>
        <div class="flex gap-1.5">
          <button onclick="scrollCarousel('carousel-related', -1)" class="w-7 h-7 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
            <img src="{{ asset('images/icons/arrow-left.png') }}" alt="Späť" class="w-3 h-3 opacity-60" />
          </button>
          <button onclick="scrollCarousel('carousel-related', 1)" class="w-7 h-7 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
            <img src="{{ asset('images/icons/arrow-right.png') }}" alt="Ďalej" class="w-3 h-3 opacity-60" />
          </button>
        </div>
      </div>
      <div id="carousel-related" class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-4" style="scrollbar-width: none; -ms-overflow-style: none;">
        @foreach ($related as $rel)
          @php
            $relMain = $rel->images->firstWhere('is_main', true) ?? $rel->images->first();
            $relImg  = $relMain ? asset($relMain->image_path) : asset('images/products/letne1.jpg');
            $relName = trim(($rel->brand ? $rel->brand . ' ' : '') . $rel->name);
          @endphp
          <a href="{{ route('product.show', $rel->id) }}" class="group block text-center min-w-[45%] md:min-w-[23%] flex-shrink-0 snap-start">
            <div class="w-full aspect-square mb-2.5 relative rounded border border-gray-200">
              <img src="{{ $relImg }}" alt="{{ $relName }}" class="w-full h-full object-cover" />
            </div>
            <p class="font-bold text-sm mb-3 group-hover:text-primary transition-colors">{{ $relName }}</p>
            <div class="inline-block bg-gray-100 text-primary font-bold text-sm px-4 py-1.5 rounded-md border border-gray-200">
              {{ number_format((float) $rel->price, 2, ',', ' ') }} €
            </div>
          </a>
        @endforeach
      </div>
      <style>
        #carousel-related::-webkit-scrollbar { display: none; }
      </style>
    </section>
    @endif

    <section id="reviews">
      <h2 class="text-3xl font-bold mb-3 text-black">Hodnotenia a recenzie</h2>
      <div class="flex items-center gap-3 mb-10">
        <div class="text-xl tracking-widest"><span class="text-gray-300">★★★★★</span></div>
        <span class="text-gray-500 text-sm">Zatiaľ žiadne recenzie</span>
      </div>
    </section>

  </main>

  <div class="py-10"></div>
@endsection

@push('scripts')
<script>
  function scrollCarousel(id, direction) {
    const container = document.getElementById(id);
    if (!container) return;
    const scrollAmount = container.clientWidth * 0.5 * direction;
    container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
  }

  let qty = 1;

  function syncQtyInput(value) {
    const maxStock = {{ $product->stock }};
    let nextQty = parseInt(value, 10) || 1;
    nextQty = Math.max(1, Math.min(nextQty, maxStock));
    
    qty = nextQty;
    const qtyInput = document.getElementById('qty-input');
    if (qtyInput) {
      qtyInput.value = qty;
    }
  }

  function changeQty(d) {
    syncQtyInput(qty + d);
  }

  document.addEventListener('DOMContentLoaded', () => {
    const qtyInput = document.getElementById('qty-input');

    if (qtyInput) {
      qtyInput.addEventListener('input', (event) => syncQtyInput(event.target.value));
      qtyInput.addEventListener('change', (event) => syncQtyInput(event.target.value));
      syncQtyInput(qtyInput.value);
    }

    const mainImage = document.getElementById('main-img');
    const gallery = document.getElementById('product-gallery');

    if (!mainImage || !gallery) {
      return;
    }

    gallery.querySelectorAll('[data-gallery-thumb]').forEach((thumb) => {
      thumb.addEventListener('click', () => {
        const imageSrc = thumb.getAttribute('data-gallery-thumb');
        if (!imageSrc) {
          return;
        }

        mainImage.src = imageSrc;

        gallery.querySelectorAll('[data-gallery-active="true"]').forEach((activeThumb) => {
          activeThumb.setAttribute('data-gallery-active', 'false');
          activeThumb.classList.remove('ring-2', 'ring-primary');
        });

        thumb.setAttribute('data-gallery-active', 'true');
        thumb.classList.add('ring-2', 'ring-primary');
      });
    });
  });
</script>
@endpush
