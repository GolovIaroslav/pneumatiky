@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-16 min-h-[60vh]">
    <div class="max-w-3xl mx-auto text-left">
      <h1 class="text-2xl font-bold mb-6 text-center">Vašu objednávku sme úspešne zaznamenali.</h1>

      <div class="space-y-4 mb-10 text-base text-center">
        <p>Ďakujeme Vám za nákup. Na zadaný e-mail sme Vám odoslali potvrdenie.</p>
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
