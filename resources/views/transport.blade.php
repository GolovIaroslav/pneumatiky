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

    <form method="POST" action="{{ route('transport.post') }}">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-8">
        <div class="space-y-2">
          @foreach ($shippingOptions as $shippingKey => $shippingOption)
            @php
              $isSelected = old('shipping', $selectedShipping) === $shippingKey;
              $price = (float) $shippingOption['price'];
            @endphp
            <label class="flex items-center justify-between border border-gray-400 rounded-lg px-3 py-2 cursor-pointer">
              <span class="flex items-center gap-3">
                <input type="radio" name="shipping" value="{{ $shippingKey }}" data-price="{{ $price }}" class="accent-primary" @checked($isSelected) />
                <span class="text-base md:text-xl leading-none">{{ $shippingOption['label'] }}</span>
              </span>
              <span class="text-base md:text-xl leading-none">{{ $price > 0 ? '+ ' . number_format($price, 2, ',', ' ') . ' €' : 'zadarmo' }}</span>
            </label>
          @endforeach
        </div>

        <div class="space-y-2">
          @foreach ($paymentOptions as $paymentKey => $paymentOption)
            @php
              $isSelected = old('payment', $selectedPayment) === $paymentKey;
              $price = (float) $paymentOption['price'];
            @endphp
            <label class="flex items-center justify-between border border-gray-400 rounded-lg px-3 py-2 cursor-pointer">
              <span class="flex items-center gap-3">
                <input type="radio" name="payment" value="{{ $paymentKey }}" data-price="{{ $price }}" class="accent-primary" @checked($isSelected) />
                <span class="text-base md:text-xl leading-none">{{ $paymentOption['label'] }}</span>
              </span>
              <span class="text-base md:text-xl leading-none">{{ $price > 0 ? '+ ' . number_format($price, 2, ',', ' ') . ' €' : 'zadarmo' }}</span>
            </label>
          @endforeach
        </div>
      </div>

      <div class="text-right text-lg mb-2">Cena produktov: <span id="products-price">{{ number_format($total, 2, ',', ' ') }} €</span></div>
      <div class="text-right text-lg mb-2">Doprava a platba: <span id="extras-price">{{ number_format($extraTotal, 2, ',', ' ') }} €</span></div>
      <div class="text-right font-bold text-lg mb-8">Celková cena: <span id="grand-price">{{ number_format($grandTotal, 2, ',', ' ') }} €</span></div>

      <div class="flex items-center justify-between gap-4">
        <a href="{{ route('cart') }}" class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-full transition-colors">Späť</a>
        <button type="submit" class="px-8 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-full transition-colors">Pokračovať</button>
      </div>
    </form>

  </main>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const productTotal = parseFloat('{{ number_format($total, 2, '.', '') }}');
    const extrasPriceEl = document.getElementById('extras-price');
    const grandPriceEl = document.getElementById('grand-price');
    const shippingInputs = document.querySelectorAll('input[name="shipping"]');
    const paymentInputs = document.querySelectorAll('input[name="payment"]');

    const formatEuro = (value) => {
      return value.toLocaleString('sk-SK', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
      }) + ' €';
    };

    const selectedPrice = (inputs) => {
      const selected = Array.from(inputs).find((input) => input.checked);
      return selected ? parseFloat(selected.dataset.price || '0') : 0;
    };

    const recalculate = () => {
      const shippingPrice = selectedPrice(shippingInputs);
      const paymentPrice = selectedPrice(paymentInputs);
      const extras = shippingPrice + paymentPrice;
      const grandTotal = productTotal + extras;

      if (extrasPriceEl) {
        extrasPriceEl.textContent = formatEuro(extras);
      }

      if (grandPriceEl) {
        grandPriceEl.textContent = formatEuro(grandTotal);
      }
    };

    shippingInputs.forEach((input) => input.addEventListener('change', recalculate));
    paymentInputs.forEach((input) => input.addEventListener('change', recalculate));
    recalculate();
  });
</script>
@endpush