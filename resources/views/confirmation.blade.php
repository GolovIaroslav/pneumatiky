@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-16 min-h-[60vh]">
    <div class="max-w-3xl mx-auto">
      <h1 class="text-3xl font-extrabold mb-8 text-center text-gray-900">Vašu objednávku sme úspešne zaznamenali.</h1>

      @if($orderId)
      <div class="mb-12 text-center">
        <p class="text-lg font-medium text-gray-800">Číslo objednávky: <span class="font-bold text-gray-900">#{{ $orderId }}</span></p>
        <p class="text-sm text-gray-500 mt-2">Potvrdzujúci e-mail bol odoslaný na vašu adresu.</p>
      </div>
      @endif

      <div class="text-center">
        <a href="{{ route('products') }}" class="inline-flex px-14 py-4 bg-[#4b5563] hover:bg-[#374151] text-white font-bold rounded-full transition-colors">
          Návrat do obchodu
        </a>
      </div>
    </div>
  </main>
@endsection

