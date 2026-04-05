@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-16 min-h-[60vh]">
    <div class="max-w-3xl mx-auto text-left">
      <h1 class="text-2xl font-bold mb-6 text-center">Vašu objednávku sme úspešne zaznamenali.</h1>

      <div class="space-y-2 mb-10 text-base text-center">
        <p>
          <span class="font-medium">Sledujte stav objednávky:</span>
          <a href="#" class="text-gray-500 hover:text-gray-700 underline">tracker.io/654563</a>
        </p>
        <p>
          <span class="font-medium">Sumár objednávky:</span>
          <a href="#" class="text-gray-500 hover:text-gray-700 underline">order06166_summary.pdf</a>
        </p>
      </div>

      <div class="text-center">
        <a href="{{ route('products') }}" class="inline-flex px-8 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-full transition-colors">Návrat do obchodu</a>
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
