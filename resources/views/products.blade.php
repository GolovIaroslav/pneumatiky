@extends('layouts.app')

@section('content')
@php
  $activeBrands = collect($selectedBrands ?? request()->query('brand', []))->map(fn ($value) => (string) $value)->all();
  $activeSeasons = collect($selectedSeasons ?? request()->query('season', []))->map(fn ($value) => (string) $value)->all();
  $activeWidths = collect($selectedWidths ?? request()->query('width', []))->map(fn ($value) => (int) $value)->all();
  $activeProfiles = collect($selectedProfiles ?? request()->query('profile', []))->map(fn ($value) => (int) $value)->all();
  $activeDiameters = collect($selectedDiameters ?? request()->query('diameter', []))->map(fn ($value) => (string) $value)->all();
  $activeHasSpikes = collect($selectedHasSpikes ?? request()->query('has_spikes', []))->map(fn ($value) => (string) $value)->all();
  $currentSort = request()->query('sort', $sort ?? 'default');
  $currentCat = request()->query('cat', 'all');

  $availableBrandsList = $disabledFilterOptions['brands'] ?? [];
  $availableSeasonsList = $disabledFilterOptions['seasons'] ?? [];
  $availableWidthsList = $disabledFilterOptions['widths'] ?? [];
  $availableProfilesList = $disabledFilterOptions['profiles'] ?? [];
  $availableDiametersList = $disabledFilterOptions['diameters'] ?? [];

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
    @if (filled($search ?? null))
      <input type="hidden" name="q" value="{{ $search }}" />
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
              <input type="number" name="price_from" value="{{ floor($currentPriceFrom) }}" min="{{ floor($minPrice) }}" max="{{ ceil($maxPrice) }}" step="0.01" class="w-full text-gray-500 outline-none bg-transparent" />
              <span class="font-bold text-gray-900 ml-1">€</span>
            </div>
            <div class="flex-1 border-b border-gray-400 flex items-baseline pb-1">
              <span class="font-bold text-gray-900 mr-2">do</span>
              <input type="number" name="price_to" value="{{ ceil($currentPriceTo) }}" min="{{ floor($minPrice) }}" max="{{ ceil($maxPrice) }}" step="0.01" class="w-full text-gray-500 outline-none bg-transparent" />
              <span class="font-bold text-gray-900 ml-1">€</span>
            </div>
          </div>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Značka</p>
          <div class="space-y-2 max-h-44 overflow-auto pr-1">
            @forelse ($availableBrands as $brand)
              @php
                $isDisabled = ! in_array((string) $brand, $availableBrandsList, true);
                $isChecked = in_array((string) $brand, $activeBrands, true);
              @endphp
              <label class="flex items-center gap-2 cursor-pointer" style="{{ $isDisabled ? 'opacity: 0.5; pointer-events: none;' : '' }}">
                <input type="checkbox" name="brand[]" value="{{ $brand }}" @checked($isChecked) {{ $isDisabled ? 'disabled' : '' }} onchange="this.form.submit()" class="w-4 h-4 rounded border-gray-300" />
                <span class="text-gray-700 font-medium" style="{{ $isDisabled ? 'text-decoration: line-through;' : '' }}">{{ $brand }}</span>
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
                $isDisabledSeason = ! in_array($seasonValue, $availableSeasonsList, true);
                $isCheckedSeason = in_array($seasonValue, $activeSeasons, true);
              @endphp
              <div>
                <label class="flex items-center gap-2 cursor-pointer" style="{{ $isDisabledSeason ? 'opacity: 0.5; pointer-events: none;' : '' }}">
                  <input type="checkbox" name="season[]" value="{{ $seasonValue }}" @checked($isCheckedSeason) {{ $isDisabledSeason ? 'disabled' : '' }} onchange="this.form.submit()" class="w-4 h-4 rounded border-gray-300" />
                  <span class="text-gray-700 font-medium" style="{{ $isDisabledSeason ? 'text-decoration: line-through;' : '' }}">{{ $seasonLabel }}</span>
                </label>

                @if ($seasonValue === 'zimne' && ($isCheckedSeason || ! $isDisabledSeason))
                  <div class="pl-6 mt-1 space-y-1 border-l-2 border-gray-200 ml-2 pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                      <input type="checkbox" name="has_spikes[]" value="1" @checked(in_array('1', $activeHasSpikes, true)) onchange="this.form.submit()" class="w-4 h-4 rounded border-gray-300" />
                      <span class="text-gray-600 text-sm">s hrotmi</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                      <input type="checkbox" name="has_spikes[]" value="0" @checked(in_array('0', $activeHasSpikes, true)) onchange="this.form.submit()" class="w-4 h-4 rounded border-gray-300" />
                      <span class="text-gray-600 text-sm">bez hrotov</span>
                    </label>
                  </div>
                @endif
              </div>
            @endforeach
          </div>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Šírka (mm)</p>
          <div class="grid grid-cols-3 gap-y-2">
            @foreach ($availableWidths as $width)
              @php
                $isDisabledWidth = ! in_array((int) $width, $availableWidthsList, true);
                $isCheckedWidth = in_array((int) $width, $activeWidths, true);
              @endphp
              <label class="flex items-center gap-2 cursor-pointer" style="{{ $isDisabledWidth ? 'opacity: 0.5; pointer-events: none;' : '' }}">
                <input type="checkbox" name="width[]" value="{{ $width }}" @checked($isCheckedWidth) {{ $isDisabledWidth ? 'disabled' : '' }} onchange="this.form.submit()" class="w-4 h-4 rounded border-gray-300" />
                <span class="text-gray-700 font-medium" style="{{ $isDisabledWidth ? 'text-decoration: line-through;' : '' }}">{{ $width }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Profil (%)</p>
          <div class="grid grid-cols-3 gap-y-2">
            @foreach ($availableProfiles as $profile)
              @php
                $isDisabledProfile = ! in_array((int) $profile, $availableProfilesList, true);
                $isCheckedProfile = in_array((int) $profile, $activeProfiles, true);
              @endphp
              <label class="flex items-center gap-2 cursor-pointer" style="{{ $isDisabledProfile ? 'opacity: 0.5; pointer-events: none;' : '' }}">
                <input type="checkbox" name="profile[]" value="{{ $profile }}" @checked($isCheckedProfile) {{ $isDisabledProfile ? 'disabled' : '' }} onchange="this.form.submit()" class="w-4 h-4 rounded border-gray-300" />
                <span class="text-gray-700 font-medium" style="{{ $isDisabledProfile ? 'text-decoration: line-through;' : '' }}">{{ $profile }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Priemer (")</p>
          <div class="grid grid-cols-3 gap-y-2">
            @foreach ($availableDiameters as $diameter)
              @php
                $isDisabledDiameter = ! in_array((string) $diameter, $availableDiametersList, true);
                $isCheckedDiameter = in_array((string) $diameter, $activeDiameters, true);
              @endphp
              <label class="flex items-center gap-2 cursor-pointer" style="{{ $isDisabledDiameter ? 'opacity: 0.5; pointer-events: none;' : '' }}">
                <input type="checkbox" name="diameter[]" value="{{ $diameter }}" @checked($isCheckedDiameter) {{ $isDisabledDiameter ? 'disabled' : '' }} onchange="this.form.submit()" class="w-4 h-4 rounded border-gray-300" />
                <span class="text-gray-700 font-medium" style="{{ $isDisabledDiameter ? 'text-decoration: line-through;' : '' }}">{{ $diameter }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <button type="button" onclick="document.getElementById('mobile-filters').classList.add('hidden')" class="lg:hidden w-full bg-primary text-white font-bold py-3 rounded-lg mt-4">
          Zobraziť výsledky
        </button>
      </aside>

      <div class="flex-1 min-w-0">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
          <div class="flex items-center gap-1">
            @if ($products->onFirstPage())
              <button type="button" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium">&laquo;</button>
              <button type="button" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium">&lsaquo;</button>
            @else
              <a href="{{ $products->url(1) }}" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium hover:bg-gray-50">&laquo;</a>
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
              <option value="default" @selected($currentSort === 'default')>Odporúčané</option>
              <option value="price_asc" @selected($currentSort === 'price_asc')>Cena: od najnižšej</option>
              <option value="price_desc" @selected($currentSort === 'price_desc')>Cena: od najvyššej</option>
              <option value="name_asc" @selected($currentSort === 'name_asc')>Názov: A-Z</option>
            </select>
            <img src="{{ asset('images/icons/chevron-down.png') }}" alt="Šípka dole" class="absolute right-2 top-1/2 -translate-y-1/2 w-3 h-3 pointer-events-none opacity-50" />
          </div>
        </div>

        @if (filled($search ?? null))
          <div class="mb-6 flex items-center justify-between bg-blue-50 border border-blue-200 rounded-lg px-4 py-3">
            <span class="text-sm text-gray-700">
              <span class="font-bold">Výsledky vyhľadávania pre:</span>
              <span class="text-primary font-semibold">„{{ $search }}"</span>
            </span>
            <a href="{{ route('products', array_diff_key(request()->query(), ['q' => null])) }}" class="text-xs px-3 py-1.5 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-50 transition-colors font-medium">
              Vymazať hľadanie
            </a>
          </div>
        @endif

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-4 gap-y-6">
          @forelse ($products as $product)
            @php
              $mainImage = $product->images->firstWhere('is_main', true) ?? $product->images->first();
              $imagePath = $mainImage ? asset($mainImage->image_path) : asset('images/products/letne1.jpg');
              $seasonIcon = match ($product->season) {
                'zimne' => '❄',
                'celorocne' => '☀❄',
                default => '☀',
              };
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
                <div class="flex flex-col gap-1 mb-4">
                  <span class="text-gray-300 text-xl tracking-widest">☆☆☆☆☆</span>
                  <span class="text-sm text-primary font-medium">0 recenzií</span>
                </div>
                <div class="mt-auto mb-4 flex items-baseline gap-1">
                  <span class="text-gray-700 font-bold text-xs">Cena:</span>
                  <span class="font-bold text-base text-gray-900">{{ number_format((float) $product->price, 2, ',', ' ') }}€</span>
                  <span class="text-gray-500 font-bold text-xs">/ ks</span>
                </div>
                <a href="{{ route('product.show', $product->id) }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white font-medium text-xs py-2.5 rounded transition-colors">
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
            <a href="{{ $products->url(1) }}" class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium hover:bg-gray-50">&laquo;</a>
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
