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

    @if (session('success'))
      <div class="mb-4 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded">
        {{ session('success') }}
      </div>
    @endif

    @if (count($cartItems) > 0)

      <div class="border border-gray-400 rounded-lg divide-y divide-gray-400 mb-6">

        <div class="hidden md:grid md:grid-cols-12 gap-3 p-4 text-xs uppercase tracking-wide text-gray-500">
          <span class="md:col-span-5">Názov produktu</span>
          <span class="md:col-span-2 text-right">Cena/ks</span>
          <span class="md:col-span-2 text-right">Počet</span>
          <span class="md:col-span-2 text-right">Medzisúčet</span>
          <span class="md:col-span-1"></span>
        </div>

        @foreach ($cartItems as $item)
          @php
            $p      = $item['product'];
            $img    = $p->images->firstWhere('is_main', true) ?? $p->images->first();
            $imgSrc = $img ? asset($img->image_path) : asset('images/products/letne1.jpg');
            $label  = trim(($p->brand ? $p->brand . ' ' : '') . $p->name);
          @endphp

          <div class="grid grid-cols-1 md:grid-cols-12 gap-3 p-4 items-center">
            <div class="md:col-span-5 flex items-center gap-3">
              <img src="{{ $imgSrc }}" alt="{{ $label }}" class="w-16 h-16 flex-shrink-0 object-cover rounded" />
              <a href="{{ route('product.show', $p->id) }}" class="font-medium hover:text-primary transition-colors">{{ $label }}</a>
            </div>

            <div class="md:col-span-2 flex items-center justify-between md:justify-end gap-3 text-gray-700">
              <span class="md:hidden text-xs uppercase text-gray-500">Cena/ks</span>
              <span>{{ number_format((float) $p->price, 2, ',', ' ') }} €</span>
            </div>

            <div class="md:col-span-2 flex items-center justify-between md:justify-end gap-3">
              <span class="md:hidden text-xs uppercase text-gray-500">Počet</span>
              <form method="POST" action="{{ route('cart.update') }}" class="flex flex-col items-center gap-1">
                @csrf
                <input type="hidden" name="product_id" value="{{ $p->id }}" />
                <input
                  type="number"
                  name="qty"
                  value="{{ $item['qty'] }}"
                  min="1"
                  onchange="this.form.submit()"
                  class="w-14 text-center border border-gray-300 rounded px-1 py-0.5 text-sm"
                />
                <div class="flex gap-1">
                  <button
                    type="button"
                    onclick="let i=this.closest('form').querySelector('[name=qty]'); i.value=Math.max(1,parseInt(i.value)+1); i.form.submit();"
                    class="w-6 h-6 border border-gray-300 rounded text-gray-600 text-sm leading-none hover:bg-gray-100"
                  >+</button>
                  <button
                    type="button"
                    onclick="let i=this.closest('form').querySelector('[name=qty]'); if(parseInt(i.value)>1){i.value=parseInt(i.value)-1; i.form.submit();}"
                    class="w-6 h-6 border border-gray-300 rounded text-gray-600 text-sm leading-none hover:bg-gray-100"
                  >-</button>
                </div>
              </form>
            </div>

            <div class="md:col-span-2 flex items-center justify-between md:justify-end gap-3 font-medium">
              <span class="md:hidden text-xs uppercase text-gray-500">Medzisúčet</span>
              <span>{{ number_format((float) $item['subtotal'], 2, ',', ' ') }} €</span>
            </div>

            <form method="POST" action="{{ route('cart.remove') }}" class="md:col-span-1 flex justify-end">
              @csrf
              <input type="hidden" name="product_id" value="{{ $p->id }}" />
              <button type="submit" class="text-gray-400 hover:text-red-500">
                <img src="{{ asset('images/icons/trash.png') }}" alt="Odstrániť" class="w-5 h-5 opacity-50 hover:opacity-100 transition-opacity" />
              </button>
            </form>
          </div>
        @endforeach

      </div>

      <div class="text-right font-bold text-lg mb-8">
        Cena produktov: {{ number_format((float) $total, 2, ',', ' ') }} €
      </div>

      <div class="flex items-center justify-between">
        <a href="{{ route('products') }}" class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-full transition-colors">Späť k nákupu</a>
        <a href="{{ route('transport') }}" class="px-8 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-full transition-colors">Pokračovať</a>
      </div>

    @else

      <div class="flex flex-col items-center justify-center py-20 text-center text-gray-500">
        <img src="{{ asset('images/icons/cart.png') }}" alt="Prázdny košík" class="w-16 h-16 opacity-30 mb-6" />
        <p class="text-xl font-semibold mb-2">Váš košík je prázdny</p>
        <p class="text-sm mb-6">Pridajte produkty z nášho katalógu</p>
        <a href="{{ route('products') }}" class="px-8 py-3 bg-primary hover:bg-primary-dark text-white font-medium rounded-full transition-colors">Prejsť na produkty</a>
      </div>

    @endif

  </main>
@endsection