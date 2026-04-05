@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-16">
    <div class="max-w-sm mx-auto">

      <h1 class="text-2xl font-bold text-center mb-10">Registrácia</h1>

      <form action="#" method="post" class="space-y-6">

        <div>
          <label for="email" class="block text-center text-sm font-medium text-gray-700 mb-2">E-mail</label>
          <input type="email" id="email" name="email" class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary" />
        </div>

        <div>
          <label for="username" class="block text-center text-sm font-medium text-gray-700 mb-2">Prihlasovacie meno</label>
          <input type="text" id="username" name="username" class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary" />
        </div>

        <div>
          <label for="password" class="block text-center text-sm font-medium text-gray-700 mb-2">Heslo</label>
          <div class="relative">
            <input type="password" id="password" name="password" class="w-full border border-gray-400 rounded-md px-4 py-2.5 pr-10 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary" />
            <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-gray-600">
              <img src="{{ asset(\'images/icons/eye.png\') }}" alt="Zobraziť heslo" class="w-5 h-5 opacity-50 hover:opacity-80 transition-opacity" />
            </button>
          </div>
        </div>

        <div>
          <label for="repeatpassword" class="block text-center text-sm font-medium text-gray-700 mb-2">Znovu zadajte heslo</label>
          <div class="relative">
            <input type="password" id="repeatpassword" name="repeatpassword" class="w-full border border-gray-400 rounded-md px-4 py-2.5 pr-10 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary" />
            <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-gray-600">
              <img src="{{ asset(\'images/icons/eye.png\') }}" alt="Zobraziť heslo" class="w-5 h-5 opacity-50 hover:opacity-80 transition-opacity" />
            </button>
          </div>
        </div>

        <div class="pt-4">
          <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 rounded-lg transition-colors">
            Vytvoriť účet
          </button>
        </div>

      </form>
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
