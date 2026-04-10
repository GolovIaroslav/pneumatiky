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
        @if(count($cartItems) > 0)
          @foreach($cartItems as $item)
            @php
              $p      = $item['product'];
              $img    = $p->images->firstWhere('is_main', true) ?? $p->images->first();
              $imgSrc = $img ? asset($img->image_path) : asset('images/products/letne1.jpg');
              $label  = trim(($p->brand ? $p->brand . ' ' : '') . $p->name);
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 px-5 py-4 items-center">
              <div class="md:col-span-5 flex items-center gap-3">
                <img src="{{ $imgSrc }}" alt="{{ $label }}" class="w-14 h-14 rounded object-cover flex-shrink-0" />
                <span class="font-medium">{{ $label }}</span>
              </div>
              <span class="md:col-span-2 md:text-right text-gray-700">{{ $item['qty'] }} ks</span>
              <span class="md:col-span-2 md:text-right text-gray-700">{{ number_format((float) $p->price, 2, ',', ' ') }} €</span>
              <span class="md:col-span-3 md:text-right font-medium">{{ number_format((float) $item['subtotal'], 2, ',', ' ') }} €</span>
            </div>
          @endforeach
        @else
          <div class="px-5 py-4 text-gray-500">Váš košík je prázdny.</div>
        @endif
        </div>
      </section>

      @if(!empty($deliveryInfo))
      <section class="border border-gray-300 rounded-lg overflow-hidden">
        <div class="px-5 py-3 bg-gray-50 border-b border-gray-200">
          <h2 class="text-lg font-bold">Údaje pre doručenie</h2>
        </div>
        <div class="px-5 py-4 space-y-1 text-gray-800">
          <p><span class="font-medium">Meno:</span> {{ $deliveryInfo['meno'] ?? '' }} {{ $deliveryInfo['priezvisko'] ?? '' }}</p>
          <p><span class="font-medium">E-mail:</span> {{ $deliveryInfo['email'] ?? '' }}</p>
          <p><span class="font-medium">Telefón:</span> {{ $deliveryInfo['telefon'] ?? '' }}</p>
          <p><span class="font-medium">Adresa:</span> {{ $deliveryInfo['ulica'] ?? '' }}, {{ $deliveryInfo['psc'] ?? '' }} {{ $deliveryInfo['mesto'] ?? '' }}</p>
          @if(!empty($deliveryInfo['poznamka']))
          <br>
          <p><span class="font-medium">Poznámka:</span> {{ $deliveryInfo['poznamka'] }}</p>
          @endif
        </div>
      </section>
      @endif

      <section class="border border-gray-300 rounded-lg overflow-hidden">
        <div class="px-5 py-3 bg-gray-50 border-b border-gray-200">
          <h2 class="text-lg font-bold">Doprava a platba</h2>
        </div>
        <div class="px-5 py-4 space-y-2">
          <div class="flex items-center justify-between">
            <span class="text-gray-700">Doprava: Packeta</span>
            <span class="font-medium">+ {{ number_format($dopravaCena, 2, ',', ' ') }} €</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-gray-700">Platba: Kartou online</span>
            <span class="font-medium">zadarmo</span>
          </div>
        </div>
      </section>

      <section class="border border-gray-300 rounded-lg p-5 bg-gray-50">
        <div class="space-y-2 text-right">
          <p class="text-gray-700">Cena produktov: <span class="font-medium">{{ number_format($total, 2, ',', ' ') }} €</span></p>
          <p class="text-gray-700">Doprava a platba: <span class="font-medium">{{ number_format($dopravaCena, 2, ',', ' ') }} €</span></p>
          <p class="text-2xl font-bold">Celkom na úhradu: {{ number_format($totalSUpravou, 2, ',', ' ') }} €</p>
        </div>
      </section>

      <div class="flex items-center justify-between gap-4 pt-2">
        <a href="{{ route('delivery') }}" class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-full transition-colors">Späť</a>
        <a href="{{ route('confirmation') }}" class="px-8 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-full transition-colors">Potvrdiť objednávku</a>
      </div>
    </div>

  </main>
@endsection