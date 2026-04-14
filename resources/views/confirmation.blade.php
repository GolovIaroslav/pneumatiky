@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-16 min-h-[60vh]">
    <div class="max-w-3xl mx-auto">
      <h1 class="text-3xl font-extrabold mb-8 text-center text-gray-900">Vašu objednávku sme úspešne zaznamenali.</h1>

      <div class="space-y-2 mb-12 text-lg text-center font-medium text-gray-800">
        <p>Sledujte stav objednávky: <a href="#" class="underline text-gray-500 hover:text-gray-700">tracker.io/654563</a></p>
        <p>Sumár objednávky: <a href="#" class="underline text-gray-500 hover:text-gray-700">order06166_summary.pdf</a></p>
      </div>

      <div class="text-center">
        <a href="{{ route('products') }}" class="inline-flex px-14 py-4 bg-[#4b5563] hover:bg-[#374151] text-white font-bold rounded-full transition-colors">
          Návrat do obchodu
        </a>
      </div>
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
