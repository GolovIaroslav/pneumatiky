@extends('layouts.app')

@section('content')
@php
  $activeBrands = collect($selectedBrands ?? request()->query('brand', []))->map(fn ($value) => (string) $value)->all();
  $currentSeason = request()->query('season');
  $currentWidth = request()->query('width');
  $currentProfile = request()->query('profile');
  $currentDiameter = request()->query('diameter');
  $currentPriceFrom = request()->query('price_from', 22);
  $currentPriceTo = request()->query('price_to', 270);
  $currentSort = request()->query('sort', $sort ?? 'default');
  $currentCat = request()->query('cat', 'all');

  $paginationStart = max(1, $products->currentPage() - 1);
  $paginationEnd = min($products->lastPage(), $paginationStart + 3);
  if (($paginationEnd - $paginationStart) < 3) {
      $paginationStart = max(1, $paginationEnd - 3);
  }
@endphp

<div class="max-w-6xl mx-auto px-6 py-8">
  <form method="GET" action="{{ route('products') }}">
    @if (filled($currentCat) && $currentCat !== 'all')
      <input type="hidden" name="cat" value="{{ $currentCat }}" />
    @endif

    <div class="flex flex-col lg:flex-row gap-8">
      <button type="button" onclick="document.getElementById('mobile-filters').classList.toggle('hidden')" class="w-full mb-6 lg:hidden bg-white border border-gray-300 text-gray-800 font-bold py-2.5 rounded flex items-center justify-center gap-2 shadow-sm">
        <img src="{{ asset('images/icons/filter.png') }}" alt="Filter" class="w-4 h-4 opacity-70" />
        Filtrovať produkty
      </button>

      <aside id="mobile-filters" class="w-full lg:w-52 flex-shrink-0 hidden lg:block text-sm mb-6 lg:mb-0">
        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Cena za 1 ks</p>
          <div class="flex items-center gap-6">
            <div class="flex-1 border-b border-gray-400 flex items-baseline pb-1">
              <span class="font-bold text-gray-900 mr-2">od</span>
              <input type="number" name="price_from" value="{{ $currentPriceFrom }}" class="w-full text-gray-500 outline-none bg-transparent" />
            </div>
            <div class="flex-1 border-b border-gray-400 flex items-baseline pb-1">
              <span class="font-bold text-gray-900 mr-2">do</span>
              <input type="number" name="price_to" value="{{ $currentPriceTo }}" class="w-full text-gray-500 outline-none bg-transparent" />
            </div>
          </div>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Značka</p>
          <div class="space-y-2 max-h-44 overflow-auto pr-1">
            @forelse ($availableBrands as $brand)
              <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="brand[]" value="{{ $brand }}" @checked(in_array($brand, $activeBrands, true)) class="w-4 h-4 rounded border-gray-300" />
                <span class="text-gray-700 font-medium">{{ $brand }}</span>
              </label>
            @empty
              <p class="text-gray-500 text-xs">Zatiaľ nie sú dostupné žiadne značky.</p>
            @endforelse
          </div>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Sezónnosť</p>
          @php $availableSeasonValues = $availableSeasons->all(); @endphp
          <div class="space-y-2">
            @foreach ($availableSeasonValues as $seasonValue)
              @php
                $seasonLabel = match ($seasonValue) {
                  'zimne' => 'zimné',
                  'letne' => 'letné',
                  'celorocne' => 'celoročné',
                  default => ucfirst($seasonValue),
                };
              @endphp
              <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="season" value="{{ $seasonValue }}" @checked($currentSeason === $seasonValue) class="w-4 h-4 rounded border-gray-300" />
                <span class="text-gray-700 font-medium">{{ $seasonLabel }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Šírka (mm)</p>
          <div class="grid grid-cols-3 gap-y-2">
            @foreach ($availableWidths as $width)
              <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="width" value="{{ $width }}" @checked((string) $currentWidth === (string) $width) class="w-4 h-4 rounded border-gray-300" />
                <span class="text-gray-700 font-medium">{{ $width }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Profil (%)</p>
          <div class="grid grid-cols-3 gap-y-2">
            @foreach ($availableProfiles as $profile)
              <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="profile" value="{{ $profile }}" @checked((string) $currentProfile === (string) $profile) class="w-4 h-4 rounded border-gray-300" />
                <span class="text-gray-700 font-medium">{{ $profile }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Priemer (")</p>
          <div class="grid grid-cols-3 gap-y-2">
            @foreach ($availableDiameters as $diameter)
              <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="diameter" value="{{ $diameter }}" @checked((string) $currentDiameter === (string) $diameter) class="w-4 h-4 rounded border-gray-300" />
                <span class="text-gray-700 font-medium">{{ $diameter }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <button type="submit" onclick="document.getElementById('mobile-filters').classList.add('hidden')" class="lg:hidden w-full bg-primary text-white font-bold py-3 rounded-lg mt-4">
          Zobraziť výsledky
        </button>
        <button type="submit" class="hidden lg:block w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 rounded-lg transition-colors">
          Filtrovať
        </button>
      </aside>

      <div class="flex-1 min-w-0">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
          <div class="flex items-center gap-1">
            @if ($products->onFirstPage())
              <button type="button" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium">&laquo;</button>
              <button type="button" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium">&lsaquo;</button>
            @else
              <a href="{{ $products->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium hover:bg-gray-50">&laquo;</a>
              <a href="{{ $products->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium hover:bg-gray-50">&lsaquo;</a>
            @endif

            @for ($page = $paginationStart; $page <= $paginationEnd; $page++)
              @if ($page === $products->currentPage())
                <span class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-primary font-bold rounded text-sm">{{ $page }}</span>
              @else
                <a href="{{ $products->url($page) }}" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium hover:bg-gray-50 hover:text-primary">{{ $page }}</a>
              @endif
            @endfor

            @if ($products->hasMorePages())
              <a href="{{ $products->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium hover:bg-gray-50 hover:text-primary">&rsaquo;</a>
              <a href="{{ $products->url($products->lastPage()) }}" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium hover:bg-gray-50 hover:text-primary">&raquo;</a>
            @else
              <button type="button" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium">&rsaquo;</button>
              <button type="button" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium">&raquo;</button>
            @endif
          </div>

          <div class="relative">
            <select name="sort" onchange="this.form.submit()" class="appearance-none border border-gray-200 rounded px-4 py-1.5 text-xs font-medium text-gray-800 pr-8 outline-none focus:border-primary bg-white cursor-pointer">
              <option value="default" @selected($currentSort === 'default')>Predvolené</option>
              <option value="price_asc" @selected($currentSort === 'price_asc')>Cena: od najnižšej</option>
              <option value="price_desc" @selected($currentSort === 'price_desc')>Cena: od najvyššej</option>
              <option value="name_asc" @selected($currentSort === 'name_asc')>Názov: A-Z</option>
            </select>
            <img src="{{ asset('images/icons/chevron-down.png') }}" alt="Šípka dole" class="absolute right-2 top-1/2 -translate-y-1/2 w-3 h-3 pointer-events-none opacity-50" />
          </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-4 gap-y-6">
          @forelse ($products as $product)
            @php
              $mainImage = $product->images->firstWhere('is_main', true) ?? $product->images->first();
              $imagePath = $mainImage ? asset($mainImage->image_path) : asset('images/products/letne1.jpg');
              $seasonIcon = $product->season === 'zimne' ? '❄' : '☀';
              $seasonIconClass = $product->season === 'zimne' ? 'text-5xl' : 'text-6xl';
              $displayName = trim(($product->brand ? $product->brand . ' ' : '') . $product->name);
            @endphp

            <div class="border border-gray-200 rounded flex flex-col bg-white overflow-hidden group">
              <div class="w-full aspect-square relative border-b border-gray-200">
                <img src="{{ $imagePath }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover" />
                <span class="absolute top-1 right-1 z-10 text-yellow-500 {{ $seasonIconClass }} leading-none">{{ $seasonIcon }}</span>
              </div>
              <div class="p-4 flex flex-col flex-1 text-left">
                <p class="font-bold text-sm mb-2 text-gray-900 group-hover:text-primary transition-colors">{{ $displayName }}</p>
                <div class="flex items-center gap-1 mb-4">
                  <span class="text-yellow-400 text-xl tracking-widest">★★★★★</span>
                  <span class="text-sm text-primary font-medium ml-1">0 recenzií</span>
                </div>
                <div class="mt-auto mb-4 flex items-baseline gap-1">
                  <span class="text-gray-500 font-bold text-xs">od</span>
                  <span class="font-bold text-base text-gray-900">{{ number_format((float) $product->price, 0, ',', ' ') }} €</span>
                </div>
                <a href="{{ route('product.detail') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white font-medium text-xs py-2.5 rounded transition-colors">
                  Viac informácií
                </a>
              </div>
            </div>
          @empty
            <div class="col-span-full border border-dashed border-gray-300 rounded p-8 text-center text-gray-500">
              Pre zvolené filtre sa nenašli žiadne produkty.
            </div>
          @endforelse
        </div>

        <div class="flex items-center justify-center gap-1 mt-10">
          @if ($products->onFirstPage())
            <button type="button" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium">&laquo;</button>
            <button type="button" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium">&lsaquo;</button>
          @else
            <a href="{{ $products->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium hover:bg-gray-50">&laquo;</a>
            <a href="{{ $products->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium hover:bg-gray-50">&lsaquo;</a>
          @endif

          @for ($page = $paginationStart; $page <= $paginationEnd; $page++)
            @if ($page === $products->currentPage())
              <span class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-primary font-bold rounded text-sm">{{ $page }}</span>
            @else
              <a href="{{ $products->url($page) }}" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium hover:bg-gray-50 hover:text-primary">{{ $page }}</a>
            @endif
          @endfor

          @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium hover:bg-gray-50 hover:text-primary">&rsaquo;</a>
            <a href="{{ $products->url($products->lastPage()) }}" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium hover:bg-gray-50 hover:text-primary">&raquo;</a>
          @else
            <button type="button" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium">&rsaquo;</button>
            <button type="button" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium">&raquo;</button>
          @endif
        </div>
      </div>
    </div>
  </form>
</div>

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
